<?php 
	
	class NiveauFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addNiveau(Niveau $niveau) {
			$q = $this->_db->prepare('INSERT INTO niveau SET niveau=:niveau, ecole=:ecole');

			$q->bindValue(':niveau', $niveau->niveau());
			$q->bindValue(':ecole', $niveau->ecole());
			$q->execute();
		} 

		public function countNiveau() {
			return $this->_db->query('SELECT COUNT(*) FROM niveau')->fetchColumn();
		} 

		public function deleteNiveau(Niveau $niveau) {
			$this->_db->exec('DELETE FROM niveau WHERE niveau = '.$niveau->niveau());
		}

		public function existNiveau($info1, $info2){
			// On veut voir si tel nineau $info existe.
			$q = $this->_db->prepare("SELECT * FROM niveau WHERE niveau='".$info1."' AND ecole='".$info2."'");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getNiveau($niveau) {
			$q = $this->_db->query('SELECT niveau FROM niveau WHERE niveau = '.$niveau);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Niveau($donnees);			
		}

		public function getListNiveau($niveau) {
			$niveau = array();
			$q = $this->_db->prepare('SELECT niveau FROM niveau WHERE (niveau <> :niveau) ORDER BY niveau');
			$q->execute(array(':niveau' => $niveau));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$niveau[] = new Niveau($donnees);
			} 
			return $niveau;
		} 
		public function updateNiveau(Niveau $niveau) {
			$q = $this->_db->prepare('UPDATE niveau SET niveau=:niveau, ecole=:ecole');
			$q->bindValue(':niveau', $niveau->niveau());
			$q->bindValue(':ecole', $niveau->ecole());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>