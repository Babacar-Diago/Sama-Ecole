<?php 
	
	class LoginFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}

		public function logged_only(){

	    	if (session_status() == PHP_SESSION_NONE) {
		      session_start();
		    }

	    	if (!isset($_SESSION['auth'])) {
			
			$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";

			include CHEMIN_VUE.'login.php';

			exit();
		    }

	    }

	    public function Traitement($login, $mdp){
	    	
			//************************************
			$q1 = $this->_db->prepare("SELECT * FROM personnel WHERE (pseudo = :login OR email = :login) AND confirmation_at IS NOT NULL");
			$q1->execute(array('login' => $login));

			$user1 = $q1->fetch();  // Récupérer l'ensemble de informations de l'utilisateur

			//************************************
			$q2 = $this->_db->prepare('SELECT * FROM ecole WHERE email = :login AND confirmation_at IS NOT NULL');
			$q2->execute(array('login' => $login));

			$user2 = $q2->fetch();  // Récupérer l'ensemble de informations de l'utilisateur

			//************************************
			$q3 = $this->_db->prepare('SELECT * FROM inspection WHERE email = :login AND confirmation_at IS NOT NULL');
			$q3->execute(array('login' => $login));

			$user3 = $q3->fetch();  // Récupérer l'ensemble de informations de l'utilisateur

			//************************************
			
			if($user1) {

				if (password_verify($mdp, $user1['motDePasse'])){

					$_SESSION['auth'] = $user1;
					header('Location: index.php?module=profil/&action=profil');
					exit();
				} 
		
			} if($user2) {

				if (password_verify( $mdp, $user2['motDePasse']) ){

					$_SESSION['auth'] = $user2;

					header('Location: index.php?module=profil/&action=profil');
					exit();
				}

			} if($user3) {
				
				if (password_verify( $mdp, $user3['motDePasse']) ){

					$_SESSION['auth'] = $user3;

					header('Location: index.php?module=profil/&action=profil');
					exit();			
				}
			
			} else{		
				
					$_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrecte";
					//include CHEMIN_VUE.'login.php';
					header('Location: index.php?module=login/&action=login');
					exit(); 
			} 	
		}
	}