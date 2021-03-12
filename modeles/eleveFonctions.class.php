<?php 
	
	class EleveFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addEleve(Eleves $eleve) {
			$q = $this->_db->prepare('INSERT INTO eleve SET matricule=:matricule, nom=:nom, prenom=:prenom, sexe=:sexe, dateNaissance=:dateNaissance, lieuNaissance=:lieuNaissance, origine=:origine, motifEntre=:motifEntre, numeroTel=:numeroTel, email=:email, ecole=:ecole');

			$q->bindValue(':matricule', $eleve->matricule());
			$q->bindValue(':nom', $eleve->nom());
			$q->bindValue(':prenom', $eleve->prenom());
			$q->bindValue(':sexe', $eleve->sexe());
			$q->bindValue(':dateNaissance', $eleve->dateNaissance());
			$q->bindValue(':lieuNaissance', $eleve->lieuNaissance());
			$q->bindValue(':origine', $eleve->origine());
			$q->bindValue(':motifEntre', $eleve->motifEntre());
			$q->bindValue(':numeroTel', $eleve->numeroTel());
			$q->bindValue(':email', $eleve->email());
			$q->bindValue(':ecole', $eleve->ecole());
			$q->execute();
		} 

		public function countEleve() {
			return $this->_db->query('SELECT COUNT(*) FROM eleve')->fetchColumn();
		} 

		public function deleteEleve(Eleves $eleve){
			$this->_db->exec('DELETE FROM eleve WHERE matricule = '.$eleve->matricule());
		}

		public function existEleve($info1, $info2){
			$q = $this->_db->prepare("SELECT * FROM eleve WHERE matricule='".$info1."' AND ecole='".$info2."'");
			$q->execute();
			return $q->fetchColumn();
		}

		public function existMail($info){
			$q = $this->_db->prepare("SELECT email FROM eleve WHERE email='".$info."' AND statut='REGULIER'");
			$q->execute();
			return $q->fetchColumn();
		}
		
		public function getEleves($info) {
			$q = $this->_db->query('SELECT matricule, nom, prenom, sexe, date_naissance, lieu_naissance, origine, motif_entre FROM eleve WHERE matricule = '.$info);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Eleves($donnees);			
		}

		public function getListEleve($nom) {
			$eleves = array();
			$q = $this->_db->prepare('SELECT matricule, nom, prenom, sexe, date_naissance, lieu_naissance, origine, motif_entre FROM eleve WHERE (nom <> :nom) OR (prenom <> :nom) ORDER BY nom');
			$q->execute(array(':nom' => $nom));
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$eleves[] = new Eleves($donnees);
			} 
			return $eleves;
		} 
		public function updateEleve(Eleves $eleve) {
			$q = $this->_db->prepare('UPDATE eleve SET nom=:nom, prenom=:prenom, sexe=:sexe, date_naissance=:date_nais, lieu_nais=:lieu_nais, origine=:origine, motif_entre=:motif_entre WHERE matricule = :matricule AND ecole=:ecole');
			$q->bindValue(':nom', $eleve->nom());
			$q->bindValue(':prenom', $eleve->prenom());
			$q->bindValue(':sexe', $eleve->sexe());
			$q->bindValue(':date_nais', $eleve->date_naissance());
			$q->bindValue(':lieu_nais', $eleve->lieu_naissance());
			$q->bindValue(':origine', $eleve->origine());
			$q->bindValue(':motif_entre', $eleve->motif_entre());
			$q->bindValue(':statut', $eleve->statut());
			$q->bindValue(':matricule', $perso->matricule());
			$q->bindValue(':ecole', $perso->ecole());
			$q->execute();
		} 
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	} 

?>