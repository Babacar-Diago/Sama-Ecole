<?php
if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'matiere.class.php';
	include CHEMIN_MODELE.'matiereFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new MatiereFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une matière.
	if (isset($_POST['ajout'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DE LA SERIE
		if(empty($_POST['matiere'])){ // Vérifie si la matière n'est pas renseignée
            
            $errors['matiere'] = "Vous devez renseigner la matière";  
            
        } elseif($fonction->existMatiere($_POST['matiere'], $ecole)) { // Vérifie si la matière existe
            $errors['matiere'] = "Cette matière existe déjà";
            unset($_POST['matiere']);
         }

        //S'il y a pas d'erreur
        if(empty($errors)){

        	$matiere = new Matieres(array('nom' => $_POST['matiere'], 'ecole' => $ecole)); // On crée une nouvelle matiere.

			if( $matiere ) {
	
				$fonction->addMatiere($matiere);

				$_SESSION['flash']['success'] = "La matierè a été enregistrée avec succé";
				unset($_POST['serie']);
			} else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement de la matière a échoué. Veillez réessayer svp";
				unset($_POST['serie']);
			}
		}
	}  

	include CHEMIN_VUE.'ajoutMatiere.php';

} else{

		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
	    header("Location: index.php");
	    exit();
	}
?>