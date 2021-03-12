<?php 
	
	class PersonnelFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addPersonnel(Personnel $personnel) {
			$q = $this->_db->prepare('INSERT INTO personnel SET identifiant=:identifiant, pseudo=:pseudo, nom=:nom, prenom=:prenom, sexe=:sexe, statut=:statut, telephone=:telephone, email=:email, motDePasse=:motDePasse, ecole=:ecole, confirmation_token=:confirmation_token');

			$q->bindValue(':identifiant', $personnel->identifiant());
			$q->bindValue(':pseudo', $personnel->pseudo());
			$q->bindValue(':nom', $personnel->nom());
			$q->bindValue(':prenom', $personnel->prenom());
			$q->bindValue(':sexe', $personnel->sexe());
			$q->bindValue(':statut', $personnel->statut());
			$q->bindValue(':telephone', $personnel->telephone());
			$q->bindValue(':email', $personnel->email());
			$q->bindValue(':motDePasse', $personnel->motDePasse());
			$q->bindValue(':ecole', $personnel->ecole());
			$q->bindValue(':confirmation_token', $personnel->confirmation_token());
			$q->execute();
		} 

		public function countPersonnel() {
			return $this->_db->query('SELECT COUNT(*) FROM personnel')->fetchColumn();
		} 

		public function deletePersonnel(Personnel $personnel){
			$this->_db->exec("DELETE FROM personnel WHERE identifiant = '".$personnel->identifiant()."' AND ecole = '".$personnel->ecole()."'");
		}

		public function getIdPersonnel(Personnel $info) {
			$q = $this->_db->prepare("SELECT DISTINCT identifiant FROM personnel WHERE (pseudo = '".$info->pseudo()."' OR email = '".$info->email()."') AND ecole = '".$info->ecole()."' ");
			$q->execute();
			return $q->fetchColumn();
		}

		public function existPseudo($info1, $info2){  // On veut voir si tel personnel ayant pour pseudo $info1 existe.
			$q = $this->_db->prepare("SELECT * FROM personnel WHERE pseudo='".$info1."' AND ecole='".$info2."'");
			$q->execute();
			return $q->fetchColumn();
		}

		public function existMail($info){   // On veut voir si tel personnel a pour e-mail $info1 existe.
			$q = $this->_db->prepare("SELECT email FROM personnel WHERE email='".$info."'");
			$q->execute();
			return $q->fetchColumn();
			
		}
		
		public function existPerso($info1, $info2){  // On veut voir si tel personnel existe.
			$q = $this->_db->prepare("SELECT * FROM personnel WHERE (pseudo='".$info1."' OR email='".$info1."') AND ecole='".$info2."' ");
			$q->execute();
			return $q->fetchColumn();
		}

		public function getPersonnel($info) {
			$q = $this->_db->query('SELECT identifiant, nom, prenom, sexe, statut, ecole, telephone, email FROM personnel WHERE identifiant = '.$info);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Personnel($donnees);			
		}

		public function getUserPersonnel($info) {
			$q = $this->_db->query('SELECT * FROM personnel WHERE identifiant = '.$info);
			$user = $q->fetch(PDO::FETCH_ASSOC);
			return new Personnel($user);			
		}

		public function getListPersonnel($nom) {
			$personnel = array();
			$q = $this->_db->prepare('SELECT identifiant, nom, prenom, sexe, statut, ecole, telephone, email FROM personnel WHERE (nom <> :nom) OR (prenom <> :nom) ORDER BY nom, prenom');
			$q->execute(array(':prenom' => $nom, ':nom' => $nom));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$personnel[] = new Personnel($donnees);
			} 
			return $personnel;
		} 

		public function updatePersonnelName(Personnel $personnel) {
			$q = $this->_db->prepare('UPDATE personnel SET nom=:nom, prenom=:prenom WHERE identifiant=:identifiant AND ecole=:ecole');

			$q->bindValue(':nom', $personnel->nom());
			$q->bindValue(':prenom', $personnel->prenom());
			$q->bindValue(':ecole', $personnel->ecole());
			$q->bindValue(':identifiant', $personnel->identifiant());
			$q->execute();
		} 

		function updateAvatar1(Personnel $personnel) {
            
            $requete = $this->_db->prepare("UPDATE personnel SET avatar = :avatar
            WHERE identifiant=:identifiant, AND ecole=:ecole");
			$q->bindValue(':identifiant', $personnel->identifiant());
			$q->bindValue(':ecole', $personnel->ecole());
            $requete->bindValue(':avatar', $personnel->avatar());
            return $requete->execute();
        }

        function updateAvatar($size, $name, $tmp_name, $statut, $user_id) {


		      $tailleMax = 2097152;
		      $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
		      if ($size <= $tailleMax) {
		        
		        $extensionsUpload = strtolower(substr(strrchr($name, '.'), 1));

		        if (in_array($extensionsUpload, $extensionsValides)) {

		          $chemin = DOSSIER_AVATAR. $statut.$user_id.".".$extensionsUpload;
		          $copiePhoto = move_uploaded_file($tmp_name, $chemin);

		          if ($copiePhoto) {

		            $nomPhoto = $statut.$user_id.".".$extensionsUpload;
		            if ($statut=='Professeur' or $statut=='Surveillant' or $statut=='Senseur') {

		            	$updatephoto = $this->_db->prepare("UPDATE personnel SET avatar=:avatar WHERE identifiant=:identifiant");

		            	$updatephoto->execute(array(':avatar'=>$nomPhoto, ':identifiant'=>$user_id));
		            
		            } elseif ($statut=='Ecole') {
		            	
		            	$updatephoto = $this->_db->prepare("UPDATE ecole SET avatar=:avatar WHERE idEcole=:idEcole");

		            	$updatephoto->execute(array(':avatar'=>$nomPhoto, ':idEcole'=>$user_id));
		            } elseif ($statut=='Inspection') {
		            	
		            	$updatephoto = $this->_db->prepare("UPDATE inspection SET avatar=:avatar WHERE idInspection=:idInspection");

		            	$updatephoto->execute(array(':avatar'=>$nomPhoto, ':idInspection'=>$user_id));
		            }

		            $_SESSION['flash']['success'] = "votre photo de profil a bien été mis a jour";

		          }else{
		             $_SESSION['flash']['danger'] = "Erreur pendant l'importation de Votre photo de profil";
		          }
		        }else{
		          $_SESSION['flash']['danger'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
		        }

		      }else{
		        $_SESSION['flash']['danger'] = "Votre photo de profil ne doit pas dépasser 2Mo";
		      }
		     
		     
        }


		public function updatePersonnel(Personnel $personnel) {
			$q = $this->_db->prepare('UPDATE personnel SET identifiant=:identifiant, nom=:nom, prenom=:prenom, sexe=:sexe, statut=:statut, telephone=:telephone, email=:email, motDePasse=:motDePasse, idEcole=:idEcole');

			$q->bindValue(':identifiant', $personnel->identifiant());
			$q->bindValue(':nom', $personnel->nom());
			$q->bindValue(':prenom', $personnel->prenom());
			$q->bindValue(':sexe', $personnel->sexe());
			$q->bindValue(':statut', $personnel->statut());
			$q->bindValue(':telephone', $personnel->telephone());
			$q->bindValue(':email', $personnel->email());
			$q->bindValue(':motDePasse', $personnel->motDePasse());
			$q->bindValue(':idEcole', $personnel->idEcole());
			$q->execute();
		} 


		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>