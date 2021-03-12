<?php 
	
	class ClasseFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addClasse(Classes $nom) {
			$q = $this->_db->prepare('INSERT INTO classe SET nom=:nom, niveau=:niveau, serie=:serie, nombreEleves=:nombreEleves, idAnneeScolaire=:idAnneeScolaire, ecole=:ecole');
			$q->bindValue(':nom', $nom->nom());
			$q->bindValue(':niveau', $nom->niveau());
			$q->bindValue(':serie', $nom->serie());
			$q->bindValue(':nombreEleves', $nom->nombreEleves());
			$q->bindValue(':idAnneeScolaire', $nom->idAnneeScolaire());
			$q->bindValue(':ecole', $nom->ecole());
			$q->execute();
		} 

		public function countClasse() {  
			return $this->_db->query('SELECT COUNT(*) FROM classe')->fetchColumn();
		} 

		public function deleteClasse(Classes $nom){
			$this->_db->exec('DELETE FROM classe WHERE nom = '.$nom->nom().'anneeScolaire = '.$nom->anneeScolaire());
		}

		public function existClasse($info1, $info2, $info3){

			$q = $this->_db->prepare("SELECT * FROM classe WHERE nom='".$info1."' AND  idAnneescolaire='".$info2."' AND  ecole='".$info3."'");
			$q->execute();
			return (bool) $q->fetchColumn();
		}

		public function nbrClasse(Classes $classe){
			return $this->_db->query("SELECT COUNT('nom') FROM classe WHERE niveau='".$classe->niveau()."' AND idAnneeScolaire='".$classe->idAnneeScolaire()."' AND ecole='".$classe->ecole()."'")->fetchColumn();
		}
		
		public function getClasse(Classes $info) {
			$q = $this->_db->query('SELECT nom FROM classe WHERE nom = '.$info);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Classes($donnees);			
		}

		public function getListClasse(Classes $classe) {
			
			$q = $this->_db->prepare("SELECT * FROM classe WHERE niveau=:niveau AND idAnneeScolaire=:idAnneeScolaire AND ecole=:ecole ORDER BY nom");
			$q->bindValue(':niveau', $classe->niveau());
			$q->bindValue(':idAnneeScolaire', $classe->idAnneeScolaire());
			$q->bindValue(':ecole', $classe->ecole());
			$q->execute();
			 
			$result = $q->fetchAll();
		                      
              $i = 0;
              foreach ($result as $key => $value) {
              $i = ++$i; 
              
              	echo "<tr>";
	              	echo "<td align='center'>".$value['nom']."</td>";
	              	echo "<td align='center'>".$value['niveau']."</td>";
	              	echo "<td align='center'>".$value['serie']."</td>";
	              	echo "<td align='center'>".$value['nombreEleves']."</td>";
              	echo "<tr>";
              }
		} 

		public function updateClasse(Classes $nom) {
			$q = $this->_db->prepare('UPDATE classe SET niveau=:niveau, serie=:serie, nombreEleves=:nombreEleves WHERE nom=:nom and idAnneeScolaire=:idAnneeScolaire, ecole=:ecole');
			$q->bindValue(':nom', $nom->nom());
			$q->bindValue(':niveau', $nom->niveau());
			$q->bindValue(':serie', $nom->serie());
			$q->bindValue(':nombreEleves', $nom->nombreEleves());
			$q->bindValue(':idAnneeScolaire', $nom->idAnneeScolaire());
			$q->bindValue(':ecole', $nom->ecole());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>