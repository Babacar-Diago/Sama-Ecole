<?php 
	class Notes {

		private $_nomSemestre;
		private $_noteDevoir;
		private $_noteComposition;
		private $_moyenne;
		private $_coef;
		private $_moyenneX;
		private $_appreciation;
		private $_rang;
		private $_eleve;
		private $_matiere;
		private $_niveau;
		private $_serie;
		private $_classe;
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

		public function semestreValide() {
			return !empty($this->_nomSemestre);
		}

		// GETTERS //
		public function nomSemestre() {
			return $this->_nomSemestre;
		}
		public function noteDevoir() {
			return $this->_noteDevoir;
		}
		public function noteComposition() {
			return $this->_noteComposition;
		}
		public function moyenne() {
			return $this->_moyenne;
		}
		public function coef() {
			return $this->_coef;
		}
		public function moyenneX() {
			return $this->_moyenneX;
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
		public function matiere() {
			return $this->_matiere;
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
		public function anneeScolaire() {
			return $this->_anneeScolaire;
		}
		public function ecole() {
			return $this->_ecole;
		}

		// SETTERS //
		public function setNomSemestre($Semestre) {  
				$this->_nomSemestre = $Semestre;
		}
		public function setNoteDevoir($devoir) {
				$this->_noteDevoir = $devoir;
		}
		public function setNoteComposition($composition) {
				$this->_noteComposition = $composition;
		}
		public function setMoyenne($moyenne) {
				$this->_moyenne = $moyenne;
		}
		public function setCoef($coef) {
				$this->_coef = $coef;
		}
		public function setMoyenneX($moyenneX) {
			$this->_moyenneX = $moyenneX;
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
		public function setMatiere($matiere) {
				$this->_matiere = $matiere;
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
		public function setAnneeScolaire($anneeScolaire) {
			$this->_anneeScolaire = $anneeScolaire;
		}
		public function setEcole($ecole) {
			$this->_ecole = $ecole;
		}
	
	}
?>