<?php

	include CHEMIN_CLASSPHP.'niveauSerie.class.php';
	include CHEMIN_MODELE.'niveauFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new NiveauFonctions($pdo);

	// Si on a voulu ajouter un niveau.
	if (isset($_POST['ajouter']) && isset($_POST['niveau']) && isset($_POST['serie'])) {
		$niveau = new NiveauSerie(array('niveau' => $_POST['niveau'], 'serie' => $_POST['serie'])); // On crée un nouveau niveau.
		
		if (!$niveau->nomValide()) {
			$message = "Le niveau choisi est invalide.";
			unset($niveau); 
			
		} elseif ($fonction->existNiveau($_POST['niveau'])) {

			if ($fonction->existSerie($_POST['serie'])) {
			
				$message = "<h4>".$niveau->niveau()." ".$niveau->serie()."</h4> existe déjà.";
				unset($niveau);
			} 
		} else {
			$fonction->addNiveau($niveau);
		}
	}  

	include CHEMIN_VUE.'ajoutNiveau.php';
?>