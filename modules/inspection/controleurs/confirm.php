<?php 

	include CHEMIN_CLASSPHP.'inspection.class.php';
	include CHEMIN_MODELE.'inspectionFonctions.class.php';

	
	$pdo = PDO2::getInstance();
	$fonction = new inspectionFonctions($pdo);

	session_start();

	$user_id = $_GET['id'];
	
	$token = $_GET['token'];

	//$user = $fonction->getUserPersonnel($user_id);

	$req=$pdo->prepare("SELECT * FROM inspection WHERE idInspection=?");

	$req->execute([$user_id]);
	$user = $req->fetch();

	if ($user && $user['confirmation_token'] == $token) {
 
		$req = $pdo->prepare("UPDATE inspection SET confirmation_token = NULL, confirmation_at = NOW() WHERE idInspection = ?"); 
		$req->execute([$user_id]);

        $_SESSION['flash']['success'] = "Votre compte a bien été validé";

		$_SESSION['auth'] = $user;

		header('Location: index.php?module=profil/&action=profil');
		exit();
	} else {

		$_SESSION['flash']['danger'] = "Ce token n'est plus valide";
		header('Location: index.php?module=login/&action=login');
        exit();

	}
