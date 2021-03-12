<?php 

	class AnneeScolaire {

		private $_idAnneeScolaire;
		private $_anneeScolaire;
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
		public function idAnneeScolaire() {
			return $this->_idAnneeScolaire;
		}
		public function anneeScolaire() {
			return $this->_anneeScolaire;
		}
		public function ecole() {
			return $this->_ecole;
		}

		//  SETTERS  //
		public function setIdAnneeScolaire($anneeScolaire) {
			if (is_string($anneeScolaire) ) {
				$this->_idAnneeScolaire = $anneeScolaire;
			}
	
		}
		public function setAnneeScolaire($anneeScolaire) {
			if (is_string($anneeScolaire) ) {
				$this->_anneeScolaire = $anneeScolaire;
			}
	
		}
		public function setEcole($ecole) {
				$this->_ecole = $ecole;
		}
	}



?>