<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'avoirMatiere.class.php';
	include CHEMIN_MODELE.'avMatFonction.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new AvMatFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une matière.
	if (isset($_POST['ajouter'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DE LA MATIERE
		if($_POST['matiere'] == '-----selectionner-----'){ // Vérifie si le nom de la matiere n'est pas renseignée           
            $errors['matiere'] = "Vous devez renseigner le nom de la 'matière' ";
        }

        // VERIFICATION DE LA VALIDITE DU NIVEAU
		if( $_POST['niveau'] == '-----selectionner-----'){ // Vérifie si le niveau n'est pas renseignée          
            $errors['niveau'] = "Vous devez renseigner le 'niveau' de la classe";
        }

   		// VERIFICATION DE LA VALIDITE DE LA SERIE
		if( $_POST['serie'] == '-----selectionner-----'){ // Vérifie si la serie n'est pas renseignée          
            $errors['serie'] = "Vous devez renseigner la 'serie' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DU COEF DE LA MATIERE
		if(empty($_POST['coef'])){ // Vérifie si le coef d'élèves la matirere n'est pas renseignée           
            $errors['coef'] = "Vous devez renseigner le 'coef' de la matière";
        } 

        // VERIFIE S'IL Y'A PAS DOUBLON
		if($fonction->existCoefMatiere($_POST['matiere'], $_POST['niveau'], $_POST['serie'], $ecole)){ // Vérifie si le nombre d'élèves la classe n'est pas renseignée           
            $errors['classe'] = "Ce coef existe déja";
        } 

		//S'il y a pas d'erreur
        if(empty($errors)){

			$coefMatiere = new AvoirMatiere(array('matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'coef' => $_POST['coef'], 'ecole' => $ecole)); // On crée le coef d'une matière.
			
			if ($coefMatiere) {	

					$fonction->addAvMatiere($coefMatiere);

					$_SESSION['flash']['success'] = "Le coef a été enregistré avec succé";

				} else{

					$_SESSION['flash']['danger'] = " Oups! L'enregistrement du coef a échoué. Veillez réessayer svp";
				}

			//$nomMatiere = new AvoirMatiere(array('niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'ecole' => $ecole));

			//$matiere= $fonction->getNomMatiere($nomMatiere);	    	
				
			}
	}  

	include CHEMIN_VUE.'ajoutAvMatiere.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}

?>