<?php 

	class Matieres {

		private $_nom;
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
		
		public function nom() {
			return $this->_nom;
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
		public function setEcole($ecole) {
				$this->_ecole = $ecole;
		}
	
	}


?>