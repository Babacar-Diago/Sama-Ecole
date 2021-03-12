<?php

	//include CHEMIN_CLASSPHP.'note.class.php';
	//include CHEMIN_MODELE.'noteFonctions.class.php';

	//include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	//include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	//$pdo = PDO2::getInstance();
	//$fonction = new NoteFonctions($pdo);
	//$fonction1 = new AnneeScolaireFonctions($pdo);
if (!empty($_POST['niveau']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire']) ) {
				 	
	// Si on a voulu ajouter une note.
	if (isset($_POST['valider'])) {


		$req = $pdo->prepare("SELECT eleve FROM etreeleve
                      WHERE etreeleve.niveau='".$_POST['niveau']."'
                        AND etreeleve.classe='".$_POST['classe']."'
                        AND etreeleve.anneeScolaire='".$_POST['anneeScolaire']."' ");
                   $req->execute();
                  
                  if ($req){
                      
                      $nbreLigne = $req->fetchAll();
                      //var_dump($nbreLigne);

                      $i = 0;
                      
                      	
                      foreach ($nbreLigne as $key => $value) {
                      $i = ++$i; 

                      if(isset($_POST['devoir'])) {                   
                          foreach($_POST['devoir'] as $devoir_) {

                          	if(isset($_POST['composition'])) {                   
                          foreach($_POST['composition'] as $composition_) {

        $eleve = $value[0];
		$devoir = $devoir_;
		$composition = $composition_;
		$moyenne = (($devoir + $composition)/2);

		$note1 = new Notes(array('matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'])); // On crée un nouveau enregistrement de note.

		$coef = $fonction->coef($note1);
		$moyenneX = ($moyenne * $coef);

		$anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'])); 
		$idAnneeScolaire = $fonction1->getIdAnneeScolaire($anneeScolaire);
		
		$note = new Notes(array('nomSemestre' => $_POST['semestre'], 'noteDevoir' => $devoir, 'noteComposition' => $composition, 'moyenne' => $moyenne, 'moyenneX' => $moyenneX, 'eleve' => $eleve, 'matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'classe' => $_POST['classe'], 'idAnneeScolaire' => $idAnneeScolaire, 'anneeScolaire' => $_POST['anneeScolaire'])); // On crée un nouveau enregistrement de note.
		
		/*if ($fonction->existNoteEleve($note->eleve())) {
			$message = "Cet(te) élève a déjà une note pour cette matière.";
			unset($note);
		} else {  */
			$fonction->addNote($note);

		$rang = new Notes(array('nomSemestre'=>$_POST['semestre'], 'matiere'=>$_POST['matiere']));
	    	$fonction -> rangDevoir($rang);
	}}}}
	}	//}
	} else {echo "La requete n a pas ete executee.";}
} }else{$message = "Cet(te) élève a déjà une note pour cette matière.";}

	include CHEMIN_VUE.'ajoutNote.php';

?>