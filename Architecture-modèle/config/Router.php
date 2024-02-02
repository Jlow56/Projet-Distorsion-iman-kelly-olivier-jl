<?php
class Router
{
    public function __construct()
    {

    }

    public function handleRequest(array $get): void
    {
        if (isset($get["route"]) && $get["route"] === "connexion") 
        {
            // Afficher le formulaire de connexion connexion.php
            require_once 'templates/connexion_form.php';
        } 
        else if (isset($get["route"]) && $get["route"] === "check-connexion") 
        {
            // Gérer l'action du formulaire de connexion
            require_once 'controllers/ConnexionController.php';
            $connexionController = new ConnexionController();
            $connexionController->checkConnexion();
        } 
        else if (isset($get["route"]) && $get["route"] === "inscription") 
        {
            // Afficher le formulaire d'inscription
            require_once 'templates/inscription_form.php';
        } 
        else if (isset($get["route"]) && $get["route"] === "check-inscription") 
        {
            // Gérer l'action du formulaire d'inscription
            require_once 'controllers/InscriptionController.php';
            $inscriptionController = new InscriptionController();
            $inscriptionController->checkInscription();
        } 
        else if (isset($get["route"]) && $get["route"] === "espace-perso")
        {
            // Afficher l'espace personnel de l'utilisateur
            require_once 'controllers/EspacePersoController.php';
            $espacePersoController = new EspacePersoController();
            $espacePersoController->afficherEspacePerso();
        } 
        else 
        {
            // Rediriger vers une page par défaut en cas de route non reconnue
            header('Location: index.php');
            exit();
        }
    }
}
?>
- `?route=connexion` : affichera un formulaire de connexion

- `?route=check-connexion` : sera l'action du formulaire de connexion 
, connectera l'utilisateur si ses infos sont bonnes et redirigera l'utilisateur

- `?route=inscription` : affichera un formulaire d'inscription

- `?route=check-inscription` : sera l'action du formulaire d'inscription, 
appelera le manager pour créer l'utilisateur, connectera l'utilisateur et 
redirigera l'utilisateur

- `?route=espace-perso` : affichera de username de l'utilisateur connecté 
s'il y en a un, sinon redirigera vers la connexion

