<?php 

	class AvoirMatiere {

		private $_matiere;
		private $_niveau;
		private $_serie;
		private $_coef;
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


		//  GETTERS  //
		public function matiere() {
			return $this->_matiere;
		}
		public function niveau() {
			return $this->_niveau;
		}
		public function serie() {
			return $this->_serie;
		}
		public function coef() {
			return $this->_coef;
		}
		public function ecole() {
			return $this->_ecole;
		}
		
		//  SETTERS  //
		public function setMatiere($matiere) {
				$this->_matiere = $matiere;
		}
		public function setNiveau($niveau) {
			$this->_niveau = $niveau;
		}
		public function setSerie($serie) {
			$this->_serie = $serie;
		}
		public function setCoef($coef) {
			$this->_coef = $coef;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
	
	}


?>