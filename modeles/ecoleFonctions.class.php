<?php 
	
	class EcoleFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addEcole(Ecole $ecole) {
			$q = $this->_db->prepare('INSERT INTO ecole SET idEcole=:idEcole, nomEcole=:nomEcole, email=:email, telefax=:telefax, telephone1=:telephone1, telephone2=:telephone2, BP=:BP, commune=:commune, 
				nomInspection=:nomInspection, idInspection=:idInspection, motDePasse=:motDePasse, confirmation_token=:confirmation_token');

			$q->bindValue(':idEcole', $ecole->idEcole());
			$q->bindValue(':nomEcole', $ecole->nomEcole());
			$q->bindValue(':email', $ecole->email());
			$q->bindValue(':telefax', $ecole->telefax());
			$q->bindValue(':telephone1', $ecole->telephone1());
			$q->bindValue(':telephone2', $ecole->telephone2());
			$q->bindValue(':BP', $ecole->BP());
			$q->bindValue(':commune', $ecole->commune());
			$q->bindValue(':nomInspection',$ecole->nomInspection());
			$q->bindValue(':idInspection', $ecole->idInspection());
			$q->bindValue(':motDePasse', $ecole->motDePasse());
			$q->bindValue(':confirmation_token', $ecole->confirmation_token());
			$q->execute();
		} 

		public function deleteEcole(Ecole $ecole){
			$this->_db->exec('DELETE FROM ecole WHERE idEcole = '.$ecole->idEcole() );
		}

		public function existEcole($nomEcole){
			// On veut voir si tel ecole existe.
			if ($nomEcole) {
				$q = $this->_db->prepare('SELECT COUNT(*) FROM ecole WHERE nomEcole = '.$nomEcole);
				$q->execute();
				return (bool) $q->fetchColumn();
			} 
			
		}

		public function getIdEcole(Ecole $info1) {
		   $q = $this->_db->prepare("SELECT idEcole FROM ecole WHERE nomEcole = '".$info1->nomEcole()."'");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getEcole($nomEcole) {
			$q = $this->_db->query('SELECT * FROM ecole WHERE nomEcole = '.$nomEcole );
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Ecole($donnees);		
		}

		public function getListEcole() {
			$ecole = array();
			$q = $this->_db->prepare('SELECT * FROM ecole ORDER BY idEcole desc');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$ecole[] = new Ecole($donnees);
			} 
			return $ecole;
		} 
		public function udateEcole(Ecole $ecole) {
			$q = $this->_db->prepare('UPDATE ecole SET idEcole=:idEcole, nomEcole=:nomEcole, email=:email, telefax=:telefax, 
				telephone1=:telephone1, telephone2=:telephone2, BP=:BP, commune=:commune, 
				nomInspection=:nomInspection, idInspection=:idInspection, motDePasse=:motDePasse
				 WHERE idEcole = :idEcole ');
			
			$q->bindValue(':idEcole', $ecole->idEcole());
			$q->bindValue(':nomEcole', $ecole->nomEcole());
			$q->bindValue(':email', $ecole->email());
			$q->bindValue(':telefax', $ecole->telefax());
			$q->bindValue(':telephone1', $ecole->telephone1());
			$q->bindValue(':telephone2', $ecole->telephone2());
			$q->bindValue(':BP', $ecole->BP());
			$q->bindValue(':commune', $ecole->commune());
			$q->bindValue(':nomInspection', $ecole->nomInspection());
			$q->bindValue(':idInspection', $ecole->idInspection());
			$q->bindValue(':motDePasse', $ecole->motDePasse());
			$q->execute();
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}

	} 

?>