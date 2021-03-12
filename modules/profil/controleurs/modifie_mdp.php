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

      $pdo = PDO2::getInstance();
      $fonction = new AnneeScolaireFonctions($pdo);
      $fonction1 = new EnseignerFonctions($pdo);

      $mdp = $_SESSION['auth']['motDePasse'];

      
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

          $errors = array() ;

          if (!empty($_POST)) {
            //VERIFIE SI L'ACTUEL MOT DE PASSE EST FOURNIES
            if (empty($_POST['mdpActuel'])) {

              $errors['mdpActuel'] = "Veuiller renseigner l'actuel mot de passe";

            } elseif (!(password_verify($_POST['mdpActuel'], $mdp))){
                
                $errors['mdpActuel'] = "L'actuel mot de passe renseigné ne correspond pas";
                
              } 

            //VERIFICATION DES INFORMATIONS FOURNIES
            if ($_POST['mdp'] != $_POST['mdpConfirm']) {

              $errors['nouveauMdp'] = "Les mots de passe ne correspondent pas";

            } elseif (empty($_POST['mdp']) || empty($_POST['mdpConfirm'])) {

              $errors['nouveauMdp'] = "Vous devez remplir tous les champs";

            }

            //S'il y a pas d'erreur
            if(empty($errors)){

              $user_id = $_SESSION['auth']['identifiant'];

              $password = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

              $modifieMdp = $pdo->prepare('UPDATE personnel SET motDePasse=:motDePasse WHERE identifiant=:identifiant AND ecole=:ecole');
              $modifieMdp->execute(array(':motDePasse'=>$password, 'ecole'=>$ecole, ':identifiant'=>$user_id));

             $_SESSION['flash']['success'] = "votre mot de passe a bien été mis a jour";
             header('Location: index.php?module=profil/&action=profil');
             exit();

            }
          }

      } elseif ($_SESSION['auth']['statut'] =='Ecole') {

        $inspection = $_SESSION['auth']['idInspection'];

        $errors = array() ;

          if (!empty($_POST)) {
            //VERIFIE SI L'ACTUEL MOT DE PASSE EST FOURNIES
            if (empty($_POST['mdpActuel'])) {

              $errors['mdpActuel'] = "Veuiller renseigner l'actuel mot de passe";

            } elseif (!(password_verify($_POST['mdpActuel'], $mdp))){
                
                $errors['mdpActuel'] = "L'actuel mot de passe renseigné ne correspond pas";
                
              } 

            //VERIFICATION DES INFORMATIONS FOURNIES
            if ($_POST['mdp'] != $_POST['mdpConfirm']) {

              $errors['nouveauMdp'] = "Les mots de passe ne correspondent pas";

            } elseif (empty($_POST['mdp']) || empty($_POST['mdpConfirm'])) {

              $errors['nouveauMdp'] = "Vous devez remplir tous les champs";

            }

            //S'il y a pas d'erreur
            if(empty($errors)){

              $user_id = $_SESSION['auth']['idEcole'];

              $password = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

              $modifieMdp = $pdo->prepare('UPDATE ecole SET motDePasse=:motDePasse WHERE idEcole=:idEcole AND idInspection=:idInspection');
              $modifieMdp->execute(array(':motDePasse'=>$password, ':idInspection'=>$inspection, ':idEcole'=>$user_id));

             $_SESSION['flash']['success'] = "votre mot de passe a bien été mis a jour";
             header('Location: index.php?module=profil/&action=profil');
             exit();

            }
          }

      } elseif ($_SESSION['auth']['statut'] =='Inspection') {

        //$ecole = $_SESSION['auth']['idInspection'];
        $errors = array() ;

          if (!empty($_POST)) {
            //VERIFIE SI L'ACTUEL MOT DE PASSE EST FOURNIES
            if (empty($_POST['mdpActuel'])) {

              $errors['mdpActuel'] = "Veuiller renseigner l'actuel mot de passe";

            } elseif (!(password_verify($_POST['mdpActuel'], $mdp))){
                
                $errors['mdpActuel'] = "L'actuel mot de passe renseigné ne correspond pas";
                
              } 

            //VERIFICATION DES INFORMATIONS FOURNIES
            if ($_POST['mdp'] != $_POST['mdpConfirm']) {

              $errors['nouveauMdp'] = "Les mots de passe ne correspondent pas";

            } elseif (empty($_POST['mdp']) || empty($_POST['mdpConfirm'])) {

              $errors['nouveauMdp'] = "Vous devez remplir tous les champs";

            }

            //S'il y a pas d'erreur
            if(empty($errors)){

              $user_id = $_SESSION['auth']['idInspection'];

              $password = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

              $modifieMdp = $pdo->prepare('UPDATE inspection SET motDePasse=:motDePasse WHERE idInspection=:idInspection');
              $modifieMdp->execute(array(':motDePasse'=>$password, ':idInspection'=>$user_id));

             $_SESSION['flash']['success'] = "votre mot de passe a bien été mis a jour";
             header('Location: index.php?module=profil/&action=profil');
             exit();

            }
          }
      }
      

      include CHEMIN_VUE.'modifie_mdp.php';
      }

?>