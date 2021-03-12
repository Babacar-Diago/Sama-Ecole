<?php 
	
	class EtreEleveFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addEtreEleve(EtreEleve $eleve) {
			$q = $this->_db->prepare('INSERT INTO etreeleve SET eleve=:eleve, niveau=:niveau, serie=:serie, classe=:classe, idAnneeScolaire=:idAnneeScolaire, classeDoublee=:classeDoublee, ecole=:ecole, dateInscription=NOW()');

			$q->bindValue(':eleve', $eleve->eleve());
			$q->bindValue(':niveau', $eleve->niveau());
			$q->bindValue(':serie', $eleve->serie());
			$q->bindValue(':classe', $eleve->classe());
			$q->bindValue(':idAnneeScolaire', $eleve->idAnneeScolaire());
			$q->bindValue(':classeDoublee', $eleve->classeDoublee());
			$q->bindValue(':ecole', $eleve->ecole());
			$q->execute();
		} 

		public function deleteEtreEleve(EtreEleve $eleve){
			$this->_db->exec('DELETE FROM etreeleve WHERE eleve = '.$eleve->eleve().'AND anneeScolaire = '.$eleve->anneeScolaire());
		}

		public function dejaInsctit($info1, $info2, $info3, $info4){

			$q = $this->_db->prepare("SELECT * FROM etreeleve WHERE eleve='".$info1."' AND  niveau='".$info2."' AND  idAnneescolaire='".$info3."' AND  ecole='".$info4."'");
			$q->execute();
			return $q->fetchColumn();
		}

		public function nombreInsctit($anneeScolaire){
			// On veut voir si tel note existe.
			if ($eleve) {
				return (bool) $this->_db->query('SELECT COUNT(*) FROM etreeleve WHERE idAnneeScolaire = '.$anneeScolaire)->fetchColumn();
			} 
			
		}

		public function getEleve(EtreEleve $eleve){
			$q = $this->_db->prepare("SELECT eleve FROM etreeleve WHERE niveau = '".$eleve->niveau()."' AND classe = '".$eleve->classe()."' AND idAnneeScolaire = '".$eleve->idAnneeScolaire()."' AND ecole = '".$eleve->ecole()."'");
			$q->execute();
			return $q->fetchColumn();
		}

		public function nombreEleves(EtreEleve $eleve){
			return $this->_db->query("SELECT COUNT('eleve') FROM etreeleve WHERE niveau = '".$eleve->niveau()."' AND classe = '".$eleve->classe()."' AND idAnneeScolaire = '".$eleve->idAnneeScolaire()."' AND ecole = '".$eleve->ecole()."'")->fetchColumn();
		}
		
		public function getEtreEleve($info1, $info2, $info3) {
			$q = $this->_db->query('SELECT * FROM etreeleve WHERE eleve = '.$info1.'AND anneeScolaire = '.$info2.'AND anneeScolaire = '.$info3);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new EtreEleve($donnees);			
		}

		public function getListEtreEleve() {
			$eleves = array();
			$q = $this->_db->prepare('SELECT * FROM etreeleve ORDER BY eleve, anneeScolaire desc');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$eleves[] = new EtreEleve($donnees);
			} 
			return $eleves;
		} 
		public function udateEtreEleve(EtreEleve $eleve) {
			$q = $this->_db->prepare('UPDATE etreeleve SET eleve=:eleve, niveau=:niveau, serie=:serie, classe=:classe, idAnneeScolaire=:idAnneeScolaire, anneeScolaire=:anneeScolaire, classeDoublee=:classeDoublee WHERE eleve = :eleve AND ecole = :ecole');
			
			$q->bindValue(':eleve', $eleve->eleve());
			$q->bindValue(':niveau', $eleve->niveau());
			$q->bindValue(':serie', $eleve->serie());
			$q->bindValue(':classe', $eleve->classe());
			$q->bindValue(':idAnneeScolaire', $eleve->idAnneeScolaire());
			$q->bindValue(':ecole', $eleve->ecole());
			$q->bindValue(':classeDoublee', $eleve->classeDoublee());
			$q->execute();
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}

	} 

?>