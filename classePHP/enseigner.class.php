<?php 

	class Enseignant {

		private $_prof;
		private $_matiere;
		private $_ecole;
		private $_idAnneeScolaire;
		private $_classe1;
		private $_classe2;
		private $_classe3;
		private $_classe4;
		private $_classe5;
		private $_classe6;
		private $_classe7;
		private $_classe8;
		private $_classe9;
		private $_classe10;

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
		public function prof() {
			return $this->_prof;
		}
		public function matiere() {
			return $this->_matiere;
		}
		public function ecole() {
			return $this->_ecole;
		}
		public function idAnneeScolaire() {
			return $this->_idAnneeScolaire;
		}
		public function classe1() {
			return $this->_classe1;
		}
		public function classe2() {
			return $this->_classe2;
		}
		public function classe3() {
			return $this->_classe3;
		}
		public function classe4() {
			return $this->_classe4;
		}
		public function classe5() {
			return $this->_classe5;
		}
		public function classe6() {
			return $this->_classe6;
		}
		public function classe7() {
			return $this->_classe7;
		}
		public function classe8() {
			return $this->_classe8;
		}
		public function classe9() {
			return $this->_classe9;
		}
		public function classe10() {
			return $this->_classe10;
		}

		//  SETTERS  //
		public function setProf($prof) {			
				$this->_prof = $prof;			
		}
		public function setMatiere($matiere) {
			$this->_matiere = $matiere;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
		public function setIdAnneeScolaire($anSco) {
			$this->_idAnneeScolaire = $anSco;
		}
		public function setClasse1($classe) {
			$this->_classe1 = $classe;
		}
		public function setClasse2($classe) {
			$this->_classe2 = $classe;
		}
		public function setClasse3($classe) {
			$this->_classe3 = $classe;
		}
		public function setClasse4($classe) {
			$this->_classe4 = $classe;
		}
		public function setClasse5($classe) {
			$this->_classe5 = $classe;
		}
		public function setClasse6($classe) {
			$this->_classe6 = $classe;
		}
		public function setClasse7($classe) {
			$this->_classe7 = $classe;
		}
		public function setClasse8($classe) {
			$this->_classe8 = $classe;
		}
		public function setClasse9($classe) {
			$this->_classe9 = $classe;
		}
		public function setClasse10($classe) {
			$this->_classe10 = $classe;
		}
	}



?>