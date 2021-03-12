<?php

	include CHEMIN_CLASSPHP.'note.class.php';
	include CHEMIN_MODELE.'noteFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new NoteFonctions($pdo);

	// Si on a voulu ajouter une note.
	if (isset($_POST['ranger'])) {

	   $rang = new Notes(array('nomSemestre'=>$_POST['semestre'], 'matiere'=>$_POST['matiere']));
	    $fonction -> rangDevoir($rang);
		
		
		
		/*if ($fonction->existNoteEleve($note->eleve())) {
			$message = "Cet(te) élève a déjà une note pour cette matière.";
			unset($note);
		} else {  */
			//$fonction->addNote($note);
		//}
	}  

	include CHEMIN_VUE.'rangDevoir.php';
?>