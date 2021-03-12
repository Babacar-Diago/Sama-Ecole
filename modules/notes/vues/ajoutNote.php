<?php 
	$idAnneeScolaire = $fonction1->getActuelIdAnSco($ecole);
    $anneeScolaire = $fonction1->getAnneeScolaire($idAnneeScolaire); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Saisie de la note de chaque élève selon le niveau
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Ajout notes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">

      	<!-- Message flash -->
		<?php if(isset($_SESSION['flash'])): ?>
		    
		    <?php foreach($_SESSION['flash'] as $type => $message ): ?>
		        <div class="alert alert-<?= $type; ?>">
		            <?= $message; ?>
		        </div>
		    <?php endforeach; ?>
		    <?php unset($_SESSION['flash']) ; ?>         
		       
		<?php endif; ?>

      	<!-- Message d'erreur -->
	    <?php if(!empty($errors)): ?>
	        <div class="alert alert-danger">
	            <p>Vous n'avez pas rempli le formulaire correctement</p>
	            <ul>
	                <?php foreach($errors as $error): ?>
	                    <li><?= $error; ?></li>
	                <?php endforeach; ?>
	            </ul>
	        </div>
	    <?php endif; ?>

		<form action="" method="post" role="form" class="box-body">
			<p>
				<table id="tableau" border="1" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<tr>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label>Niveau :</label>      
								<select id="niveau" name='niveau' class="form-control">
					            <option selected="selectionner"><?php if (isset($_POST['niveau'])){echo $_POST['niveau'];} ?></option>
					            <?php 
						            $req = $pdo->prepare("SELECT DISTINCT niveau FROM niveau WHERE niveau.ecole='".$_SESSION['auth']['ecole']."' order by niveau asc");
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
								<select id="classe" name='classe' class="form-control">
					            <option selected="selectionner"><?php if (isset($_POST['classe'])){echo $_POST['classe'];} ?></option> 

					            <?php 

					            for ($i=1; $i <= 10 ; $i++) {

						            $req = $pdo->prepare("SELECT DISTINCT classe".$i." FROM enseigner WHERE enseigner.ecole='".$_SESSION['auth']['ecole']."' AND enseigner.prof='".$_SESSION['auth']['identifiant']."' AND enseigner.idAnneeScolaire='".$idAnneeScolaire."' AND classe".$i." IS NOT NULL ");
						            $req->execute();
						             
						            if($req){
						              $nbreLigne = $req->fetchAll();
						              //var_dump($nbreLigne);
						              foreach ($nbreLigne as $key => $value) { 
						               //$user = $req->fetch();
						                	echo"<option>".$value[0]."</option>";
						              }
						            }
						        }
						        ?>
					            </select>
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Annee Scolaire : </label>    
								<select id="anneeScolaire" name='anneeScolaire' class="form-control">
					            <option selected="selectionner"><?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?></option>   
					        
					            <option><?= $anneeScolaire; ?></option>
						       
					            </select>
							</div>
						</td>
						<td> <input type='submit' id='liste' name='liste' class="btn btn-primary" value="Afficher la liste" /> 
						</td>
					</tr>
				</table> <br><br><br><br><br><br>
					
					<?php 

						if (!empty($_POST['niveau']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire']) ) {
					?>
				
				<table id="tableau" border="1" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

					<tr>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Semestre : </label>
								<select id="semestre" name='semestre' class="form-control">
						            <option selected="selectionner"><?php if (isset($_POST['semestre'])){echo $_POST['semestre'];} ?></option>
						            <option>Semestre 1</option>
						            <option>Semestre 2</option>
					            </select>    						
							</div>
						</td>
						<td>
							<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
								<label> Matiere : </label> 
								<select id="matiere" name='matiere' class="form-control">
					            <option selected="selectionner"><?php if (isset($_POST['matiere'])){echo $_POST['matiere'];} ?></option>   
					            <?php 

						            $req = $pdo->prepare("SELECT DISTINCT matiere FROM enseigner WHERE enseigner.ecole='".$_SESSION['auth']['ecole']."' AND enseigner.prof='".$_SESSION['auth']['identifiant']."' AND enseigner.idAnneeScolaire='".$idAnneeScolaire."' order by matiere asc");
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
								<label> Serie : </label>    
								<select id="serie" name='serie' class="form-control">
					            <option selected="selectionner"><?php if (isset($_POST['serie'])){echo $_POST['serie'];} ?></option>   
					            <?php 
						            $req = $pdo->prepare("SELECT DISTINCT serie FROM serie WHERE serie.ecole='".$_SESSION['auth']['ecole']."' order by serie asc");
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
						<th colspan="3" style="text-align: center;"> <em><h2>Liste eleves</h2></em> </th>
					</tr>

					<tr>
						<th><center><h4>eleve</center></h4></th>
						<th><h4><center>note devoir</center></h4></th>
						<th><h4><center>note composition</center></h4></th>
					</tr>
					<?php
							

		                  $req = $pdo->prepare("SELECT eleve FROM etreeleve WHERE 
		                  	etreeleve.niveau='".$_POST['niveau']."'
		                    AND etreeleve.classe='".$_POST['classe']."'
		                    AND etreeleve.idAnneeScolaire='".$idAnneeScolaire."' AND etreeleve.ecole='".$ecole."' ");
		                   $req->execute();
		                  
		                  if ($req){
		                      
		                      $nbreLigne = $req->fetchAll();
		                      //var_dump($nbreLigne);
		                      $i = 0;
		                      foreach ($nbreLigne as $key => $value) {
		                      $i = ++$i; 
		                      //$devoir = (isset($_POST['devoir'])) ? $_POST['devoir'] : null; 
		                      //$composition = (isset($_POST['composition'])) ? $_POST['composition'] : null; 
		                      	echo "<tr>";
		                      	echo "<td align='center'>".$value[0]."</td>";

		                        echo "<td align='center'><input style='width:50%;' 
		                         type='number' step='0.01' min='0' max='20' required 
		                         name='devoir".$i."' class='form-control' placeholder='note devoir' 
		                        	 value='";
		                        	 if (isset($_POST['devoir'.$i])){
		                        			echo $_POST['devoir'.$i];
		                        		}
		                        	echo "' /> 
		                        	<span class='validity'></span> </td>";
		                        	

		                        echo "<td align='center'><input style='width:50%;' 
		                         type='number' step='0.01' min='0' max='20' required
		                         name='composition".$i."' class='form-control' placeholder='note composition'
		                        	value='";
		                        	 if (isset($_POST['composition'.$i])){
		                        			echo $_POST['composition'.$i];
		                        		}
		                        	echo "' /> 
		                        	<span class='validity'></span> </td>";             
		                      	echo "</tr>";
		                      }

		                      echo "<tr>";
		                      echo "<th colspan='3'> <br> <input type='submit' id='valider' name='valider' value='VALIDER' class='btn btn-primary'/> </th>";
		                      echo "</tr>";
		                    }
		                  //} 
		            	}

		            ?>
					
				</table>								
			</p>
		</form>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
	input:invalid + span:after {
	    content: '✖';
	    color: #f00;
	    padding-right : 5px;
	}
	input:valid + span:after {
	    content: '✓';
	    color: #26b72b;
	    padding-right : 5px;
	}
</style>