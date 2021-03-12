<?php 
	
	class NoteFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addNote(Notes $note) {
			$q = $this->_db->prepare('INSERT INTO note SET nomSemestre=:nomSemestre, noteDevoir=:noteDevoir, noteComposition=:noteComposition, moyenne=:moyenne, coef=:coef, moyenneX=:moyenneX, appreciation=:appreciation, rang=:rang, eleve=:eleve, matiere=:matiere, niveau=:niveau, serie=:serie, classe=:classe, idAnneeScolaire=:idAnneeScolaire, anneeScolaire=:anneeScolaire, ecole=:ecole');

			$q->bindValue(':nomSemestre', $note->nomSemestre());
			$q->bindValue(':noteDevoir', $note->noteDevoir());
			$q->bindValue(':noteComposition', $note->noteComposition());
			$q->bindValue(':moyenne', $note->moyenne());
			$q->bindValue(':coef', $note->coef());
			$q->bindValue(':moyenneX', $note->moyenneX());
			$q->bindValue(':appreciation', $note->appreciation());
			$q->bindValue(':rang', $note->rang());
			$q->bindValue(':eleve', $note->eleve());
			$q->bindValue(':matiere', $note->matiere());
			$q->bindValue(':niveau', $note->niveau());
			$q->bindValue(':serie', $note->serie());
			$q->bindValue(':classe', $note->classe());
			$q->bindValue(':idAnneeScolaire', $note->idAnneeScolaire());
			$q->bindValue(':anneeScolaire', $note->anneeScolaire());
			$q->bindValue(':ecole', $note->ecole());
			$q->execute();
		} 

		public function deleteNote(Notes $note){
			$this->_db->exec('DELETE FROM note WHERE nomSemestre = '.$note->nomSemestre().'AND eleve = '.$note->eleve().'AND matiere = '.$note->matiere());
		}

		public function existNote($note){
			// On veut voir si tel note existe.
			if ($note) {
				return (bool) $this->_db->query('SELECT COUNT(*) FROM note WHERE moyenne = '.$note)->fetchColumn();
			} 
			
		}

		public function existNoteEleve($eleve){
			$q = $this->_db->prepare('SELECT COUNT(*) FROM note WHERE nomSemestre=:nomSemestre AND eleve=:eleve AND matiere=:matiere');
			$q->execute(array(':eleve' => $eleve));
			return (bool) $q->fetchColumn();
		}

		public function nomMatiereRempli(Notes $info){
			$nomMatiere = array();
			$q = $this->_db->prepare("SELECT DISTINCT matiere FROM note WHERE
				nomSemestre='".$info->nomSemestre()."' AND
				classe='".$info->classe()."' AND
				idAnneeScolaire='".$info->idAnneeScolaire()."' AND
				ecole='".$info->ecole()."' ");
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$nomMatiere[] = new Notes($donnees);
			} 
			return $nomMatiere;
		} 
		
		public function getNote($info1, $info2) {
			$q = $this->_db->query('SELECT * FROM note WHERE note = '.$info1.'AND eleve = '.$info2);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new Notes($donnees);			
		}

		public function getListNote() {
			$moyennes = array();
			$q = $this->_db->prepare('SELECT * FROM note ORDER BY eleve');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$moyennes[] = new Notes($donnees);
			} 
			return $moyennes;
		} 
		public function updateNote(Notes $note) {
			$q = $this->_db->prepare('UPDATE note SET nomSemestre=:nomSemestre, noteDevoir=:noteDevoir, noteComposition=:noteComposition, moyenne=:moyenne, moyenneX=:moyenneX, rang=:rang, eleve=:eleve, matiere=:matiere, classe=:classe WHERE nomSemestre = :nomSemestre AND eleve = :eleve AND matiere = :matiere');
			
			$q->bindValue(':nomSemestre', $note->nomSemestre());
			$q->bindValue(':noteDevoir', $note->noteDevoir());
			$q->bindValue(':noteComposition', $note->noteComposition());
			$q->bindValue(':moyenne', $note->moyenne());
			$q->bindValue(':moyenneX', $note->moyenneX());
			$q->bindValue(':rang', $note->rang());
			$q->bindValue(':eleve', $note->eleve());
			$q->bindValue(':matiere', $note->matiere());
			$q->bindValue(':classe', $note->classe());
			$q->execute();
		}
		public function update(Notes $note) {
			$q = $this->_db->prepare("UPDATE note SET noteComposition='NULL', moyenne='NULL', moyenneX='NULL' WHERE nomSemestre = '".$note->nomSemestre()."' AND eleve = '".$note->eleve()."' AND matiere = '".$note->matiere()."' AND idAnneeScolaire = '".$note->idAnneeScolaire()."'");
			$q->bindValue(':nomSemestre', $note->nomSemestre());
			$q->bindValue(':noteDevoir', $note->noteDevoir());
			$q->bindValue(':noteComposition', $note->noteComposition());
			$q->bindValue(':moyenne', $note->moyenne());
			$q->bindValue(':moyenneX', $note->moyenneX());
			$q->bindValue(':rang', $note->rang());
			$q->bindValue(':eleve', $note->eleve());
			$q->bindValue(':matiere', $note->matiere());
			$q->bindValue(':classe', $note->classe());
			$q->execute();
		}
		public function appreciation(Notes $moyenne){
			if ($moyenne->moyenne()<5) {
				$appreciation = "Tres Faible";
			}
			elseif ($moyenne->moyenne()>=5 AND $moyenne->moyenne()<8) {
				$appreciation = "Faible";
			}
			elseif ($moyenne->moyenne()>=8 AND $moyenne->moyenne()<10) {
				$appreciation = "Insuffisant";
			}
			elseif ($moyenne->moyenne()>=10 AND $moyenne->moyenne()<12) {
				$appreciation = "Passable";
			}
			elseif ($moyenne->moyenne()>=12 AND $moyenne->moyenne()<14) {
				$appreciation = "Assez Bien";
			}
			elseif ($moyenne->moyenne()>=14 AND $moyenne->moyenne()<16) {
				$appreciation = "Bien";
			}
			elseif ($moyenne->moyenne()>=16 AND $moyenne->moyenne()<18) {
				$appreciation = "Tres Bien";
			}
			elseif ($moyenne->moyenne()>=18 AND $moyenne->moyenne()<=20) {
				$appreciation = "Excelant";
			}
			else{
				$appreciation = null;
			}

			return $appreciation;
		} 
		/*public function coef(Notes $info){
			$q = $this->_db->prepare("SELECT coef FROM avoirmatiere WHERE
				avoirmatiere.matiere='".$info->matiere()."' AND
				avoirmatiere.niveau='".$info->niveau()."' AND
				avoirmatiere.serie='".$info->serie()."' AND
				avoirmatiere.ecole='".$info->ecole()."' ");
			$q->execute();
			return $q->fetchColumn();
		} */
		public function sumCoef(Notes $info){
			$q = $this->_db->prepare("SELECT sum(coef) FROM note WHERE
				 note.eleve='".$info->eleve()."' AND
				 note.niveau='".$info->niveau()."' AND
				 note.serie='".$info->serie()."' AND
				 note.classe='".$info->classe()."' AND
				 note.idAnneeScolaire='".$info->idAnneeScolaire()."' AND 
				 note.ecole='".$info->ecole()."'");
			$q->execute();
			return $q->fetchColumn();
		} 
		public function sumMoyX(Notes $info){
			$q = $this->_db->prepare("SELECT sum(moyenneX) FROM note WHERE
				 note.eleve='".$info->eleve()."' AND
				 note.niveau='".$info->niveau()."' AND
				 note.serie='".$info->serie()."' AND
				 note.classe='".$info->classe()."' AND
				 note.idAnneeScolaire='".$info->idAnneeScolaire()."' AND 
				 note.ecole='".$info->ecole()."'");
			$q->execute();
			return $q->fetchColumn();
		} 
			
		public function rangDevoir(Notes $moyenne){
				
			$q = $this->_db->prepare(
				" update note as t1
					inner join  ( 

     					select  ta.nomSemestre, ta.moyenne, ta.eleve, ta.matiere, ta.niveau, ta.classe, ta.idAnneeScolaire, ta.ecole,
             				count(case when tb.moyenne > ta.moyenne 
         					AND ta.nomSemestre = '".$moyenne->nomSemestre()."'
         				   AND ta.matiere = '".$moyenne->matiere()."'
         					AND ta.niveau = '".$moyenne->niveau()."'
         					AND ta.classe = '".$moyenne->classe()."'
         					AND ta.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
         					AND ta.ecole = '".$moyenne->ecole()."'

         					AND tb.nomSemestre = '".$moyenne->nomSemestre()."'
	             			AND tb.matiere = '".$moyenne->matiere()."'
	             			AND tb.niveau = '".$moyenne->niveau()."'
	             			AND tb.classe = '".$moyenne->classe()."'
	             			AND tb.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
	             			AND tb.ecole = '".$moyenne->ecole()."'

             				then 1 else null end) + 1 as rang
       					from  note as ta

					left outer join  note as tb
             			on  tb.moyenne >= ta.moyenne
             			AND tb.nomSemestre = '".$moyenne->nomSemestre()."'
             			AND tb.matiere = '".$moyenne->matiere()."'
             			AND tb.niveau = '".$moyenne->niveau()."'
             			AND tb.classe = '".$moyenne->classe()."'
             			AND tb.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
             			AND tb.ecole = '".$moyenne->ecole()."'

             			AND ta.nomSemestre = '".$moyenne->nomSemestre()."'
     					AND ta.matiere = '".$moyenne->matiere()."'
     					AND ta.niveau = '".$moyenne->niveau()."'
     					AND ta.classe = '".$moyenne->classe()."'
     					AND ta.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
     					AND ta.ecole = '".$moyenne->ecole()."'

       				group by  ta.eleve, ta.moyenne
       				order by  ta.eleve, ta.moyenne desc
 
				) as t2 

        		on  t2.moyenne = t1.moyenne
        		AND t2.nomSemestre = '".$moyenne->nomSemestre()."'
             	AND t2.matiere = '".$moyenne->matiere()."'
             	AND t2.niveau = '".$moyenne->niveau()."'
             	AND t2.classe = '".$moyenne->classe()."'
             	AND t2.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
             	AND t2.ecole = '".$moyenne->ecole()."'

             	AND t1.nomSemestre = '".$moyenne->nomSemestre()."'
     			AND t1.matiere = '".$moyenne->matiere()."'
     			AND t1.niveau = '".$moyenne->niveau()."'
     			AND t1.classe = '".$moyenne->classe()."'
     			AND t1.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'
     			AND t1.ecole = '".$moyenne->ecole()."'

       			set  t1.rang = t2.rang "
			);

	        $q->execute();     
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	} 

?>