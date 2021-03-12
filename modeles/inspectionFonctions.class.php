<?php 
	
	class InspectionFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addInspection(Inspection $inspection) {
			$q = $this->_db->prepare('INSERT INTO inspection SET idInspection=:idInspection, nomInspection=:nomInspection, region=:region, 
				departement=:departement, email=:email, telefax=:telefax, telephone1=:telephone1, telephone2=:telephone2, BP=:BP, motDePasse=:motDePasse, confirmation_token=:confirmation_token');

			$q->bindValue(':idInspection', $inspection->idInspection());
			$q->bindValue(':nomInspection', $inspection->nomInspection());
			$q->bindValue(':region', $inspection->region());
			$q->bindValue(':departement', $inspection->departement());
			$q->bindValue(':email', $inspection->email());
			$q->bindValue(':telefax', $inspection->telefax());
			$q->bindValue(':telephone1', $inspection->telephone1());
			$q->bindValue(':telephone2', $inspection->telephone2());
			$q->bindValue(':BP', $inspection->BP());
			$q->bindValue(':motDePasse', $inspection->motDePasse());
			$q->bindValue(':confirmation_token', $inspection->confirmation_token());
			$q->execute();
		} 

		public function deleteInspection(Inspection $inspection){
			$this->_db->exec('DELETE FROM inspection WHERE idInspection = '.$inspection->idInspection() );
		}

		public function existInspection($nomInspection){
			// On veut voir si telle inspection existe.
			if ($nomInspection) {
				$q = $this->_db->prepare('SELECT COUNT(*) FROM inspection WHERE nomInspection = '.$nomInspection);
				$q->execute();
				return (bool) $q->fetchColumn();
			} 
			
		}
		
		public function getInspection($nomInspection) {
			$q = $this->_db->query('SELECT * FROM inspection WHERE nomInspection = '.$nomInspection );
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Inspection($donnees);		
		}

		public function getIdInspection($info1) {
		   $q = $this->_db->prepare("SELECT idInspection FROM inspection WHERE nomInspection = :nomInspection");
			$q->execute(array(':nomInspection'=>$info1));
			return $q->fetchColumn();
		}

		public function getListInspection() {
			$inspection = array();
			$q = $this->_db->prepare('SELECT * FROM inspection ORDER BY idInspection desc');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$inspection[] = new Inspection($donnees);
			} 
			return $inspection;
		} 
		public function udateInspection(Inspection $ecole) {
			$q = $this->_db->prepare('UPDATE inspection SET idInspection=:idInspection, nomInspection=:nomInspection, region=:region, 
				departement=:departement, email=:email, telefax=:telefax, 
				telephone1=:telephone1, telephone2=:telephone2, BP=:BP, motDePasse=:motDePasse');

			$q->bindValue(':idInspection', $inspection->idInspection());
			$q->bindValue(':nomInspection', $inspection->nomInspection());
			$q->bindValue(':region', $inspection->region());
			$q->bindValue(':departement', $inspection->departement());
			$q->bindValue(':email', $inspection->email());
			$q->bindValue(':telefax', $inspection->telefax());
			$q->bindValue(':telephone1', $inspection->telephone1());
			$q->bindValue(':telephone2', $inspection->telephone2());
			$q->bindValue(':BP', $inspection->BP());
			$q->bindValue(':motDePasse', $inspection->motDePasse());
			$q->execute();		
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}

	} 

?>