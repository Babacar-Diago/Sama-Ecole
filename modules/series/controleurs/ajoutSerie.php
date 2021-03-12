<?php
if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'serie.class.php';
	include CHEMIN_MODELE.'serieFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new SerieFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une serie.
	if (isset($_POST['ajouter'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DE LA SERIE
		if(empty($_POST['serie'])){ // Vérifie si la série n'est pas renseignée
            
            $errors['serie'] = "Vous devez renseigner la série";  
            
        } elseif($fonction->existSerie($_POST['serie'], $ecole)) { // Vérifie si la série existe
            $errors['serie'] = "Cette série existe déjà";
            unset($_POST['serie']);
         }

        //S'il y a pas d'erreur
        if(empty($errors)){

        	$serie = new Serie(array('serie' => $_POST['serie'], 'ecole' => $ecole)); // On crée une série.

			if( $serie ) {
	
				$fonction->addSerie($serie);

				$_SESSION['flash']['success'] = "La série a été enregistrée avec succé";
				unset($_POST['serie']);
			} else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement de la séerie a échoué. Veillez réessayer svp";
				unset($_POST['serie']);
			}
		}
	}  

	include CHEMIN_VUE.'ajoutSerie.php';

} else{

		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
	    header("Location: index.php");
	    exit();
	}
?>