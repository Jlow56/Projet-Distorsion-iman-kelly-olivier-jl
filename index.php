<?php
<<<<<<< HEAD
require 'config/connexion-jl.php';

=======
require "config/connexion_oliv.php";
require "config/autoload.php";
require "models/Categories.php";
>>>>>>> 4829bd19490d99b57928d7a7531dec3f0ef3f0ca
// Récupérer les catégories
$categories = [];
$queryCategories = $bdd->query('SELECT * FROM categories');
while ($data = $queryCategories->fetch()) {
    $categories[] = new Category($data['id'], $data['name']);
}

// Récupérer les channels
$salons = [];
<<<<<<< HEAD
$querySalons = $bdd->query('SELECT * FROM channel');
while ($data = $querySalons->fetch()) {
    $salons[] = new Salon($data['id'], $data['name'], $data['category_id']);
=======
$queryChannel = $bdd->query('SELECT * FROM channel');
while ($data = $queryChannel->fetch()) {
    $salons[] = new Channel($data['id'], $data['name'], $data['id_category']);
>>>>>>> 4829bd19490d99b57928d7a7531dec3f0ef3f0ca
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Liste des catégories et salons">
    <title>Liste des catégories et salons</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des catégories et channel</h1>

    <section>
        <h2>Catégories</h2>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="salons.php?category_id=<?= $category->getId(); ?>">
                        <?= $category->getName(); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Channel</h2>
        <ul>
            <?php foreach ($channels as $channel) : ?>
                <li>
                    <?= $channel->getName(); ?> (Catégorie : <?= $channel->getCategoryId(); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>

</html>