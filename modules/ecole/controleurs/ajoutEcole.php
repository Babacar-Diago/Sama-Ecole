<?php

	include CHEMIN_CLASSPHP.'ecole.class.php';
	include CHEMIN_MODELE.'ecoleFonctions.class.php';

	include CHEMIN_CLASSPHP.'inspection.class.php';
	include CHEMIN_MODELE.'inspectionFonctions.class.php';
	include CHEMIN_FONCTIONS_GLOBALE.'fonctions.php';

	session_start();
	$pdo = PDO2::getInstance();
	$fonction = new EcoleFonctions($pdo);
	$fonction1 = new InspectionFonctions($pdo);
	$fonction2 = new globalFonctions($pdo);


	// Si on a voulu inscrir un personnel.
	if (isset($_POST['ajout'])) { 

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU NOM DE L'ECOLE
		if(empty($_POST['nomEcole'])){ // Vérifie si le format du nom est valide
            
            $errors['nomEcole'] = "Vous devez renseigner le nom de l'école";  
            
        } else { // Vérifie si le nom de l'école existe
 
			//$nom = $fonction->existEcole($_POST['nomEcole']);
			$req = $pdo->prepare('SELECT idEcole FROM ecole WHERE nomEcole=?');           
            $req->execute([$_POST['nomEcole']]);
            
            $pseudo = $req->fetch();

            if($pseudo){
                $errors['nomEcole']= "Ce nom d'école existe déjà.";
            }
        }

        if(empty($_POST['telephone1'])){ // Vérifie si le n° de téléphone est renseigné
            
            $errors['nomEcole'] = "Vous devez renseigner le numéro de téléphone mobile";  
            
        }

        // VERIFICATION DE LA VALIDITE DU MAIL
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // Vérifie si le format du mail est valide

            $errors['email'] = "Votre email n'est pas valide";

        } else { // Vérifie si le mail existe
            
            //$email = $fonction->existMail($_POST['email']);
            $req = $pdo->prepare('SELECT idEcole FROM ecole WHERE email=?');
            
            $req->execute([ $_POST['email']]);
            
            $email = $req->fetch();

            if($email){
                $errors['email']= "Cet email est déjà utiliser pour un autre compte";
            }
        }

        // VERIFICATION DU MOT DE PASSE
        if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp_confirm']){
            $errors['mdp'] = "Les deux mot de passe ne correspondent pas";  
        }

        //S'il y a pas d'erreur
        if(empty($errors)){

        	//$inspection = new Inspection(array('nomInspection' => $_POST['nomInspection'])); 
			$idInspection = $fonction1->getIdInspection($_POST['nomInspection']);

			$mdp = password_hash( htmlspecialchars($_POST['mdp']), PASSWORD_BCRYPT);
            
            $token = $fonction2->str_random(60);

            $ecole = new Ecole(array('nomEcole' => htmlspecialchars($_POST['nomEcole']), 'email' => htmlspecialchars($_POST['email']), 'telefax' => htmlspecialchars($_POST['telefax']), 'telephone1' => htmlspecialchars($_POST['telephone1']), 'telephone2' => htmlspecialchars($_POST['telephone2']), 'BP' => htmlspecialchars($_POST['BP']), 'commune' => htmlspecialchars($_POST['commune']), 'nomInspection' => htmlspecialchars($_POST['nomInspection']), 'idInspection' => $idInspection, 'motDePasse' => $mdp, 'confirmation_token' => $token)); // On crée une nouvelle école.

            $fonction->addEcole($ecole);

            $user_id = $pdo->lastInsertId();  //Renvoi le dernier id qui a été générer
           
            mail(htmlspecialchars($_POST['email']), 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost".$_SERVER['PHP_SELF']."?module=ecole/&action=confirm&id=".$user_id."&token=".$token );

            $_SESSION['flash']['success'] = "Un mail de confirmation a été envoyé pour valider l'inscription";
            
            //include CHEMIN_VUE.'ajoutEcole.php';
            
        }

	} 
	include CHEMIN_VUE.'ajoutEcole.php';

?>