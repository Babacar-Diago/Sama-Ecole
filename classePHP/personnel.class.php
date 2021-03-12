<?php 
	class Personnel {

		private $_identifiant;
		private $_pseudo;
		private $_nom;
		private $_prenom;
		private $_sexe;
		private $_statut;
		private $_telephone;
		private $_email;
		private $_motDePasse;
		private $_ecole;
		private $_confirmation_token;
		private $_confirmation_at;
		private $_reset_token;
		private $_reset_at;
		private $_avatar;
		private $_remember_token;

		public function __construct(array $donnees) {
			$this->hydrate($donnees);
		}

		public function hydrate(array $donnees) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}


		// GETTERS //
		public function identifiant() {
			return $this->_identifiant;
		}
		public function pseudo() {
			return $this->_pseudo;
		}
		public function nom() {
			return $this->_nom;
		}
		public function prenom() {
			return $this->_prenom;
		}
		public function sexe() {
			return $this->_sexe;
		}
		public function statut() {
			return $this->_statut;
		}
		public function telephone() {
			return $this->_telephone;
		}
		public function email() {
			return $this->_email;
		}
		public function motDePasse() {
			return $this->_motDePasse;
		}
		public function ecole() {
			return $this->_ecole;
		}
		public function confirmation_token() {
			return $this->_confirmation_token;
		}
		public function confirmation_at() {
			return $this->_confirmation_at;
		}
		public function reset_token() {
			return $this->_reset_token;
		}
		public function reset_at() {
			return $this->_reset_at;
		}
		public function avatar() {
			return $this->_avatar;
		}
		public function remember_token() {
			return $this->_remember_token;
		}

		// SETTERS //
		public function setIdentifiant($identifiant) {  
				$this->_identifiant = $identifiant;
		}
		public function setPseudo($pseudo) {  
				$this->_pseudo = $pseudo;
		}
		public function setNom($nom) {
			if (is_string($nom) && strlen($nom)<=20) {
				$this->_nom = $nom;
			}
		}
		public function setPrenom($prenom) {
			if (is_string($prenom) && strlen($prenom)<=40) {
				$this->_prenom = $prenom;
			}
		}
		public function setSexe($sexe) {
			if (is_string($sexe) && strlen($sexe)<=8) {
				$this->_sexe = $sexe;
			}
		}
		public function setStatut($statut) {
			$this->_statut = $statut;
		}
		public function setTelephone($telephone) {
			if (is_string($telephone)){
				$this->_telephone = $telephone;
			}
		}
		public function setEmail($email) {
			if (is_string($email)) {
				$this->_email = $email;
			}
		}
		public function setMotDePasse($motDePasse) {
			$this->_motDePasse = $motDePasse;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
		public function setConfirmation_token($confirmToken) {
			$this->_confirmation_token = $confirmToken;
		}
		public function setConfirmation_at($confirmAt) {
				$this->_confirmation_at = $confirmAt;
		}
		public function setReset_token($resetToken) {
				$this->_reset_token = $resetToken;
		}
		public function setReset_at($resetAt) {
				$this->_reset_at = $resetAt;
		}
		public function setAvatar($avatar) {
			$this->_avatar = $avatar;
		}
		public function setRemember_token($rememberToken) {
			$this->_remember_token = $rememberToken;
		}

	
	}
?>