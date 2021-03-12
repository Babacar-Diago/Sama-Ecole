<?php 

	class Classes {

		private $_nom;
		private $_niveau;
		private $_serie;
		private $_nombreEleves;
		private $_idAnneeScolaire;
		private $_ecole;


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

		public function nomValide() {
			return !empty($this->_nom);
		}

		//  GETTERS  //
		public function nom() {
			return $this->_nom;
		}
		public function niveau() {
			return $this->_niveau;
		}
		public function serie() {
			return $this->_serie;
		}
		public function nombreEleves() {
			return $this->_nombreEleves;
		}
		public function idAnneeScolaire() {
			return $this->_idAnneeScolaire;
		}
		public function ecole() {
			return $this->_ecole;
		}
		
		//  SETTERS  //
		public function setNom($nom) {
			if (is_string($nom)) {
				$this->_nom = $nom;
			}
		}
		public function setNiveau($niveau) {
			$this->_niveau = $niveau;
		}
		public function setSerie($serie) {
			$this->_serie = $serie;
		}
		public function setNombreEleves($nombreEleves) {
			$this->_nombreEleves = $nombreEleves;
		}
		public function setIdAnneeScolaire($idAnneeScolaire) {
			$this->_idAnneeScolaire = $idAnneeScolaire;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
	
	}


?>