<?php
	include CHEMIN_MODELE.'loginFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new LoginFonctions($pdo);
	session_start();
	// Si on a voulu ajouter une matiere.
	if (isset($_POST['Connexion'])  && !empty($_POST['login']) && !empty($_POST['mdp'])) {

		$login=htmlspecialchars($_POST['login']);
		$mdp=htmlspecialchars($_POST['mdp']);

		$fonction->Traitement($login, $mdp);
		exit();
		
	} elseif( !empty($_POST) && ( empty($_POST['login']) ||empty($_POST['mdp']))) {

		    $_SESSION['flash']['danger'] = 'Veuillez remplire tous les champs';
		    include CHEMIN_VUE.'login.php';

	} else{
		include CHEMIN_VUE.'login.php';
	}