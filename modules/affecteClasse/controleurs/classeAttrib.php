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
	if (isset($_POST['ajout'])) { 

        // Sélection des classe vide à renseigner
        $enseignant = new Enseignant(array(
        'prof' => $_GET['prof'], 
        'matiere' => $_GET['matiere'], 
        'ecole' => $ecole, 
        'idAnneeScolaire' => $_GET['anSco'])); // On attribut une nouvelle classe.

        for ($i=1; $i <= 10 ; $i++) { 
            
            $classeNonVide = $fonction->selectClasseProf($i, $enseignant);

            if ($classeNonVide==NULL) {

                $classe = 'classe'.$i;
                $nomClasse = $_POST[$classe];

                //******************************************
                $req = $pdo->prepare("SELECT statut FROM personnel WHERE (pseudo=:pseudo OR email=:pseudo) ");
                $req->execute(['pseudo'=>$pseudo]);
                $personnel = $req->fetch();
                //******************************************
                if ($personnel['statut']=='Professeur') {

                    $updat = new Enseignant(array(
                    'prof' => $_GET['prof'], 
                    'matiere' => $_GET['matiere'], 
                    'ecole' => $ecole, 
                    'idAnneeScolaire' => $_GET['anSco'],
                    $classe => $nomClasse) );
                    
                    $fonction->updateEnseignant($i, $updat);
                
                    $_SESSION['flash']['success'] = "Classe(s) ajoutée(s) avec succé";

                } elseif ($personnel['statut']=='Surveillant') {

                    $updat = new Enseignant(array(
                    'prof' => $_GET['prof'],
                    'ecole' => $ecole, 
                    'idAnneeScolaire' => $_GET['anSco'],
                    $classe => $nomClasse) );
                    
                    $fonction->updateSurveillantt($i, $updat);
                
                    $_SESSION['flash']['success'] = "Classe(s) ajoutée(s) avec succé";
                }

                 header("Location: index.php?module=affecteClasse/&action=identification");
            } 
        } 

    } else{
        include CHEMIN_VUE.'classeAttrib.php';
    }
        
} else{

    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}