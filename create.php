<?php declare(strict_types= 1);

// Lien vers la page des fonctions
require_once __DIR__ ."/functions.php";
$pdo = getPDO('mysql:host=localhost;dbname=blog', 'root', '');

$status = createPost($pdo);

if (! empty($_POST)) {
    createPost($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un article</title>
</head>
<body>
    <form action="" method="post" style="display: inline-flex; flex-direction: column">
        <label for="title">Titre de l'article</label>
        <input type="text" name="title" id="title">
        <label for="body">Contenu de l'article</label>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
        <input type="submit" value="Publier">
    </form>
</body>
</html>