<?php 

	class Serie {

		private $_serie;
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
		public function serie() {
			return $this->_serie;
		}
		public function ecole() {
			return $this->_ecole;
		}

		//  SETTERS  //
		public function setSerie($serie) {
			if (is_string($serie) ) {
				$this->_serie = $serie;
			}
	
		}
		public function setEcole($ecole) {			
				$this->_ecole = $ecole;
		}
	}



?>