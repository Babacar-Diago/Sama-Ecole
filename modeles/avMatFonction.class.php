<?php 
	
	class AvMatFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addAvMatiere(AvoirMatiere $nom) {
			$q = $this->_db->prepare('INSERT INTO avoirmatiere SET matiere=:matiere, niveau=:niveau, serie=:serie, coef=:coef, ecole=:ecole');
			$q->bindValue(':matiere', $nom->matiere());
			$q->bindValue(':niveau', $nom->niveau());
			$q->bindValue(':serie', $nom->serie());
			$q->bindValue(':coef', $nom->coef());
			$q->bindValue(':ecole', $nom->ecole());
			$q->execute();
		} 

		public function nbrMatiere(AvoirMatiere $info) {  
			return $this->_db->query("SELECT COUNT('matiere') FROM avoirmatiere WHERE
				niveau='".$info->niveau()."' AND
				serie='".$info->serie()."' AND
				ecole='".$info->ecole()."' ")->fetchColumn();
		} 

		public function deleteMatiere(AvoirMatiere $matiere, AvoirMatiere $niveau, AvoirMatiere $serie){
			$this->_db->exec('DELETE FROM classe WHERE matiere = '.$matiere->matiere().'niveau = '.$niveau->niveau().'serie = '.$serie->serie());
		}

		public function getNomMatiere(AvoirMatiere $info){
			$nomMatiere = array();
			$q = $this->_db->prepare("SELECT matiere FROM avoirmatiere WHERE
				niveau='".$info->niveau()."' AND
				serie='".$info->serie()."' AND
				ecole='".$info->ecole()."' ");
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$nomMatiere[] = new AvoirMatiere($donnees);
			} 
			return $nomMatiere;
		} 

		public function coef(AvoirMatiere $info){
			$q = $this->_db->prepare("SELECT coef FROM avoirmatiere WHERE
				matiere='".$info->matiere()."' AND
				niveau='".$info->niveau()."' AND
				serie='".$info->serie()."' AND
				ecole='".$info->ecole()."' ");
			$q->execute();
			return $q->fetchColumn();
		} 

		public function existCoefMatiere($info1, $info2, $info3, $info4){

			$q = $this->_db->prepare("SELECT * FROM avoirmatiere WHERE matiere='".$info1."' AND  niveau='".$info2."' AND  serie='".$info3."' AND  ecole='".$info4."'");
			$q->execute();
			return $q->fetchColumn();
		}

		public function existMatiere($info){
			// On veut voir si telle classe ayant pour nom $info existe.
			if ($info) {
				$q = $this->_db->prepare('SELECT COUNT(*) FROM avoirmatiere WHERE matiere = '.$info);
				$q->execute();
				return (bool) $q->fetchColumn();
			} 
		}
		public function existNiveau($info){
			// On veut voir si telle classe ayant pour nom $info existe.
			if ($info) {
				$q = $this->_db->prepare('SELECT COUNT(*) FROM avoirmatiere WHERE niveau = '.$info);
				$q->execute();
				return (bool) $q->fetchColumn();
			} 
		}
		public function existSerie($info){
			// On veut voir si telle classe ayant pour nom $info existe.
			if ($info) {
				$q = $this->_db->prepare('SELECT COUNT(*) FROM avoirmatiere WHERE serie = '.$info);
				$q->execute();
				return (bool) $q->fetchColumn();
			} 
		}
	
		public function getListClasse() {
			$matieres = array();
			$q = $this->_db->prepare('SELECT * FROM avoirmatiere');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$matieres[] = new Classes($donnees);
			} 
			return $matieres;
		} 
		public function updateMatiere(Classes $nom) {
			$q = $this->_db->prepare('UPDATE avoirmatiere SET matiere=:matiere');
			$q->bindValue(':matiere', $nom->matiere());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
		
	
	} 

?>