<?php

if (session_status() == PHP_SESSION_NONE) {
        session_start();
 }
if (isset($_SESSION['auth'])){

	include_once CHEMIN_CLASSPHP.'enseigner.class.php';
    include_once CHEMIN_MODELE.'enseignerFonctions.class.php';
    include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';
    include_once CHEMIN_MODELE.'PersonnelFonctions.class.php';

	$pdo = PDO2::getInstance();;
    $fonction = new EnseignerFonctions($pdo);
    $fonction1 = new PersonnelFonctions($pdo);
    $fonction3 = new AnneeScolaireFonctions($pdo);
    $ecole = $_SESSION['auth']['ecole'];

	// Si on a voulu affecter une classe a un personnel.
	if (isset($_POST['suivant'])) { 

		$errors = array();

		// VERIFICATION DE LA VALIDITE DU PSEUDO OU DU E-MAIL
        if(empty($_POST['pseudo'])){ // Vérifie si le champ n'est pas renseignée           
            $errors['pseudo'] = "Vous devez renseigner le 'Pseudo' ou le 'E-mail' du professeur ou du surveillant";
        }
        elseif(!($fonction1->existPerso($_POST['pseudo'], $ecole))) { // Vérifie si le personel existe
                $errors['identifiant']= "Ce 'Personnel' n'existe pas";
                unset($_POST['pseudo']);
        }
        
        //S'il y a pas d'erreur
        if(empty($errors)){

            //******************************************
            $req = $pdo->prepare("SELECT * FROM personnel WHERE (pseudo=:pseudo OR email=:pseudo) ");
            $req->execute(['pseudo'=>$_POST['pseudo']]);
            $personnel = $req->fetch();
            //******************************************
            $actuelIdAnSco = $fonction3->getActuelIdAnSco($ecole);
            $req = $pdo->prepare("SELECT * FROM enseigner WHERE prof=:pseudo AND idAnneeScolaire= '".$actuelIdAnSco."' ");
            $req->execute(['pseudo'=>$personnel['identifiant']]);
            $personnel2 = $req->fetch();
            //******************************************

            // SI LE PSEUDO OU E-MAIL COREESPOND A CEL D'UN PROFESSEUR  
            if ($personnel['statut']=='Professeur') {

                $enseigner = new Enseignant(array('prof' => $personnel2['prof'], 'matiere' => $personnel2['matiere'], 'ecole' => $personnel2['ecole'], 'idAnneeScolaire' => $personnel2['idAnneeScolaire'])); // On crée un nouveau enseignant
                
                if ($fonction->existEnseignant($enseigner)) { // Si le professeur avait déjà recu au moins une classe
                    //Redirection vers la page de selection de classe
                    header("Location: index.php?module=affecteClasse/&action=classeAttrib&perso=".$_POST['pseudo']."&prof=".$personnel2['prof']."&matiere=".$personnel2['matiere']."&anSco=".$personnel2['idAnneeScolaire']);
                    exit();
                    
                }else{ // Sinon Redirection vers la page suivante
                header("Location: index.php?module=affecteClasse/&action=infoSup&perso=".$_POST['pseudo']);
                exit();
                }

            } 
            // SI LE PSEUDO OU E-MAIL COREESPOND A CEL D'UN PROFESSEUR
            elseif ($personnel['statut']=='Surveillant') {

                $surveillant = new Enseignant(array('prof' => $personnel2['prof'], 'ecole' => $personnel2['ecole'], 'idAnneeScolaire' => $personnel2['idAnneeScolaire'])); // On crée un nouveau enseignant 
                
                if ($fonction->existSurveillant($surveillant)) { // Si le surveillant avait déjà recu au moins une classe
                    //Redirection vers la page de selection de classe 
                    header("Location: index.php?module=affecteClasse/&action=classeAttrib&perso=".$_POST['pseudo']."&surv=".$personnel2['prof']."&anSco=".$personnel2['idAnneeScolaire']);
                    exit();

                } else{ // Sinon Redirection vers la page suivante
                header("Location: index.php?module=affecteClasse/&action=infoSup&perso=".$_POST['pseudo']);
                exit();
                }
            } 
    
            
        } else{
            include CHEMIN_VUE.'identification.php';
        }
    } else{
       include CHEMIN_VUE.'identification.php';
    }
		
} else{

    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'acceder à cette page";
    header("Location: index.php");
    exit();
}