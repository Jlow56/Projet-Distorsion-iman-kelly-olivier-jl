<?php
require 'connexion.php';
require 'autoload.php';


if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Récupérer les salons de la catégorie spécifiée
    $salons = [];
    $querySalons = $bdd->prepare('SELECT * FROM salons WHERE category_id = :category_id');
    $querySalons->bindParam(':category_id', $categoryId);
    $querySalons->execute();

    while ($data = $querySalons->fetch()) {
        $salons[] = new Salon($data['id'], $data['name'], $data['category_id']);
    }
} else {
    // Rediriger vers la page principale si l'ID de la catégorie n'est pas spécifié
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Liste des salons d'une catégorie">
    <title>Salons de la catégorie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Salons de la catégorie</h1>

    <section>
        <h2>Salons de la catégorie</h2>
        <ul>
            <?php foreach ($salons as $salon) : ?>
                <li>
                    <?= $salon->getName(); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <a href="index.php">Retour à la liste des catégories</a>
</body>

</html>