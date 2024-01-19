<?php declare(strict_types= 1);

// Lien vers la page des fonctions
require_once __DIR__ ."/functions.php";

// Appel de la connection au PDO
$pdo = getPDO('mysql:host=localhost;dbname=blog', 'root', '');
// Appel de la liste des articles
$posts = getPostsWithCategories($pdo);
// Appel d'un article avec sa catégorie
$post = getPostWithCategory((int)$_GET['id'], $pdo);
// Appel des articles en fonction des catégories
$postCat = getPostsByCategory((int)$_GET['id'], $pdo);


echo '<pre>';
var_dump($posts);
echo '</pre>';

?>
