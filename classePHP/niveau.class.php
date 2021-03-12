<?php 

	class Niveau {

		private $_niveau;
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
		public function niveau() {
			return $this->_niveau;
		}
		public function ecole() {
			return $this->_ecole;
		}

		//  SETTERS  //
		public function setNIveau($niveau) {
			//if (is_string($ninveau)) 
				$this->_niveau = $niveau;
		}
		public function setEcole($ecole) {
			//if (is_string($ninveau)) 
				$this->_ecole = $ecole;
		}
		
	}



?>