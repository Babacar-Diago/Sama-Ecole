<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        BULLETIN DE NOTES 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Bulletin de notes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">

      <form action="" method="post" role="form" class="box-body">
			
				<table id="tableau" border="1" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<tr>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label>Niveau :</label>      
								<select id="niveau" name='niveau' class="form-control select2">
					            <option selected="selectionner"><?php if (isset($_POST['niveau'])){echo $_POST['niveau'];} ?></option>
					            <?php 
						            $req = $pdo->prepare('SELECT DISTINCT niveau FROM niveau order by niveau asc');
						            $req->execute();
						             
						            if($req){
						              $nbreLigne = $req->fetchAll();
						              //var_dump($nbreLigne);
						              foreach ($nbreLigne as $key => $value) { 
						               //$user = $req->fetch();
						                	echo"<option>".$value[0]."</option>";
						              }
						            }
						        ?>
					            </select>
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Classe : </label>    
								<select id="classe" name='classe' class="form-control select2">
					            <option selected="selectionner"><?php if (isset($_POST['classe'])){echo $_POST['classe'];} ?></option>   
					            <?php 
						            $req = $pdo->prepare('SELECT DISTINCT nom FROM classe order by nom asc');
						            $req->execute();
						             
						            if($req){
						              $nbreLigne = $req->fetchAll();
						              //var_dump($nbreLigne);
						              foreach ($nbreLigne as $key => $value) { 
						               //$user = $req->fetch();
						                	echo"<option>".$value[0]."</option>";
						              }
						            }
						        ?>
					            </select>
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Annee Scolaire : </label>    
								<select id="anneeScolaire" name='anneeScolaire' class="form-control select2">
					            <option selected="selectionner"><?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?></option>   
					            <?php 
						            $req = $pdo->prepare('SELECT DISTINCT anneeScolaire FROM anneescolaire order by anneeScolaire desc');
						            $req->execute();
						             
						            if($req){
						              $nbreLigne = $req->fetchAll();
						              //var_dump($nbreLigne);
						              foreach ($nbreLigne as $key => $value) { 
						               //$user = $req->fetch();
						                	echo"<option>".$value[0]."</option>";
						              }
						            }
						        ?>
					            </select>
							</div>
						</td>
					</tr>
					
					<tr>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Semestre : </label>
								<select id="semestre" name='semestre' class="form-control select2">
						            <option selected="selectionner"><?php if (isset($_POST['semestre'])){echo $_POST['semestre'];} ?></option>
						            <option>Semestre 1</option>
						            <option>Semestre 2</option>
					            </select>    						
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
							 	<label> Serie : </label>    
								<select id="serie" name='serie' class="form-control select2">
					            <option selected="selectionner"><?php if (isset($_POST['serie'])){echo $_POST['serie'];} ?></option>   
					            <?php 
						            $req = $pdo->prepare('SELECT DISTINCT serie FROM serie order by serie asc');
						            $req->execute();
						             
						            if($req){
						              $nbreLigne = $req->fetchAll();
						              //var_dump($nbreLigne);
						              foreach ($nbreLigne as $key => $value) { 
						               //$user = $req->fetch();
						                	echo"<option>".$value[0]."</option>";
						              }
						            }
						        ?>
					            </select> 
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<input type='submit' id='liste' name='liste' class="btn btn-primary" value="Afficher bulletins" />
							</div>
						</td>
					</tr>
					<tr>
						<th colspan="3">  </th>
					</tr>
					
				</table>								
		</form>
     	<br><br><br><br><br>

     	<?php /* BULLETIN PREMIER SEMESTRE */   ?>

		<?php 
			
  		if (!empty($_POST['semestre']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire'])
  		 && !empty($_POST['niveau']) && !empty($_POST['serie']) ) { 

      	?>

      	<div id='section2Aimprimer' style="padding-top: 72px;
			            padding-bottom: 72px ;">

      		<style>
				table {
				border-collapse: collapse;
				width: 100%;	
				margin: auto;
				}

				th, tr {
					height: 35px;
				}
				h4 { 
					font-size: 15px; 
				}
				div.tour{
					border: 1px solid #000;
					width: 92%;
					margin: auto;
					height: justify;
				}

				@media print {
					table {page: paysage;}
					@page {size: portrait;} 
				}



			</style>

      	<?php 

			$semestre=$_POST['semestre'];
		    if ($semestre=='Semestre 1'){

		    	$req = $pdo->prepare("SELECT DISTINCT eleve.matricule, eleve.prenom, eleve.nom, eleve.dateNaissance, eleve.lieuNaissance, eleve.ecole,
				classe.niveau, classe.serie, classe.nombreEleves,
				note.classe, note.nomSemestre, note.eleve, note.anneeScolaire, note.niveau, note.serie
				 FROM eleve, note, classe
				WHERE eleve.matricule=note.eleve 
				AND eleve.ecole='".$ecole."' 

				AND classe.nom='".$_POST['classe']."'
				AND classe.niveau='".$_POST['niveau']."'
				AND classe.serie='".$_POST['serie']."'
				AND classe.idAnneeScolaire='".$idAnneeScolaire."'

				AND note.classe=classe.nom 
				AND note.nomSemestre='".$_POST['semestre']."'
                AND note.idAnneeScolaire=classe.idAnneeScolaire
                AND note.niveau=classe.niveau
                AND note.serie=classe.serie ");
		  		$req->execute();

		  		if ($req){

		  			$nbreLigne = $req->fetchAll();
	        
	        		foreach ($nbreLigne as $key => $value) {
	        	?>
				      <br><br><br><br>
				      	<div class='row content tour'>
					        <div class='col-xs-12 page-header'>
					        
					            <h4 style="float: left;">
					             	<br> KAOLACK
									<br> KAOLACK
									<br> LYCEE NDOFFANE
								</h4>
					            <h4 style="float: right;"> <br><br>
					            	Année Scolaire : <?= $value['anneeScolaire'];?><br>
					            	<?= $value['nomSemestre'];?>
					            </h4>
					        
					        </div>
					        
					        <div style="text-align: center;">
					        	<h4>BULLETIN DE NOTES</h4><hr/>
					        </div>
					     
							<div class='row' style="margin-left: 0px;"> 
								<div class='col-sm-5 invoice-col'>
								  <h4>
									Pénom : <?= $value['prenom']; ?>
									<br> Nom : <?= $value['nom']; ?> 
									<br> Matricule : <?= $value['matricule']; ?>
									<br> Né(e) le : <?= $value['dateNaissance']; ?> à <?= $value['lieuNaissance']; ?>
								   </h4>
								</div>
								<div class='col-sm-3 invoice-col'>
								  <h4>
									Classe : <?= $value['classe']; ?> 
									<br> Serie : <?= $value['serie']; ?>
									<br> Nombre d'élèves : <?= $value['nombreEleves']; ?>
								  </h4>
								</div>
								<div class='col-sm-4 invoice-col'>
								  <h4 style="float: right;margin-right: 12px;">
									Classe doublée : Néant
									<br> Année doublée : Néant
								  </h4>
								</div>
							</div> 

					    </div>

	     				<div class="row content">
					      <div class="col-xs-12 table-responsive">
					        <table border="1">
					  	
							  <tr>
							    <th><center> DISCIPLINES </center></th>
							    <th><center> DEVOIRS </center></th>
							    <th class='compo'><center> COMPOSITION </center></th>
							    <th class='moy'><center> MOYENNE </center></th>
							    <th class='coef'><center> COEF </center></th>
							    <th class='moyX'><center> MOYENNE X </center></th>
							    <th class='th'><center> TH </center></th>
							    <th class='rang'><center> RANG </center></th>
							    <th class='app'><center> APPRECIATIONS </center></th>
						      </tr>
				<?php
					  $req1 = $pdo->prepare("SELECT * FROM note
			            WHERE note.eleve='".$value['matricule']."'
			              AND note.nomSemestre='".$_POST['semestre']."'
			              AND note.classe='".$_POST['classe']."'
			              AND note.niveau='".$_POST['niveau']."'
			              AND note.serie='".$_POST['serie']."'
			              AND note.idAnneeScolaire='".$idAnneeScolaire."'
			              AND note.ecole='".$ecole."' ");
					  $req1->execute();

					  if ($req1){

				        $nbreLigne1 = $req1->fetchAll();
				        
				        foreach ($nbreLigne1 as $key => $value1) {
				?>
<?php for ($i=0; $i <7 ; $i++) { ?>
				        	  <tr>
				        		<td><center><?= $value1['matiere'];?></center></td>
				        		<td><center><?= $value1['noteDevoir'];?></center></td>
				        		<td><center><?= $value1['noteComposition'];?></center></td>
				        		<td><center><?= $value1['moyenne'];?></center></td>
				        		<td><center><?= $value1['coef'];?></center></td>
				        		<td><center><?= $value1['moyenneX'];?></center></td>
				        		<td><center>TH</center></td>
				        		<td><center><?= $value1['rang'];?></center></td>
				        		<td><center><?= $value1['appreciation'];?></center></td>
			        		  </tr>	
			    <?php
				        }
				      }
			
				      $req2 = $pdo->prepare("SELECT sumMoyX, sumCoef FROM noteSemestre
				       WHERE noteSemestre.nomSemestre='".$_POST['semestre']."'
				       AND noteSemestre.classe='".$_POST['classe']."'
				       AND noteSemestre.eleve='".$value['eleve']."' 
				       AND noteSemestre.idAnneeScolaire='".$idAnneeScolaire."'
				       AND noteSemestre.ecole='".$ecole."' ");
					  $req2->execute();

					  if ($req2){

				        $nbreLigne2 = $req2->fetchAll();

				        foreach ($nbreLigne2 as $key => $value2) {

				        	$sumMoyX = $value2['sumMoyX'];
					        $sumCoef = $value2['sumCoef'];
		    ?>
							  <tr>
								<th><center>TOTAL</center></th>
								<td colspan='3'></td>
								<td><center><?= $value2['sumCoef']; ?></center></td>
								<td><center><?= $value2['sumMoyX']; ?></center></td>
								<td colspan='3'></td>
							  </tr>		
<?php } ?>
							</table>
						  </div>
						</div>
			<?php
				    	}
				      }
				      //echo "<br>";

				      $req3 = $pdo->prepare("SELECT moyGenerale, rang, appreciation FROM noteSemestre
					   WHERE noteSemestre.nomSemestre='".$_POST['semestre']."'
					    AND noteSemestre.classe='".$_POST['classe']."'
					    AND noteSemestre.eleve='".$value['eleve']."' 
					   AND noteSemestre.idAnneeScolaire='".$idAnneeScolaire."'
					    AND noteSemestre.ecole='".$ecole."' ");
					  $req3->execute();

					  if ($req3){
			          
				        $nbreLigne3 = $req3->fetchAll();
				        $i3 = 0;

				        foreach ($nbreLigne3 as $key => $value3) {
				        	
				        	$i3 = ++$i3;
				        	$moyGenerale = $value3['moyGenerale'];
					        $rang = $value3['rang'];
					        $appreciation = $value3['appreciation'];
			?>

						<div class="row content">
					      <div class="col-xs-12 table-responsive">
					        <table border="1">

							  <tr>
								<th><center>MOYENNE <br> SEMESTRIELLE</center></th>
								<th><center>RANG</center></th>
								<th><center>APPRECIATIONS</center></th>
								<th colspan='2'><center>ABSENCES</center></th>
								<th rowspan='7' class='large'><center>Pour le conseil des Professeurs <br> <br> <br> Le chef d'Etablissement</center></th>
							  </tr>

							  <tr>
								<td rowspan='2'><center><?= $moyGenerale;?></center></td>
								<td rowspan='2'><center><?= $rang;?> / <?= $value['nombreEleves'];?></center></td>
								<td rowspan='2'><center><?= $appreciation;?></center></td>
								<td><center>Justifier</center></td>
								<td><center>Non Justifier</center></td>
							  </tr>
							  
							  <tr>
								<td></td>
								<td></td>
								</tr>
								<tr>
								<th colspan='5'><center>REMARQUE DU CONSEIL</center></th>
							  </tr>

							  <tr>
								<th colspan='5'></th>
							  </tr>
							  
							  <tr>
								<th><center>FELICITATION</center></th>
								<th><center>ENCOURAGEMENT</center></th>
								<th><center>TABLEAU D'HONEUR</center></th>
								<th><center>AVERTISSEMENT</center></th>
								<th><center>BLAME</center></th>
							  </tr>
							  
							  <tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							
							</table> <br><br><br><br><br>
						  </div>
						</div>
					
	<?php
				        }
				      }

	        		}
		  		}
		    }
		

	?>  
		</div>

		<script>
		function imprimer(divName) {
		    var printContents = document.getElementById(divName).innerHTML;    
			var originalContents = document.body.innerHTML;      
			document.body.innerHTML = printContents;     
			window.print();     
			document.body.innerHTML = originalContents;
		}
		</script>

		<button onClick="imprimer('section2Aimprimer')" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer</button>

<?php } ?>
      	
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
