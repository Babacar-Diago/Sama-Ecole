<?php 
	
	class SerieFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addSerie(Serie $serie) {
			$q = $this->_db->prepare('INSERT INTO serie SET serie=:serie, ecole=:ecole');

			$q->bindValue(':serie', $serie->serie());
			$q->bindValue(':ecole', $serie->ecole());
			$q->execute();
		} 

		public function countSerie() {
			return $this->_db->query('SELECT COUNT(*) FROM serie')->fetchColumn();
		} 

		public function deleteSerie(Serie $serie) {
			$this->_db->exec('DELETE FROM serie WHERE serie = '.$serie->serie());
		}

		public function existSerie($info1, $info2){
			// On veut voir si tel serie $info existe.
			$q = $this->_db->prepare("SELECT * FROM serie WHERE serie='".$info1."' AND ecole='".$info2."'");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getSerie($serie) {
			$q = $this->_db->query('SELECT serie FROM serie WHERE serie = '.$serie);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Serie($donnees);			
		}

		public function getListSerie($serie) {
			$niveau = array();
			$q = $this->_db->prepare('SELECT serie FROM serie WHERE (serie <> :serie) ORDER BY serie');
			$q->execute(array(':serie' => $serie));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$niveau[] = new Serie($donnees);
			} 
			return $niveau;
		} 
		public function updateSerie(Serie $serie) {
			$q = $this->_db->prepare('UPDATE serie SET serie=:serie, ecole=:ecole');
			$q->bindValue(':serie', $serie->serie());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>