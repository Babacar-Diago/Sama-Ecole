<?php

    if (session_status() == PHP_SESSION_NONE) {
    	session_start();
   	}

  	if (!isset($_SESSION['auth'])) {

          $_SESSION['flash']['danger'] = "La connection a échoué. Veuillez réessaié svp";

          header("Location: index.php");
          exit();
      		
  	} else{

      include_once CHEMIN_CLASSPHP.'enseigner.class.php';
      include_once CHEMIN_MODELE.'enseignerFonctions.class.php';

      include CHEMIN_CLASSPHP.'anneeScolaire.class.php';
      include CHEMIN_MODELE.'anneeScolaireFonctions.class.php';

      include CHEMIN_CLASSPHP.'classe.class.php';
      include CHEMIN_MODELE.'classeFonctions.class.php';


      $pdo = PDO2::getInstance();
      $fonction = new AnneeScolaireFonctions($pdo);
      $fonction1 = new EnseignerFonctions($pdo);
      $fonction2 = new ClasseFonctions($pdo);

      
      if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ) {

        $ecole = $_SESSION['auth']['ecole'];
        $prof = $_SESSION['auth']['identifiant'];

        // Sélection de l'année scolaire
        $anSco = new Enseignant(array( 
          'prof' => $prof, 
          'ecole' => $ecole, )); 
        $idAnneeScolaire = $fonction1->getActuelAnSco($anSco);

        // Sélection de la matière
        $matiere = new Enseignant(array(
          'prof' => $prof, 
          'ecole' => $ecole, 
          'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.
        $nomMatiere = $fonction1->getMatiere($matiere);

        // Sélection des classe vide à renseigner
        $enseignant = new Enseignant(array(
        'prof' => $prof, 
        'matiere' => $nomMatiere, 
        'ecole' => $ecole, 
        'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.

      } elseif ($_SESSION['auth']['statut'] =='Ecole') {

        $ecole = $_SESSION['auth']['idEcole'];
        $inspection = $_SESSION['auth']['idInspection'];

        
        //Sélection de l'identifiant de la dernière année scolaire enregistrée
        $idActuelIdAnSco = $fonction->getActuelIdAnSco($ecole);
        //Sélection de l'année scolaire selon l'identifiant 
        $anneeScolaire = $fonction->getAnneeScolaire($idActuelIdAnSco);
        
      } elseif ($_SESSION['auth']['statut'] =='Inspection') {

        $inspection = $_SESSION['auth']['idInspection'];
      }
      

      include CHEMIN_VUE.'profil'.$_SESSION['auth']['statut'].'/profil'.$_SESSION['auth']['statut'].'.php';
      }
  
  //http://localhost/bulletin_de_notes/index.php?module=ecole/&action=confirm&id=1&token=bORxUYpkUTe2ZGLkkanwO2PeVKxfXvDCmqSiJo60la9QZVLksoyG56O5kinJ