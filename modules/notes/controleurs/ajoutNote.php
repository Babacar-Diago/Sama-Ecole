<?php

if (session_status() == PHP_SESSION_NONE) {
    	session_start();
 }
if (isset($_SESSION['auth'])){

	include_once CHEMIN_CLASSPHP.'note.class.php';
	include_once CHEMIN_MODELE.'noteFonctions.class.php';

	include_once CHEMIN_CLASSPHP.'enseigner.class.php';
	include_once CHEMIN_MODELE.'enseignerFonctions.class.php';

	include_once CHEMIN_CLASSPHP.'avoirMatiere.class.php';
	include_once CHEMIN_MODELE.'avMatFonction.class.php';

	include_once CHEMIN_CLASSPHP.'anneeScolaire.class.php';
	include_once CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

	include_once CHEMIN_CLASSPHP.'etreEleve.class.php';
	include_once CHEMIN_MODELE.'etreEleveFonctions.class.php';

	$pdo = PDO2::getInstance();
	$fonction = new NoteFonctions($pdo);
	$fonction1 = new AnneeScolaireFonctions($pdo);
	$fonction2 = new EnseignerFonctions($pdo);
	$fonction3 = new AvMatFonctions($pdo);
	$fonction4 = new EtreEleveFonctions($pdo);
	$ecole = $_SESSION['auth']['ecole']; 
	$prof = $_SESSION['auth']['identifiant']; 

    //Sélection de l'identifiant de la dernière année scolaire enregistrée
    $idAnneeScolaire = $fonction1->getActuelIdAnSco($ecole);
    //Sélection de l'année scolaire selon l'identifiant 
    $anneeScolaire = $fonction1->getAnneeScolaire($idAnneeScolaire);
	
		$errors = array();

		// Si on a voulu ajouter une note.
		if (isset($_POST['liste'])) {

			// VERIFICATION DE LA VALIDITE DU NIVEAU
			if( empty($_POST['niveau'])){ // Vérifie si le niveau n'est pas renseignée          
	            $errors['niveau'] = "Vous devez renseigner le 'niveau' de la classe";
	        }

	        // VERIFICATION DE LA VALIDITE DU NOM DE LA CLASSE
			if( empty($_POST['classe'])){ // Vérifie si la serie n'est pas renseignée          
	            $errors['classe'] = "Vous devez renseigner la 'nom' de la classe";
	        }

	        // VERIFICATION DE LA VALIDITE DE L'ANNEE SCOLAIRE
			if( empty($_POST['anneeScolaire'])){ // Vérifie si l'année scolaire n'est pas renseignée          
	            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
	        }
	    }
	   		
		if (isset($_POST['valider'])) {  

			// VERIFICATION DE LA VALIDITE DU NOM DE LA SERIE
			if( empty($_POST['semestre'])){ // Vérifie si le nom du Semestre n'est pas renseignée          
	            $errors['semestre'] = "Vous devez renseigner le 'nom du Semestre' ";
	        }

	        // VERIFICATION DE LA VALIDITE DU NOM DE LA MATIERE
			if( empty($_POST['matiere'])){ // Vérifie si le nom de la matière n'est pas renseignée          
	            $errors['matiere'] = "Vous devez renseigner le 'nom de la matière' ";
	        }

	        // VERIFICATION DE LA VALIDITE DU NOM DE LA SERIE
			if( empty($_POST['serie'])){ // Vérifie si le nom de la série n'est pas renseignée          
	            $errors['serie'] = "Vous devez renseigner ' le nom de la série ' ";
	        }
		

			//S'il y a pas d'erreur
	        if(empty($errors)) {

				$anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); 
				$idAnneeScolaire = $fonction1->getIdAnneeScolaire($anneeScolaire);

				$req = $pdo->prepare("SELECT eleve FROM etreeleve
		                      WHERE etreeleve.niveau='".$_POST['niveau']."'
		                        AND etreeleve.classe='".$_POST['classe']."'
		                        AND etreeleve.idAnneeScolaire='".$idAnneeScolaire."' 
		                        AND etreeleve.ecole='".$ecole."' ");
		        $req->execute();
		                  
			    if ($req){
			          
			        $nbreLigne = $req->fetchAll();
			        //var_dump($nbreLigne);
			        $i = 0;
			        foreach ($nbreLigne as $key => $value) {
			            $i = ++$i; 

			            if ($i < $nbreLigne) { 
			          
			          //$i = ++$i; 
						    if (isset($_POST['devoir'.$i])) {
			              		$devoir = $_POST['devoir'.$i]; 

			              	   if (isset($_POST['composition'.$i])) {
			              			$composition = $_POST['composition'.$i];
							        $eleve = $value[0];
									//$devoir = $devoir;
									//$composition = $composition;
									$moyenne = (($devoir + $composition)/2);

									$note1 = new AvoirMatiere(array('matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'],'ecole' => $ecole)); // On crée un nouveau enregistrement de note.

									$coef = $fonction3->coef($note1);
									$moyenneX = ($moyenne * $coef);

									$moyenne1 = new Notes(array('moyenne' => $moyenne)); // On crée un nouveau enregistrement de note.
									$appreciation = $fonction->appreciation($moyenne1);
									
									$note = new Notes(array('nomSemestre' => $_POST['semestre'], 'noteDevoir' => $devoir, 'noteComposition' => $composition, 'moyenne' => $moyenne, 'coef' => $coef, 'moyenneX' => $moyenneX, 'appreciation' => $appreciation, 'eleve' => $eleve, 'matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'serie' => $_POST['serie'], 'classe' => $_POST['classe'], 'idAnneeScolaire' => $idAnneeScolaire, 'anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); // On crée un nouveau enregistrement de note.

									$fonction->addNote($note);

									$rang = new Notes(array('nomSemestre' => $_POST['semestre'], 'matiere' => $_POST['matiere'], 'niveau' => $_POST['niveau'], 'classe' => $_POST['classe'], 'idAnneeScolaire' => $idAnneeScolaire, 'ecole' => $ecole));  
									
								    $fonction->rangDevoir($rang);

								}
							}
						}
					}
						//}
				} 
				
				
				$_SESSION['flash']['success'] = "succé";
			} 
		}

	include CHEMIN_VUE.'ajoutNote.php';

} else{

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
	}
?>