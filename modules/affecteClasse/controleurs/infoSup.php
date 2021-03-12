<?php

if (session_status() == PHP_SESSION_NONE) {
        session_start();
 }
if (isset($_SESSION['auth'])){

    include_once CHEMIN_CLASSPHP.'enseigner.class.php';
    include_once CHEMIN_CLASSPHP.'personnel.class.php';
    include_once CHEMIN_CLASSPHP.'matiere.class.php';
	include_once CHEMIN_CLASSPHP.'anneeScolaire.class.php';

    include_once CHEMIN_MODELE.'enseignerFonctions.class.php';
    include_once CHEMIN_MODELE.'personnelFonctions.class.php';
    include_once CHEMIN_MODELE.'matiereFonctions.class.php';
    include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

    $pdo = PDO2::getInstance();
    $fonction = new EnseignerFonctions($pdo);
    $fonction1 = new PersonnelFonctions($pdo);
    $fonction2 = new MatiereFonctions($pdo);
    $fonction3 = new AnneeScolaireFonctions($pdo);
    $ecole = $_SESSION['auth']['ecole'];
    $pseudo = $_GET['perso'];

    //Sélection de l'identifiant de la dernière année scolaire enregistrée
    $idActuelIdAnSco = $fonction3->getActuelIdAnSco($ecole);
    //Sélection de l'année scolaire selon l'identifiant 
    $anneeScolaire = $fonction3->getAnneeScolaire($idActuelIdAnSco);

	// Si on a voulu affecter une classe a un personnel.
	if (isset($_POST['suivant'])) {

      $errors = array(); 

        $req = $pdo->prepare("SELECT * FROM personnel WHERE (pseudo=:pseudo OR email=:pseudo) ");
        $req->execute(['pseudo'=>$pseudo]);
        $personnel = $req->fetch();

        if ($personnel['statut']=='Professeur') {
             // VERIFICATION DE LA VALIDITE DU NOM DE LA MATIERE
            if($_POST['matiere']=='-----selectionner-----'){ // Vérifie si le nom de la matiere n'est pas renseignée           
                $errors['matiere'] = "Vous devez renseigner le nom de la 'matière à enseigner'";
            }
        }

		// VERIFICATION DE LA VALIDITE DU NOM DE LA MATIERE
        if($_POST['anneeScolaire']=='-----selectionner-----'){ // Vérifie si le nom de la matiere n'est pas renseignée           
            $errors['anneeScolaire'] = "Vous devez renseigner ' l'année scolaire ' ";
        }
        
        //S'il y a pas d'erreur
        if(empty($errors)){

            //******************************************
            $personnel = new Personnel(array('pseudo' => $pseudo, 'email' => $pseudo, 'ecole' => $ecole )); 
            $prof = $fonction1->getIdPersonnel($personnel);
            //******************************************
            $matieres = new Matieres(array('nom' => $_POST['matiere'], 'ecole' => $ecole));
            $matiere = $fonction2->getIdMatiere($matieres);
            //******************************************
            $anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole));
            $idAnneeScolaire = $fonction3->getIdAnneeScolaire($anneeScolaire);
            //******************************************

            $req = $pdo->prepare("SELECT statut FROM personnel WHERE (pseudo=:pseudo OR email=:pseudo) ");
            $req->execute(['pseudo'=>$pseudo]);
            $personnel = $req->fetch();

            //******************************************
            if ($personnel['statut']=='Professeur') {
                $enseigner = new Enseignant(array('prof' => $prof, 'matiere' => $matiere, 'ecole' => $ecole, 'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.
                if (!($fonction->existEnseignant($enseigner))) { 

                    $fonction->addEnseignant($enseigner);

                    header("Location: index.php?module=affecteClasse/&action=classeAttrib&perso=".$pseudo."&prof=".$prof."&matiere=".$matiere."&anSco=".$idAnneeScolaire);
                    exit();
                }

            } elseif ($personnel['statut']=='Surveillant') {
                $surveillant = new Enseignant(array('prof' => $prof, 'ecole' => $ecole, 'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.
                if (!($fonction->existSurveillant($surveillant))) { 

                    $fonction->addEnseignant($surveillant);

                    header("Location: index.php?module=affecteClasse/&action=classeAttrib&perso=".$pseudo."&prof=".$prof."&anSco=".$idAnneeScolaire);
                    exit();
                }
            }
             
                

            
        } else{
            include CHEMIN_VUE.'infoSup.php';
        }
    } else{
       include CHEMIN_VUE.'infoSup.php';
    }
		
} else{

    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}