<?php 

  if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    if (!isset($_SESSION['auth'])) {

          $_SESSION['flash']['danger'] = "La connection a échoué. Veuillez réessaié svp";

          header("Location: index.php?module=profil/&action=profil");
          exit();
          
    } else{

      include_once CHEMIN_CLASSPHP.'enseigner.class.php';
      include_once CHEMIN_MODELE.'enseignerFonctions.class.php';

      include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
      include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

      include_once CHEMIN_CLASSPHP.'personnel.class.php';
      include_once CHEMIN_MODELE.'personnelFonctions.class.php';

      $pdo = PDO2::getInstance();
      $fonction = new AnneeScolaireFonctions($pdo);
      $fonction1 = new EnseignerFonctions($pdo);
      $fonction2 = new PersonnelFonctions($pdo);

      
      if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ) {

        $ecole = $_SESSION['auth']['ecole'];
        $prof = $_SESSION['auth']['identifiant'];
        $mdp = $_SESSION['auth']['motDePasse'];

        // Sélection de l'année scolaire
        $anSco = new Enseignant(array( 
          'prof' => $prof, 
          'ecole' => $ecole, )); 
        $idAnneeScolaire = $fonction1->getActuelAnSco($anSco);

        // Sélection de la matière
        $matiere = new Enseignant(array(
          'prof' => $prof, 
          'ecole' => $ecole, 
          'idAnneeScolaire' => $idAnneeScolaire)); 

        $nomMatiere = $fonction1->getMatiere($matiere);

        // Sélection des classe vide à renseigner
        $enseignant = new Enseignant(array(
        'prof' => $prof, 
        'matiere' => $nomMatiere, 
        'ecole' => $ecole, 
        'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.

          $errors = array() ;

          if (!empty($_POST)) {
            //VERIFIE SI LE FORMULAIRE EST RENSEIGNE
            if (empty($_POST['prenom']) || empty($_POST['nom'])) {

              $errors['nom'] = "Veuiller renseigner votre Nom et Prénom";

            } 
            
            //S'il y a pas d'erreur
            if(empty($errors)){

              $user_id = $_SESSION['auth']['identifiant'];

              // Sélection du personnel
              $userName = new Personnel(array(
                'nom' => htmlspecialchars($_POST['nom']), 
                'prenom' => htmlspecialchars($_POST['prenom']), 
                'ecole' => $ecole, 
                'identifiant' => $user_id)); 

              $updatePersonnelName = $fonction2->updatePersonnelName($userName);

             $_SESSION['flash']['success'] = "Votre Nom d'utilisateur a bien été mis a jour";
             header('Location: index.php?module=profil/&action=profil');
             exit();

            }
          }

      } elseif ($_SESSION['auth']['statut'] =='Ecole') {

        $ecole = $_SESSION['auth']['idEcole'];

      } elseif ($_SESSION['auth']['statut'] =='Inspection') {

        $inspection = $_SESSION['auth']['idInspection'];
      }
      

      include CHEMIN_VUE.'modifieNomPrenom.php';
      }

?>