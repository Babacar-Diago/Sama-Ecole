<?php
if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'niveau.class.php';
	include CHEMIN_MODELE.'niveauFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new NiveauFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter un niveau.
	if (isset($_POST['ajouter'])) {

		$errors = array();
		
		// VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if(empty($_POST['niveau'])){ // Vérifie si le niveau n'est pas renseigné
            
            $errors['niveau'] = "Vous devez renseigner le niveau";  
            
        } elseif($fonction->existNiveau($_POST['niveau'], $ecole)) { // Vérifie si le niveau existe
            $errors['niveau'] = "Ce niveau existe déjà";
            unset($_POST['niveau']);
         }

        //S'il y a pas d'erreur
        if(empty($errors)){

        	$niveau = new Niveau(array('niveau' => $_POST['niveau'], 'ecole' => $ecole)); // On crée un niveau.

			if( $niveau ) {
		
				$fonction->addNiveau($niveau);

				$_SESSION['flash']['success'] = "Le niveau a été enregistré avec succé";
				unset($_POST['niveau']);
			}else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement du niveau a échoué. Veillez réessayer svp";
				unset($_POST['niveau']);
			}
		} 
	} 

	include CHEMIN_VUE.'ajoutNiveau.php';

} else{

		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
	    header("Location: index.php");
	    exit();
	}
?>