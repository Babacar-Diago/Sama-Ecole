<?php 

	class EtreEleve {

		private $_eleve;
		private $_niveau;
		private $_serie;
		private $_classe; 
		private $_idAnneeScolaire; 
		private $_classeDoublee; 
		private $_ecole;
		private $_dateInscription; 

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
		public function eleve() {
			return $this->_eleve;
		}
		public function niveau() {
			return $this->_niveau;
		}
		public function serie() {
			return $this->_serie;
		}
		public function classe() {
			return $this->_classe;
		}
		public function idAnneeScolaire() {
			return $this->_idAnneeScolaire;
		}
		public function classeDoublee() {
			return $this->_classeDoublee;
		}
		public function ecole() {
			return $this->_ecole;
		}
		public function dateInscription() {
			return $this->_dateInscription;
		}
		
		//  SETTERS  // 
		public function setEleve($eleve) {
				$this->_eleve = $eleve;
		}
		public function setNiveau($niveau) {
				$this->_niveau = $niveau;
		}
		public function setSerie($serie) {
				$this->_serie = $serie;
		}
		public function setClasse($classe) {
			$this->_classe = $classe;
		}
		public function setIdAnneeScolaire($idAnneeScolaire) {
			$this->_idAnneeScolaire = $idAnneeScolaire;
		}
		public function setClasseDoublee($classeDoublee) {
			$this->_classeDoublee = $classeDoublee;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
		public function setDateInscription($ecole) {
			$this->_ecole = $ecole;
		}
	
	}


?>