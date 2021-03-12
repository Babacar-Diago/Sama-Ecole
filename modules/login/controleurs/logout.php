<?php  

	session_start();
	setcookie('remember', NULL, -1);

	unset($_SESSION['auth']);

	$_SESSSION['flash']['success'] = "Vous êtes maintenant déconnecté";

	header('Location: index.php');
	exit();
?>