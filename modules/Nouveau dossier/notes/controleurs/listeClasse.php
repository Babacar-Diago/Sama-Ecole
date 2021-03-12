<?php

	include CHEMIN_CLASSPHP.'note.class.php';
	include CHEMIN_MODELE.'noteFonctions.class.php';

	include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';
			 		//include CHEMIN_CONTROLEUR.'ajoutNote.php';

	$pdo = PDO2::getInstance();
	$fonction = new NoteFonctions($pdo);
	$fonction1 = new AnneeScolaireFonctions($pdo);
	if (!empty($_POST['niveau']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire']) ) {	

		include CHEMIN_VUE.'ajoutNote.php';
            //var_dump($nbreLigne);

		//header('Location: index.php?module=notes/&amp;action=ajoutNote');
 		//include CHEMIN_CONTROLEUR.'ajoutNote.php';
				 	
	} elseif (!empty($_POST['semestre']) && !empty($_POST['matiere']) && !empty($_POST['serie'] )) {
		include CHEMIN_CONTROLEUR.'ajoutNote.php';
	} else{ 
		include CHEMIN_VUE.'listeClasse.php';
		}
?>