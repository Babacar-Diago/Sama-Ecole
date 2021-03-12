<?php
if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new AnneeScolaireFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une annee scolaire.
	if (isset($_POST['ajouter'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if(empty($_POST['anneeScolaire'])){ // Vérifie si l'année scolaire n'est pas renseignée
            
            $errors['anneeScolaire'] = "Vous devez renseigner l'année scolaire";  
            
        } elseif($fonction->existAnneeScolaire($_POST['anneeScolaire'])) { // Vérifie si l'année scolaire existe
 
                $errors['anneeScolaire']= "Cette année scolaire existe déjà";
                unset($_POST['anneeScolaire']);
            }

        //S'il y a pas d'erreur
        if(empty($errors)){
		
		 $anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); // On crée une nouvelle annee scolaire.
		
			if( $anneeScolaire ) {

				$fonction->addAnneeScolaire($anneeScolaire);

				$_SESSION['flash']['success'] = "L'année scolaire a été enregistré avec succé";
				unset($_POST['anneeScolaire']);
			} else{

				$_SESSION['flash']['danger'] = " Oups! L'enregistrement de l'année scolaire a échoué. Veillez réessayer svp";
				unset($_POST['anneeScolaire']);
			}
		}
	}

	include CHEMIN_VUE.'ajoutAnneeScolaire.php';
} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}
?>