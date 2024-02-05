<?php
require 'config/connexion-jl.php';

// Récupérer les catégories
$categories = [];
$queryCategories = $bdd->query('SELECT * FROM categories');
while ($data = $queryCategories->fetch()) {
    $categories[] = new Category($data['id'], $data['name']);
}

// Récupérer les salons
$salons = [];
$querySalons = $bdd->query('SELECT * FROM channel');
while ($data = $querySalons->fetch()) {
    $salons[] = new Salon($data['id'], $data['name'], $data['category_id']);
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
    <h1>Liste des catégories et salons</h1>

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
        <h2>Salons</h2>
        <ul>
            <?php foreach ($salons as $salon) : ?>
                <li>
                    <?= $salon->getName(); ?> (Catégorie : <?= $salon->getCategoryId(); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>

</html>