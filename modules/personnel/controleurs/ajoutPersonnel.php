<?php

if (session_status() == PHP_SESSION_NONE) {
        session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'personnel.class.php';
	include CHEMIN_MODELE.'PersonnelFonctions.class.php';

	include CHEMIN_CLASSPHP.'ecole.class.php';
	include CHEMIN_MODELE.'ecoleFonctions.class.php';
	include CHEMIN_FONCTIONS_GLOBALE.'fonctions.php';

	$pdo = PDO2::getInstance();
	$fonction = new PersonnelFonctions($pdo);
	$fonction2 = new globalFonctions($pdo);
    
    if($_SESSION['auth']['statut'] == 'Senseur' ) {
        $ecole = $_SESSION['auth']['ecole'];
    } elseif($_SESSION['auth']['statut'] == 'Senseur' ) {
            $ecole = $_SESSION['auth']['idEcole'];
        }

	// Si on a voulu inscrir un personnel.
	if (isset($_POST['ajout'])) { 

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU PSEUDO
		if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){ // Vérifie si le format du pseudo est valide
            $errors['identifiant'] = "Votre Pseudo n'est pas valide";  
            
        } elseif($fonction->existPseudo($_POST['pseudo'], $ecole)) { // Vérifie si le pseudo existe
                $errors['identifiant']= "Ce pseudo est déjà pris";
                unset($_POST['pseudo']);
        }
        
        // VERIFICATION DE LA VALIDITE DU MAIL
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // Vérifie si le format du mail est valide

            $errors['email'] = "Votre email n'est pas valide";

        } elseif($fonction->existMail($_POST['email'])) { // Vérifie si le mail existe
                $errors['email']= "Cet email est déjà utiliser pour un autre compte";
                unset($_POST['email']);
        }

        // VERIFICATION DU MOT DE PASSE
        if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp_confirm']){
            $errors['mdp'] = "Les deux mot de passe ne correspondent pas";  
        }

        //S'il y a pas d'erreur
        if(empty($errors)){
 
			$mdp = password_hash( htmlspecialchars($_POST['mdp']), PASSWORD_BCRYPT);
            
            $token = $fonction2->str_random(60);

            $personnel = new Personnel(array('pseudo' => $_POST['pseudo'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'sexe' => $_POST['sexe'], 'statut' => $_POST['statut'], 'telephone' => $_POST['telephone'], 'email' => $_POST['email'], 'motDePasse' => $mdp, 'ecole' => $ecole, 'confirmation_token' => $token)); // On crée un nouveau personnel.

            $fonction->addPersonnel($personnel);

            $user_id = $pdo->lastInsertId();  //Renvoi le dernier id qui a été générer
           
            mail(htmlspecialchars($_POST['email']), 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost".$_SERVER['PHP_SELF']."?module=personnel/&action=confirm&id=".$user_id."&token=".$token );

            $_SESSION['flash']['success'] = "Un mail de confirmation a été envoyé pour valider l'inscription";
        }

	} 
		include CHEMIN_VUE.'ajoutPersonnel.php';

} else{

        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
        header("Location: index.php");
        exit();
    }


