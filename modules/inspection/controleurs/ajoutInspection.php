<?php

	include CHEMIN_CLASSPHP.'inspection.class.php';
	include CHEMIN_MODELE.'inspectionFonctions.class.php';
	include CHEMIN_FONCTIONS_GLOBALE.'fonctions.php';


	session_start();
	$pdo = PDO2::getInstance();
	$fonction = new inspectionFonctions($pdo);
	$fonction1 = new globalFonctions($pdo);


		// Si on a voulu inscrir un personnel.
	if (isset($_POST['ajouter'])) { 

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU NOM
		if(empty($_POST['nomInspection'])){ // Vérifie si le format du nom est valide
            
            $errors['nomInspection'] = "Le nom d'inspection n'est pas valide";  
            
        } else { // Vérifie si le nom existe
 
	//$pseudo = $fonction->exisNomInspection($_POST['nomInspection']);
			$req = $pdo->prepare('SELECT idInspection FROM inspection WHERE nomInspection=?');           
            $req->execute([$_POST['nomInspection']]);
            
            $pseudo = $req->fetch();

            if($pseudo){
                $errors['nomInspection']= "Ce nom d'inspection est déjà pris";
                unset($_POST['nomInspection']);
            }
        }

        // VERIFICATION DE LA VALIDITE DU MAIL
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // Vérifie si le format du mail est valide

            $errors['email'] = "Votre email n'est pas valide";

        } else { // Vérifie si le mail existe
            
            //$email = $fonction->existMail($_POST['email']);
            $req = $pdo->prepare('SELECT idInspection FROM inspection WHERE email=?');
            
            $req->execute([ $_POST['email']]);
            
            $email = $req->fetch();

            if($email){
                $errors['email']= "Cet email est déjà utiliser pour un autre compte";
                unset($_POST['email']);
            }
        }

        // VERIFICATION DU MOT DE PASSE
        if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp_confirm']){
            $errors['mdp'] = "Les deux mot de passe ne correspondent pas";  
        }

        //S'il y a pas d'erreur
        if(empty($errors)){

			$mdp = password_hash( htmlspecialchars($_POST['mdp']), PASSWORD_BCRYPT);
            
            $token = $fonction1->str_random(60);

            $inspection = new Inspection(array('nomInspection' => $_POST['nomInspection'], 'region' => $_POST['region'], 'departement' => $_POST['departement'], 'email' => $_POST['email'], 'telefax' => $_POST['telefax'], 'telephone1' => $_POST['telephone1'], 'telephone2' => $_POST['telephone2'], 'BP' => $_POST['BP'], 'motDePasse' => $mdp, 'confirmation_token' => $token)); // On crée un nouveau personnel.

            $fonction->addInspection($inspection);

            $user_id = $pdo->lastInsertId();  //Renvoi le dernier id qui a été générer
           
            //$user_id = htmlentities($_POST['pseudo']);  
             //Renvoi le dernier id qui a été générer

            mail(htmlspecialchars($_POST['email']), 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost".$_SERVER['PHP_SELF']."?module=inspection/&action=confirm&id=".$user_id."&token=".$token );

            $_SESSION['flash']['success'] = "Un mail de confirmation a été envoyé pour valider l'inscription";
            
            include CHEMIN_VUE.'ajoutInspection.php';
            //exit();
        }

	} 
		include CHEMIN_VUE.'ajoutInspection.php';