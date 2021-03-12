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
        }


	if (isset($_POST['liste'])) {

		$anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); 
		$idAnneeScolaire = $fonction->getIdAnneeScolaire($anneeScolaire);
	}
	
	include CHEMIN_VUE.'bulletinDunEleve.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}

?>