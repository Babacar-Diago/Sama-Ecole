<?php

if (session_status() == PHP_SESSION_NONE) {
        session_start();
 }
if (isset($_SESSION['auth'])){

	include_once CHEMIN_CLASSPHP.'enseigner.class.php';
    include_once CHEMIN_MODELE.'enseignerFonctions.class.php';

    include_once CHEMIN_MODELE.'personnelFonctions.class.php';
    include_once CHEMIN_MODELE.'matiereFonctions.class.php';
    include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

    $pdo = PDO2::getInstance();
    $fonction = new EnseignerFonctions($pdo);
    $fonction1 = new PersonnelFonctions($pdo);
    $fonction2 = new MatiereFonctions($pdo);
    $fonction3 = new AnneeScolaireFonctions($pdo);
    $ecole = $_SESSION['auth']['idEcole'];

	// Si on a voulu affecter une classe a un personnel.
	if (isset($_POST['suivant'])) { 

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU PSEUDO OU DU E-MAIL
        if(empty($_POST['pseudo'])){ // Vérifie si le champ n'est pas renseignée           
            $errors['pseudo'] = "Vous devez renseigner le 'Pseudo' ou le 'E-mail' du professeur ou du surveillant";
        }
        elseif(!($fonction1->existPerso($_POST['pseudo'], $ecole))) { // Vérifie si le personel existe
                $errors['identifiant']= "Ce 'Personel' n'existe pas";
                unset($_POST['pseudo']);
        }
        
        //S'il y a pas d'erreur
        if(empty($errors)){

            //******************************************
            $personne1 = new Personnel(array('pseudo' => $_POST['pseudo'], 'email' => $_POST['pseudo'], 'ecole' => $ecole )); 
            $prof = $fonction1->getIdPersonnel($personnel);
            //******************************************
            $matieres = new Matieres(array('matiere' => $_POST['matiere'], 'ecole' => $ecole));
            $matiere = $fonction2->getIdMatiere($matieres);
            //******************************************
            $anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole));
            $idAnneeScolaire = $fonction3->getIdAnneeScolaire($anneeScolaire);
            //******************************************

            $enseigner = new Enseignant(array('prof' => $prof, 'matiere' => $matiere, 'ecole' => $ecole, 'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.
            if ($enseigner) { 

                if (!($fonction->existEnseignant($enseigner))) { 

                    $fonction->addEnseignant($enseigner);
                }
            }

            header("Location: index.php?module=enseigner/&action=classeAttrib&perso=".$_POST['pseudo']);
            exit();
        } else{
            include CHEMIN_VUE.'enseigner.php';
        }
    } else{
       include CHEMIN_VUE.'enseigner.php';
    }
		
} else{

    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}