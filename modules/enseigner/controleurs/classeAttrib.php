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
	if (isset($_POST['ajout'])) { 

        $errors = array();

        // VERIFICATION DE LA VALIDITE DU NOM DE LA MATIERE
        if($_POST['matiere']=='-----selectionner-----'){ // Vérifie si le nom de la matiere n'est pas renseignée           
            $errors['matiere'] = "Vous devez renseigner le nom de la 'matière à enseigner'";
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

                //for ($i=2; $i <= 10 ; $i++) { 

                    if ($_POST['classe2']) {
                        $enseigne = new Enseignant(array('prof' => $prof, 'matiere' => $matiere, 'ecole' => $ecole, 'classe'.$i => $_POST['classe'.$i])); // On crée une nouvelle classe.
                        $fonction->updateEnseignant($enseigne);
                    }
               // }

                $_SESSION['flash']['success'] = "Les informations ont été enregistré avec succé";

            } else{

                $_SESSION['flash']['danger'] = " Oups! L'enregistrement de la classe a échoué. Veillez réessayer svp";
            }
        }
            
    } 

    include CHEMIN_VUE.'classeAttrib.php';
        
} else{

    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}