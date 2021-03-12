<?php

	// Identifiants pour la base de données. Nécessaires à PDO2.
	// [...]
	// Chemins à utiliser pour accéder aux vues/modèles/librairies
	// [...]
	// Configurations relatives à l'avatar
	define('AVATAR_LARGEUR_MAXI', 100);
	define('AVATAR_HAUTEUR_MAXI', 100);

	// Identifiants pour la base de données. Nécessaires a PDO2.
	define('SQL_DSN', 'mysql:dbname=ecole;host=localhost');
	define('SQL_USERNAME', 'root');
	define('SQL_PASSWORD', '');

	// Chemins à utiliser pour accéder aux vues/modeles/librairies
	$module = empty($module) ? !empty($_GET['module']) ? $_GET['module'] : 'index' : $module;
	define('DOSSIER_AVATAR', 'images/avatars/');
	define('CHEMIN_MODELE', 'modeles/');
	define('CHEMIN_VUE', 'modules/'.$module.'/vues/');	
	define('CHEMIN_CONTROLEUR', 'modules/'.$module.'/controleurs/');	
	define('CHEMIN_LIB', 'libs/');
	define('CHEMIN_CLASSPHP', 'classePHP/');

	define('CHEMIN_VUE_PROFIL', 'modules/profil/vues/');
	define('CHEMIN_CONTROLEUR_PROFIL', 'modules/profil/controleurs/');
	define('CHEMIN_FONCTIONS_GLOBALE', 'global/');