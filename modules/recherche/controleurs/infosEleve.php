<?php

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include_once CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include_once CHEMIN_MODELE.'anneeScolaireFonctions.class.php';
	
	$pdo = PDO2::getInstance();
	$fonction = new AnneeScolaireFonctions($pdo);

    if($_SESSION['auth']['statut'] == 'Senseur' ) {
        $ecole = $_SESSION['auth']['ecole'];
    } elseif($_SESSION['auth']['statut'] == 'Ecole' ) {
            $ecole = $_SESSION['auth']['idEcole'];
            $inspection = $_SESSION['auth']['idInspection'];
      }

	//Sélection de l'identifiant de la dernière année scolaire enregistrée
    $idActuelIdAnSco = $fonction->getActuelIdAnSco($ecole);
    //Sélection de l'année scolaire selon l'identifiant 
    $anneeScolaire = $fonction->getAnneeScolaire($idActuelIdAnSco);
	
	if($_SESSION['auth']['statut'] == 'Senseur' ) {
        $ecole = $_SESSION['auth']['ecole'];
    } elseif($_SESSION['auth']['statut'] == 'Ecole' ) {
            $ecole = $_SESSION['auth']['idEcole'];
        }


	if (isset($_POST['cherche'])) {

		$matricule = $_POST['matricule'];

		$req = $pdo->prepare("SELECT * FROM eleve WHERE matricule=:matricule");
        $req->execute(['matricule'=>$matricule]);
        $eleve = $req->fetch();
	}
	
	include CHEMIN_VUE.'infosEleve.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}

?>