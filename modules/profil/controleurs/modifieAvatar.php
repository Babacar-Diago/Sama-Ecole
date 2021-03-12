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

      $statut=$_SESSION['auth']['statut'];

      
      if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ) {

        $avatar = $_SESSION['auth']['avatar'];
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
          'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.
        $nomMatiere = $fonction1->getMatiere($matiere);

        // Sélection des classe vide à renseigner
        $enseignant = new Enseignant(array(
        'prof' => $prof, 
        'matiere' => $nomMatiere, 
        'ecole' => $ecole, 
        'idAnneeScolaire' => $idAnneeScolaire)); // On attribut une nouvelle classe.

          $errors = array() ;

          if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
            //VERIFIE SI LE FORMULAIRE EST RENSEIGNE
         /*   if (!isset($_FILES['avatar'])) {
              $errors['avatar'] = "Veuiller choisir une photo de profil avant de valider";
             } 
		*/
            	$user_id = $_SESSION['auth']['identifiant'];
            	$size = $_FILES['avatar']['size'];
            	$name = $_FILES['avatar']['name'];
            	$tmp_name = $_FILES['avatar']['tmp_name'];

            	$avatarUpdater = $fonction2->updateAvatar($size, $name, $tmp_name, $statut, $user_id);

             header('Location: index.php?module=profil/&action=profil');
             exit();
         	
          } 

      } elseif ($_SESSION['auth']['statut'] =='Ecole') {

        //$ecole = $_SESSION['auth']['idEcole'];

        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
            //VERIFIE SI LE FORMULAIRE EST RENSEIGNE
         /*   if (!isset($_FILES['avatar'])) {
              $errors['avatar'] = "Veuiller choisir une photo de profil avant de valider";
             } 
    */
              $user_id = $_SESSION['auth']['idEcole'];
              $size = $_FILES['avatar']['size'];
              $name = $_FILES['avatar']['name'];
              $tmp_name = $_FILES['avatar']['tmp_name'];

              $avatarUpdater = $fonction2->updateAvatar($size, $name, $tmp_name, $statut, $user_id);

             header('Location: index.php?module=profil/&action=profil');
             exit();
          
          } 

      } elseif ($_SESSION['auth']['statut'] =='Inspection') {

        //$inspection = $_SESSION['auth']['idInspection'];

        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
            //VERIFIE SI LE FORMULAIRE EST RENSEIGNE
         /*   if (!isset($_FILES['avatar'])) {
              $errors['avatar'] = "Veuiller choisir une photo de profil avant de valider";
             } 
    */
              $user_id = $_SESSION['auth']['idInspection'];
              $size = $_FILES['avatar']['size'];
              $name = $_FILES['avatar']['name'];
              $tmp_name = $_FILES['avatar']['tmp_name'];

              $avatarUpdater = $fonction2->updateAvatar($size, $name, $tmp_name, $statut, $user_id);

             header('Location: index.php?module=profil/&action=profil');
             exit();
          
          } 
      }
      

      include CHEMIN_VUE.'modifieAvatar.php';
      }






	




?>