<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'eleve.class.php';
	include CHEMIN_MODELE.'EleveFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new EleveFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu inscrir un élève.
	if (isset($_POST['inscrir'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DE LA MATRICULE
		if(empty($_POST['matricule'])){ // Vérifie si la matricule est valide
            
            $errors['matricule'] = "Le matricule doit être renseigner";  
            
        } elseif($fonction->existEleve($_POST['matricule'], $ecole)) { // Vérifie si la matricule existe
            $errors['matricule'] = "Cette matricule existe déjà";
            unset($_POST['matricule']);
         }

        // VERIFICATION DE LA VALIDITE DU NOM
		if(empty($_POST['nom'])){ // Vérifie si le nom est valide
            $errors['matricule'] = "Le matricule doit être renseigner";  
        }

        // VERIFICATION DE LA VALIDITE DU PRENOM
		if(empty($_POST['prenom'])){ // Vérifie si le prénom est valide
            $errors['matricule'] = "Le matricule doit être renseigner";  
        } 
        
        // VERIFICATION DE LA VALIDITE DU MAIL
        if(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // Vérifie si le format du mail est valide
            $errors['email'] = "Votre email n'est pas valide";

        } elseif($fonction->existMail($_POST['email'])) { // Vérifie si le mail existe
                $errors['email']= "Cet email est déjà utiliser pour un autre élève";
                unset($_POST['email']);
        }

        //S'il y a pas d'erreur
        if(empty($errors)){

		$eleve = new Eleves(array('matricule' => $_POST['matricule'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'sexe' => $_POST['sexe'], 'dateNaissance' => $_POST['dateNaissance'], 'lieuNaissance' => $_POST['lieuNaissance'], 'origine' => $_POST['origine'], 'motifEntre' => $_POST['motifEntre'], 'numeroTel' => $_POST['numeroTel'], 'email' => $_POST['email'], 'ecole' => $ecole)); // On crée un nouveau eleve.

			$fonction->addEleve($eleve);

			$_SESSION['flash']['success'] = "L'élève a été ajouté avec succé dans la liste des élèves de votre établissement";
		}
	}

	include CHEMIN_VUE.'inscritEleve.php';

} else{

		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
	    header("Location: index.php");
	    exit();
	}
?>