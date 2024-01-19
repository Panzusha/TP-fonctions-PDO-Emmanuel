<?php declare(strict_types= 1);

// Création PDO
function getPDO(string $dsn, string $user, string $password): PDO {

    return new PDO($dsn, $user, $password);
}

// Retourne les articles associés a leurs catégories
function getPostsWithCategories(PDO $pdo): array {

    // Partie pagination
    


    // Fonction originelle (avant ajout pagination )
    $query = $pdo->query('SELECT p.id, p.title, p.body, p.excerpt, p.created_at, c.name AS category_name
        FROM posts p
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.created_at DESC
    ');

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Retourne un article avec sa catégorie en argument
function getPostWithCategory(int $id, PDO $pdo): array|false
{
    $query = $pdo->prepare('SELECT p.title, p.body, p.excerpt, p.created_at, c.name AS category_name
        FROM posts p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = :id
    ');

    $query->bindValue('id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

// Filtrer les articles en fonction des catégories

function getPostsByCategory(int $id, PDO $pdo): array
{
    $query = $pdo->prepare('SELECT p.title, p.body, p.excerpt, p.created_at, c.name AS category_name
        FROM posts p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE c.id = :id
        ORDER BY p.created_at DESC
    ');

    $query->bindValue('id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);

    // Vérification si tableau vide ou pas
    $rowCount = $query->rowCount();

    
    return $query->fetchAll(PDO::FETCH_ASSOC);
    
}

function createPost(PDO $pdo): bool
{
// Création d'un article
// Si mon formulaire a été soumis 
if (! empty($_POST)) 
    // validation du formulaire

    $query = $pdo->prepare('INSERT INTO posts (title, body, excerpt) VALUES (:title, :body, :excerpt)');
    $query->bindValue('title', $_POST['title'], PDO::PARAM_STR);
    $query->bindValue('body', $_POST['body'], PDO::PARAM_STR);
    $query->bindValue('excerpt', substr($_POST['body'], 0, 150), PDO::PARAM_STR);
    $query->execute();


return false;
}

function updatePost(PDO $pdo): bool
{

    // Si mon formulaire a été soumis 
if (! empty($_POST)) {
    $errors = [];

    // Validation du formulaire
    if (! $errors) {
        // Attention d'indiquer une clause WHERE sinon vous mettez à jour toutes les entrées
        $query = $pdo->prepare('UPDATE posts SET title = :title, body = :body, excerpt = :excerpt WHERE id = :id');
        $query->bindValue('title', $_POST['title'], PDO::PARAM_STR);
        $query->bindValue('body', $_POST['body'], PDO::PARAM_STR);
        $query->bindValue('excerpt', substr($_POST['body'], 0, 150), PDO::PARAM_STR);
        $query->bindValue('id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();

    }
}
return false;
}