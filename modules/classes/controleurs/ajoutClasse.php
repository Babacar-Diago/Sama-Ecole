<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'classe.class.php';
	include CHEMIN_MODELE.'classeFonctions.class.php';

	include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new ClasseFonctions($pdo);
	$fonction1 = new AnneeScolaireFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une classe.
	if (isset($_POST['ajouter'])) {

		$anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); 
			$idAnneeScolaire = $fonction1->getIdAnneeScolaire($anneeScolaire);
			
		$errors = array();

		// VERIFICATION DE LA VALIDITE DU NOM DE LA CLASSE
		if(empty($_POST['nom'])){ // Vérifie si le nom de la classe n'est pas renseignée           
            $errors['nom'] = "Vous devez renseigner le 'nom de la classe' ";
        }

        // VERIFICATION DE LA VALIDITE DU NIVEAU
		if( $_POST['niveau'] == '-----selectionner-----'){ // Vérifie si le niveau n'est pas renseignée          
            $errors['niveau'] = "Vous devez renseigner le 'niveau' de la classe";
        }

   		// VERIFICATION DE LA VALIDITE DE LA SERIE
		if( $_POST['serie'] == '-----selectionner-----'){ // Vérifie si la serie n'est pas renseignée          
            $errors['serie'] = "Vous devez renseigner la 'serie' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if( $_POST['anneeScolaire'] == '-----selectionner-----'){ // Vérifie si l'année scolaire n'est pas renseignée          
            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
        }

        // VERIFICATION DE LA VALIDITE DU NOMBRE D'ELEVE LA CLASSE
		if(empty($_POST['nombreEleves'])){ // Vérifie si le nombre d'élèves la classe n'est pas renseignée           
            $errors['nombreEleves'] = "Vous devez renseigner le 'nombre d'élèves' de la classe";
        } 

        // VERIFICATION DE LA VALIDITE DE LA CLASSE
		if($fonction->existClasse($_POST['nom'], $idAnneeScolaire, $ecole)){ // Vérifie si le nombre d'élèves la classe n'est pas renseignée           
            $errors['classe'] = "Cette 'nom de classe' existe déja";
        } 

        //S'il y a pas d'erreur
        if(empty($errors)){

			$classe = new Classes(array('nom' => $_POST['nom'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'nombreEleves' => $_POST['nombreEleves'], 'idAnneeScolaire' => $idAnneeScolaire, 'ecole' => $ecole)); // On crée une nouvelle classe.
			if ($classe) {	

				$fonction->addClasse($classe);

				$_SESSION['flash']['success'] = "La classe a été enregistré avec succé";

			} else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement de la classe a échoué. Veillez réessayer svp";
			}
		}
	}  

	include CHEMIN_VUE.'ajoutClasse.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}
?>