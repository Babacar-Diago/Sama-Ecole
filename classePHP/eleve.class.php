<?php 
	class Eleves {

		private $_matricule;
		private $_nom;
		private $_prenom;
		private $_sexe;
		private $_dateNaissance;
		private $_lieuNaissance;
		private $_origine;
		private $_motifEntre;
		private $_numeroTel; 
		private $_email;
		private $_ecole;
		private $_statut;

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

		public function matriculeValide() {
			return !empty($this->_matricule);
		}

		// GETTERS //
		public function matricule() {
			return $this->_matricule;
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
		public function dateNaissance() {
			return $this->_date_naissance;
		}
		public function lieuNaissance() {
			return $this->_lieu_naissance;
		}
		public function origine() {
			return $this->_origine;
		}
		public function motifEntre() {
			return $this->_motif_entre;
		}
		public function numeroTel() {
			return $this->_numeroTel;
		}
		public function email() {
			return $this->_email;
		}
		public function ecole() {
			return $this->_ecole;
		}
		public function statut() {
			return $this->_statut;
		}

		// SETTERS //   
		public function setMatricule($matricule) {  
				$this->_matricule = $matricule;
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
		public function setDateNaissance($naissance) {
			$this->_date_naissance = $naissance;
		}
		public function setLieuNaissance($lieuNais) {
			if (is_string($lieuNais)){
				$this->_lieu_naissance = $lieuNais;
			}
		}
		public function setOrigine($origine) {
			if (is_string($origine)){
				$this->_origine = $origine;
			}
		}
		public function setMotifEntre($motif) {
			if (is_string($motif)) {
				$this->_motif_entre = $motif;
			}
		}
		public function setNumeroTel($numeroTel) {
			$this->_numeroTel = $numeroTel;
		}
		public function setEmail($email) {
			$this->_email = $email;
		}
		public function setEcole($id) {
			$this->_ecole = $id;
		}
		public function setStatut($statut) {
			$this->_statut = $statut;
		}

	
	}
?>