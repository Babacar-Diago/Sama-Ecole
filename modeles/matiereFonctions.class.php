<?php 
	
	class MatiereFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addMatiere(Matieres $matiere) {
			$q = $this->_db->prepare('INSERT INTO matiere SET nom=:nom, ecole=:ecole');
			$q->bindValue(':nom', $matiere->nom());
			$q->bindValue(':ecole', $matiere->ecole());
			$q->execute();
		} 

		public function countMatiere() {
			return $this->_db->query('SELECT COUNT(*) FROM matiere')->fetchColumn();
		} 

		public function deleteMatiere(Matieres $matiere){
			$this->_db->exec('DELETE FROM matiere WHERE nom = '.$matiere->nom());
		}

		public function existMatiere($info1, $info2){

				$q = $this->_db->prepare('SELECT * FROM matiere WHERE nom = '.$info1.' AND ecole = '.$info2);
				$q->execute();
			    $q->fetchColumn();
		}

		public function getIdMatiere(Matieres $info) {
			$q = $this->_db->prepare("SELECT DISTINCT nom FROM matiere WHERE nom = '".$info->nom()."' AND ecole = '".$info->ecole()."' ");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getMatiere($info) {
			$q = $this->_db->query('SELECT nom FROM matiere WHERE nom = '.$info);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Matieres($donnees);			
		}

		public function getListMatiere($nom) {
			$matieres = array();
			$q = $this->_db->prepare('SELECT nom FROM matiere WHERE (nom <> :nom) ORDER BY nom');
			$q->execute(array(':nom' => $nom));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$matieres[] = new Matieres($donnees);
			} 
			return $matieres;
		} 
		public function updateMatiere(Matieres $matiere) {
			$q = $this->_db->prepare('UPDATE matiere SET nom=:nom');
			$q->bindValue(':nom', $matiere->nom());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>