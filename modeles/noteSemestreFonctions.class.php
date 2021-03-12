<?php 
	
	class NoteSemestreFonctions {

		private $_db; // Instance de PDO

		public function __construct($db) {
			$this->setDb($db);
		}

		public function addNoteSemestre(NoteSemestre $note) {
			$q = $this->_db->prepare('INSERT INTO notesemestre SET nomSemestre=:nomSemestre, sumMoyX=:sumMoyX, sumCoef=:sumCoef, moyGenerale=:moyGenerale, appreciation=:appreciation, /*rang=:rang,*/ eleve=:eleve, classe=:classe, idAnneeScolaire=:idAnneeScolaire, ecole=:ecole');

			$q->bindValue(':nomSemestre', $note->nomSemestre());
			$q->bindValue(':sumMoyX', $note->sumMoyX());
			$q->bindValue(':sumCoef', $note->sumCoef());
			$q->bindValue(':moyGenerale', $note->moyGenerale());
			$q->bindValue(':appreciation', $note->appreciation());
			//$q->bindValue(':rang', $note->rang());
			$q->bindValue(':eleve', $note->eleve());
			$q->bindValue(':classe', $note->classe());
			$q->bindValue(':idAnneeScolaire', $note->idAnneeScolaire());
			$q->bindValue(':ecole', $note->ecole());
			$q->execute();
		} 

		public function deleteMoyGenerale(NoteSemestre $moyGenerale){
			$this->_db->exec('DELETE FROM notesemestre WHERE nomSemestre = '.$moyGenerale->nomSemestre().'AND eleve = '.$moyGenerale->eleve().'AND rang = '.$moyGenerale->rang());
		}

		
		public function existMoyGenerale(NoteSemestre $moyGenerale) {
			// On veut voir si la moyenne de la classe existe.
			$q= $this->_db->prepare("SELECT * FROM notesemestre WHERE nomSemestre='".$moyGenerale->nomSemestre()."' AND  classe='".$moyGenerale->classe()."' AND  idAnneeScolaire='".$moyGenerale->idAnneeScolaire()."' AND  ecole='".$moyGenerale->ecole()."'");
			$q->execute();
			return (bool) $q->fetchColumn();
		}

		public function exist_Moy_Generale($moyGenerale){
			// On veut voir si tel note existe.
			if ($moyGenerale) {
				return (bool) $this->_db->query('SELECT COUNT(*) FROM notesemestre WHERE moyGenerale = '.$moyGenerale)->fetchColumn();
			} 
			
		}

		public function existMoyEleve($eleve){
			$q = $this->_db->prepare('SELECT COUNT(*) FROM notesemestre WHERE nomSemestre=:nomSemestre AND eleve=:eleve AND moyGenerale=:moyGenerale');
			$q->execute(array(':eleve' => $eleve));
			return (bool) $q->fetchColumn();
		}
		
		public function getMoySemestre($info1, $info2) {
			$q = $this->_db->query('SELECT * FROM noteSemestre WHERE nomSemestre = '.$info1.'AND eleve = '.$info2);
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			return new NoteSemestre($donnees);			
		}

		public function getListNote() {
			$moyennes = array();
			$q = $this->_db->prepare('SELECT * FROM noteSemestre ORDER BY eleve');
			$q->execute();
			while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$moyennes[] = new NoteSemestre($donnees);
			} 
			return $moyennes;
		} 
		public function updateNoteSemestre(NoteSemestre $note) {
			$q = $this->_db->prepare('UPDATE notesemestre SET nomSemestre=:nomSemestre,sumMoyX=:sumMoyX,sumCoef=:sumCoef, moyGenerale=:moyGenerale, appreciation=:appreciation, rang=:rang, eleve=:eleve, classe=:classe, idAnneeScolaire=:idAnneeScolaire, ecole=:ecole');
			
			$q->bindValue(':nomSemestre', $note->nomSemestre());
			$q->bindValue(':sumMoyX', $note->sumMoyX());
			$q->bindValue(':sumCoef', $note->sumCoef());
			$q->bindValue(':moyGenerale', $note->moyGenerale());
			$q->bindValue(':appreciation', $note->appreciation());
			$q->bindValue(':rang', $note->rang());
			$q->bindValue(':eleve', $note->eleve());
			$q->bindValue(':classe', $note->classe());
			$q->bindValue(':idAnneeScolaire', $note->idAnneeScolaire());
			$q->bindValue(':ecole', $note->ecole());
			$q->execute();
		}
		public function appreciation(NoteSemestre $moyenne){
			if ($moyenne->moyGenerale()<5) {
				$appreciation = "Tres Faible";
			}
			elseif ($moyenne->moyGenerale()>=5 AND $moyenne->moyGenerale()<8) {
				$appreciation = "Faible";
			}
			elseif ($moyenne->moyGenerale()>=8 AND $moyenne->moyGenerale()<10) {
				$appreciation = "Insuffisant";
			}
			elseif ($moyenne->moyGenerale()>=10 AND $moyenne->moyGenerale()<12) {
				$appreciation = "Passable";
			}
			elseif ($moyenne->moyGenerale()>=12 AND $moyenne->moyGenerale()<14) {
				$appreciation = "Assez Bien";
			}
			elseif ($moyenne->moyGenerale()>=14 AND $moyenne->moyGenerale()<16) {
				$appreciation = "Bien";
			}
			elseif ($moyenne->moyGenerale()>=16 AND $moyenne->moyGenerale()<18) {
				$appreciation = "Tres Bien";
			}
			elseif ($moyenne->moyGenerale()>=18 AND $moyenne->moyGenerale()<=20) {
				$appreciation = "Excelant";
			}
			else{
				$appreciation = null;
			}

			return $appreciation;
		}

		public function setDb(PDO $db) {
			$this->_db = $db;
		}

		public function rangSemestre(NoteSemestre $moyenne){
				
			$q = $this->_db->prepare(
				"update notesemestre as t1
					inner join  (
			 
			        select  ta.nomSemestre, ta.moyGenerale, ta.eleve, ta.classe, ta.idAnneeScolaire,
		                 count(case when tb.moyGenerale > ta.moyGenerale 
                		 AND ta.nomSemestre = '".$moyenne->nomSemestre()."'
		    		     AND ta.classe = '".$moyenne->classe()."' 				    			 	             
		    			 AND ta.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."' 				    			 	             

	     				
                		 AND tb.nomSemestre = '".$moyenne->nomSemestre()."'
		    		     AND tb.classe = '".$moyenne->classe()."' 				    			 	             
		    			 AND tb.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."'

		    			 then 1 else null end) + 1 as rang
       					from  notesemestre as ta

					left outer join  notesemestre as tb
             			on  tb.moyGenerale >= ta.moyGenerale
	             			AND tb.nomSemestre = '".$moyenne->nomSemestre()."'
			    		    AND tb.classe = '".$moyenne->classe()."'  					    			 	             
			    			AND tb.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."' 

			    			AND ta.nomSemestre = '".$moyenne->nomSemestre()."'
		    		     	AND ta.classe = '".$moyenne->classe()."' 				    			 	             
		    			 	AND ta.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."' 

       				group by  ta.eleve, ta.moyGenerale
       				order by  ta.eleve, ta.moyGenerale desc
 
				) as t2 

        		on  t2.moyGenerale = t1.moyGenerale
	        		AND t2.nomSemestre = '".$moyenne->nomSemestre()."' 
	    		    AND t2.classe = '".$moyenne->classe()."'  					    			 	             
	    			AND t2.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."' 

	    			AND t1.nomSemestre = '".$moyenne->nomSemestre()."' 
	    		    AND t1.classe = '".$moyenne->classe()."'  					    			 	             
	    			AND t1.idAnneeScolaire = '".$moyenne->idAnneeScolaire()."' 

       			set  t1.rang = t2.rang "
			);

	        $q->execute();
	        // AND ta.nomSemestre='".$moyenne->nomSemestre()."' AND ta.matiere='".$moyenne->matiere()."'
		}
	} 

?>