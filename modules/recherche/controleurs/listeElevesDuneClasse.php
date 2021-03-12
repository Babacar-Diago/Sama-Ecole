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

    //Sélection de l'identifiant de la dernière année scolaire enregistrée
    $idActuelAnScol = $fonction->getActuelIdAnSco($ecole);
    //Sélection de l'année scolaire selon l'identifiant 
    $actuelAnScol = $fonction->getAnneeScolaire($idActuelAnScol);

	if (isset($_POST['liste'])) {

		$errors = array();
		// VERIFICATION DE LA VALIDITE DU NIVEAU
		if( empty($_POST['niveau'])){ // Vérifie si le niveau n'est pas renseignée          
            $errors['niveau'] = "Vous devez renseigner le 'niveau' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DU NOM DE LA CLASSE
		if( empty($_POST['classe'])){ // Vérifie si la serie n'est pas renseignée          
            $errors['classe'] = "Vous devez renseigner la 'nom' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if( empty($_POST['anneeScolaire'])){ // Vérifie si l'année scolaire n'est pas renseignée          
            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
        }

        //S'il y a pas d'erreur
	    if(empty($errors)) {

        	$anneeScolaireId = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole));
        	 
			$idAnneeScolaire = $fonction->getIdAnneeScolaire($anneeScolaireId);
   		    $anneeScolaire = $fonction->getAnneeScolaire($idAnneeScolaire);

		}
		
	}
	
	include CHEMIN_VUE.'listeElevesDuneClasse.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}

?>