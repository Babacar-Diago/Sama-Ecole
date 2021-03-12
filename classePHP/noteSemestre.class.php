<?php 
	class NoteSemestre {

		private $_nomSemestre;
		private $_sumMoyX;
		private $_sumCoef;
		private $_moyGenerale;
		private $_appreciation;
		private $_rang;
		private $_eleve;
		private $_classe;
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

		public function semestreValide() {
			return !empty($this->_nomSemestre);
		}

		// GETTERS //
		public function nomSemestre() {
			return $this->_nomSemestre;
		}
		public function sumMoyX() {
			return $this->_sumMoyX;
		}
		public function sumCoef() {
			return $this->_sumCoef;
		}
		public function moyGenerale() {
			return $this->_moyGenerale;
		}
		public function appreciation() {
			return $this->_appreciation;
		}
		public function rang() {
			return $this->_rang;
		}
		public function eleve() {
			return $this->_eleve;
		}
		public function classe() {
			return $this->_classe;
		}
		public function idAnneeScolaire() {
			return $this->_idAnneeScolaire;
		}
		public function ecole() {
			return $this->_ecole;
		}

		// SETTERS //
		public function setNomSemestre($semestre) {  
				$this->_nomSemestre = $semestre;
		}
		public function setSumMoyX($sumMoyX) {  
				$this->_sumMoyX = $sumMoyX;
		}
		public function setSumCoef($sumCoef) {  
				$this->_sumCoef = $sumCoef;
		}
		public function setMoyGenerale($moyGenerale) {
				$this->_moyGenerale = $moyGenerale;
		}
		public function setAppreciation($appreciation) {
				$this->_appreciation = $appreciation;
		}
		public function setRang($rang) {
				$this->_rang = $rang;
		}
		public function setEleve($eleve) {
				$this->_eleve = $eleve;
		}
		public function setClasse($classe) {
			$this->_classe = $classe;
		}
		public function setIdAnneeScolaire($idAnneeScolaire) {
			$this->_idAnneeScolaire = $idAnneeScolaire;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
	
	}
?>