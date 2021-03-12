<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include CHEMIN_CLASSPHP.'noteSemestre.class.php';
	include CHEMIN_MODELE.'noteSemestreFonctions.class.php';

	include CHEMIN_CLASSPHP.'note.class.php';
	include CHEMIN_MODELE.'noteFonctions.class.php';

	include_once CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include_once CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	$pdo = PDO2::getInstance();

	$fonction = new NoteSemestreFonctions($pdo);
	$fonction1 = new AnneeScolaireFonctions($pdo);
	$fonction2 = new NoteFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu ajouter une note.
	if (isset($_POST['Calcul'])) {

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU NOM DU SEMESTRE
		if( $_POST['semestre'] == '-----selectionner-----') { // Vérifie si le semestre n'est pas renseignée          
            $errors['semestre'] = "Vous devez renseigner le 'semestre' ";
        }

        // VERIFICATION DE LA VALIDITE DU NOM DE LA CLASSE
		if( $_POST['classe'] == '-----selectionner-----') { // Vérifie si la serie n'est pas renseignée          
            $errors['classe'] = "Vous devez renseigner la 'nom' de la classe";
        }

        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if( empty($_POST['anneeScolaire'])) { // Vérifie si l'année scolaire n'est pas renseignée          
            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
        }

        $anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); 
		$idAnneeScolaire = $fonction1->getIdAnneeScolaire($anneeScolaire);

        $note2 = new NoteSemestre(array('nomSemestre' => $_POST['semestre'], 'classe' => $_POST['classe'], 'idAnneeScolaire' => $idAnneeScolaire, 'ecole' => $ecole));

        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
		if($fonction->existMoyGenerale($note2)) { // Si la moyenne de la classe est déja calculer          
            $errors['exitDeja'] = "Les moyennes de cette classe sont déja calculées";
        }

        //S'il y a pas d'erreur
	    if(empty($errors)) {

			$req = $pdo->prepare("SELECT eleve, nomSemestre, niveau, serie, classe, idAnneeScolaire, anneeScolaire FROM note
	                      WHERE note.nomSemestre='".$_POST['semestre']."'
	                        AND note.classe='".$_POST['classe']."'
	                        AND note.anneeScolaire='".$_POST['anneeScolaire']."' ");
	        $req->execute();
	      
	      if ($req){
	          
	        $nbreLigne = $req->fetchAll();
	        //var_dump($nbreLigne);
	        $i = 0;
	        foreach ($nbreLigne as $key => $value) {
	        	$i = ++$i; 

		        if ($i < $nbreLigne) {                       
		                      
			        $eleve = $value['eleve'];
			        $nomSemestre = $value['nomSemestre'];
			        $classe = $value['classe'];
			        $idAnneeScolaire = $value['idAnneeScolaire'];
			        $anneeScolaire = $value['anneeScolaire'];

			        $niveau = $value['niveau'];
			        $serie = $value['serie'];

			        

					$note1 = new Notes(array('eleve' => $eleve, 'niveau' => $niveau, 'serie' => $serie, 'classe' => $classe, 'idAnneeScolaire' => $idAnneeScolaire, 'ecole' => $ecole)); // On crée un nouveau enregistrement de note.

					$sumCoef = $fonction2->sumCoef($note1);

					$sumMoyX = $fonction2->sumMoyX($note1);
					
					$moyGenerale = ($sumMoyX / $sumCoef);

					$moyenneGenerale = new NoteSemestre(array('moyGenerale' => $moyGenerale)); // On crée un nouveau enregistrement de note.
					$appreciation = $fonction->appreciation($moyenneGenerale);

					$note = new NoteSemestre(array('nomSemestre' => $nomSemestre,'sumMoyX' => $sumMoyX,'sumCoef' => $sumCoef, 'moyGenerale' => $moyGenerale, 'appreciation' => $appreciation, 'eleve' => $eleve, 'classe' => $classe, 'idAnneeScolaire' => $idAnneeScolaire, 'ecole' => $ecole)); // On crée un nouveau enregistrement de note.
					
					/*if ($fonction->existNoteEleve($note->eleve())) {
						$message = "Cet(te) élève a déjà une note pour cette matière.";
						unset($note);
					} else {  */
					$fonction->addNoteSemestre($note); 

						$rang = new NoteSemestre(array('nomSemestre'=>$value['nomSemestre'], 'classe'=>$value['classe'], 'idAnneeScolaire'=>$value['idAnneeScolaire']));
					    $fonction -> rangSemestre($rang);
				}
			}
		 }
		    $_SESSION['flash']['success'] = "succé";
		    include CHEMIN_VUE.'listeMoyenne.php'; 		    
		} 

	} 
	
	include CHEMIN_VUE.'ajoutNoteSemestre.php'; 

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}

?>