<?php 
	
	class AnneeScolaireFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addAnneeScolaire(AnneeScolaire $anneeScolaire) {
			$q = $this->_db->prepare('INSERT INTO anneeScolaire SET anneeScolaire=:anneeScolaire, ecole=:ecole');

			$q->bindValue(':anneeScolaire', $anneeScolaire->anneeScolaire());
			$q->bindValue(':ecole', $anneeScolaire->ecole());
			$q->execute();
		} 

		public function getIdAnneeScolaire(AnneeScolaire $info) {
			$q = $this->_db->prepare("SELECT DISTINCT idAnneeScolaire FROM anneescolaire WHERE anneescolaire = '".$info->anneescolaire()."' AND ecole = '".$info->ecole()."' ");
			$q->execute();
			return $q->fetchColumn();
		}

		public function getActuelIdAnSco($info){
			
			$q = $this->_db->prepare("SELECT max(idAnneeScolaire) FROM anneescolaire WHERE ecole=:ecole");
			$q->execute(array(':ecole'=>$info));
			return $q->fetchColumn();			
		}

		public function getAnneeScolaire($anneeScolaire) {
			$q = $this->_db->prepare("SELECT anneeScolaire FROM anneeScolaire WHERE idAnneeScolaire = :idAnneeScolaire");
			$q->execute(array(':idAnneeScolaire'=>$anneeScolaire));
			return $q->fetchColumn();			
		}

		public function countAnneeScolaire() {
			return $this->_db->query('SELECT COUNT(*) FROM anneeScolaire')->fetchColumn();
		} 

		public function existAnneeScolaire($anneeScolaire) {
			return $this->_db->query("SELECT anneeScolaire FROM anneeScolaire WHERE anneescolaire='".$anneeScolaire."'")->fetchColumn();
		} 

		public function deleteAnneeScolaire(AnneeScolaire $anneeScolaire) {
			$this->_db->exec('DELETE FROM anneeScolaire WHERE anneeScolaire = '.$anneeScolaire->anneeScolaire());
		}

		public function getListAnneeScolaire($anneeScolaire) {
			$anneeScolaire = array();
			$q = $this->_db->prepare('SELECT anneeScolaire FROM anneeScolaire WHERE (anneeScolaire <> :anneeScolaire) ORDER BY anneeScolaire');
			$q->execute(array(':anneeScolaire' => $anneeScolaire));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$anneeScolaire[] = new AnneeScolaire($donnees);
			} 
			return $anneeScolaire;
		} 
		public function updateAnneeScolairee(AnneeScolaire $anneeScolaire) {
			$q = $this->_db->prepare('UPDATE anneeScolaire SET anneeScolaire=:anneeScolaire WHERE idAnneeScolaire=:idAnneeScolaire');
			$q->bindValue(':anneeScolaire', $anneeScolaire->anneeScolaire());
			$q->bindValue(':idAnneeScolaire', $anneeScolaire->idAnneeScolaire(), PDO::PARAM_INT);

			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>