<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'etreEleve.class.php';
	include CHEMIN_MODELE.'etreEleveFonctions.class.php';

	include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new EtreEleveFonctions($pdo);
	$fonction1 = new AnneeScolaireFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	//Sélection de l'identifiant de la dernière année scolaire enregistrée
    $idAnneeScolaire = $fonction1->getActuelIdAnSco($ecole);
    //Sélection de l'année scolaire selon l'identifiant 
    $anneeScolaire = $fonction1->getAnneeScolaire($idAnneeScolaire);

	// Si on a voulu inscrir un élève.
	if (isset($_POST['inscrir'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU NIVEAU
		if( $_POST['niveau'] == '-----selectionner-----'){ // Vérifie si le niveau n'est pas renseignée          
            $errors['niveau'] = "Vous devez renseigner le 'niveau' de la classe";
        }

   		// VERIFICATION DE LA VALIDITE DE LA SERIE
		if( $_POST['serie'] == '-----selectionner-----'){ // Vérifie si la serie n'est pas renseignée          
            $errors['serie'] = "Vous devez renseigner la 'serie' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DU NOM DE LA CLASSE
		if( $_POST['classe'] == '-----selectionner-----'){ // Vérifie si la serie n'est pas renseignée          
            $errors['classe'] = "Vous devez renseigner la 'nom' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if( $_POST['anneeScolaire'] == '-----selectionner-----'){ // Vérifie si l'année scolaire n'est pas renseignée          
            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
        }

        // VERIFIE SI L'ELEVE N'EST PA DEJA INSCRIT
		if($fonction->dejaInsctit($_POST['eleve'], $_POST['niveau'], $idAnneeScolaire, $ecole)){ // Vérifie si le nombre d'élèves la classe n'est pas renseignée           
            $errors['dejaInsctit'] = "Cet(te) élève est déja inscrit pour cette année scolaire";
        } 

        //S'il y a pas d'erreur
        if(empty($errors)){

        	//$date=NOW();
    		$eleve = new EtreEleve(array('eleve' => $_POST['eleve'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'classe' => $_POST['classe'], 'idAnneeScolaire' => $idAnneeScolaire, 'classeDoublee' => $_POST['classeDoublee'], 'ecole' => $ecole )); // On inscrit un eleve dans une classe.
    		//$fonction->addEtreEleve($eleve);
    		$inscrir = (bool) $fonction->addEtreEleve($eleve);
		
		if ($inscrir=1) {
		
			$_SESSION['flash']['success'] = "L'élève a été inscrit avec succé";
		} else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement de la classe a échoué. Veillez réessayer svp";
			} 
		}
	}

	include CHEMIN_VUE.'etreEleve.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}
?>