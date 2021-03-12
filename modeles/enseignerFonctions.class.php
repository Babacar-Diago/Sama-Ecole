<?php 
	
	class EnseignerFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addEnseignant(Enseignant $enseignant) {
			$q = $this->_db->prepare('INSERT INTO enseigner SET prof=:prof, matiere=:matiere, ecole=:ecole, idAnneeScolaire=:idAnneeScolaire');

			$q->bindValue(':prof', $enseignant->prof());
			$q->bindValue(':matiere', $enseignant->matiere());
			$q->bindValue(':ecole', $enseignant->ecole());
			$q->bindValue(':idAnneeScolaire', $enseignant->idAnneeScolaire());
			$q->execute();
		} 

		public function countEnseignant() {
			return $this->_db->query('SELECT COUNT(*) FROM enseigner')->fetchColumn();
		} 

		public function deleteEnseignant(Enseignant $enseignant) {
			$this->_db->exec('DELETE FROM enseigner WHERE prof = '.$enseignant->serie().'matiere = '.$enseignant->serie().'ecole = '.$enseignant->serie());
		}

		public function existEnseignant(Enseignant $info){
			
			$q = $this->_db->prepare("SELECT prof, matiere, ecole, idAnneeScolaire FROM enseigner WHERE prof='".$info->prof()."' AND  matiere='".$info->matiere()."' AND  ecole='".$info->ecole()."' AND  idAnneeScolaire='".$info->idAnneeScolaire()."'");
			$q->execute();
			return (bool) $q->fetchColumn();			
		}

		public function existSurveillant(Enseignant $info){
			
			$q = $this->_db->prepare("SELECT prof, ecole, idAnneeScolaire FROM enseigner WHERE prof='".$info->prof()."' AND  ecole='".$info->ecole()."' AND  idAnneeScolaire='".$info->idAnneeScolaire()."'");
			$q->execute();
			return (bool) $q->fetchColumn();			
		}

		public function selectClasseProf($i, Enseignant $info){
			
			$q = $this->_db->prepare("SELECT classe".$i." FROM enseigner WHERE prof='".$info->prof()."' AND  matiere='".$info->matiere()."' AND  ecole='".$info->ecole()."' AND  idAnneeScolaire='".$info->idAnneeScolaire()."'");
			$q->execute();
			return $q->fetchColumn();			
		}

		public function selectClasseSurveillant($i, Enseignant $info){
			
			$q = $this->_db->prepare("SELECT classe".$i." FROM enseigner WHERE prof='".$info->prof()."' AND  ecole='".$info->ecole()."' AND  idAnneeScolaire='".$info->idAnneeScolaire()."'");
			$q->execute();
			return $q->fetchColumn();			
		}

		public function getActuelAnSco(Enseignant $info){
			
			$q = $this->_db->prepare("SELECT max(idAnneeScolaire) FROM enseigner WHERE prof='".$info->prof()."' AND  ecole='".$info->ecole()."'");
			$q->execute();
			return $q->fetchColumn();			
		}

		public function getMatiere(Enseignant $info) {
			$q = $this->_db->prepare("SELECT DISTINCT matiere FROM enseigner WHERE prof='".$info->prof()."' AND ecole = '".$info->ecole()."' AND idAnneescolaire = '".$info->idAnneescolaire()."' ");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getEnseignant($enseignant) {
			$q = $this->_db->query('SELECT prof FROM enseigner WHERE prof = '.$enseignant);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Serie($donnees);			
		}

		public function getListEnseignant($enseignant) {
			$prof = array();
			$q = $this->_db->prepare('SELECT prof FROM enseigner WHERE (prof <> :enseignant) ORDER BY prof');
			$q->execute(array(':enseignant' => $enseignant));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$prof[] = new Enseignant($donnees);
			} 
			return $prof;
		} 
		public function updateEnseignant($i, Enseignant $enseignant) {
			$classe='classe'.$i;
			$q = $this->_db->prepare("UPDATE enseigner SET classe".$i."=:classe WHERE prof=:prof AND matiere=:matiere AND ecole=:ecole AND idAnneeScolaire=:idAnneeScolaire");
			$q->bindValue(':prof', $enseignant->prof());
			$q->bindValue(':matiere', $enseignant->matiere());
			$q->bindValue(':ecole', $enseignant->ecole());
			$q->bindValue(':idAnneeScolaire', $enseignant->idAnneeScolaire());
			$q->bindValue(':classe', $enseignant->$classe());
			$q->execute();
		}

		public function updateSurveillantt($i, Enseignant $enseignant) {
			$classe='classe'.$i;
			$q = $this->_db->prepare("UPDATE enseigner SET classe".$i."=:classe WHERE prof=:prof AND ecole=:ecole AND idAnneeScolaire=:idAnneeScolaire");
			$q->bindValue(':prof', $enseignant->prof());
			$q->bindValue(':ecole', $enseignant->ecole());
			$q->bindValue(':idAnneeScolaire', $enseignant->idAnneeScolaire());
			$q->bindValue(':classe', $enseignant->$classe());
			$q->execute();
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>