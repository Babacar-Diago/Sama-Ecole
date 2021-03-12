<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Affectation de classes à un Personnel
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">
      	<?php  
      	
      	$pseudo = $_GET['perso'];

      	$req = $pdo->prepare("SELECT * FROM personnel WHERE (pseudo=:pseudo OR email=:pseudo) ");
        $req->execute(['pseudo'=>$pseudo]);
        $personnel = $req->fetch();

        if ($personnel) {
            echo "<h4> <b>Prénom</b> : ".$personnel['prenom']." </h4>
            	  <h4> <b>Nom</b> : ".$personnel['nom']." </h4>
            	  <h4> <b>Statut</b> : ".$personnel['statut']." </h4>
            	  <h4> <b>Pseudo</b> : ".$personnel['pseudo']." </h4>
            	  <h4> <b>E-Mail</b> : ".$personnel['email']." </h4>";
        }
      		 
      	?>
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

				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Annee Scolaire : </label>    
					<select id="anneeScolaire" name='anneeScolaire' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>   
		            <?php 
			            $req = $pdo->prepare("SELECT DISTINCT anneeScolaire FROM anneescolaire WHERE anneescolaire.ecole='".$_SESSION['auth']['idEcole']."' order by anneeScolaire asc");
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
			  <?php if ($personnel['statut']=='Professeur') : ?>

				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Matière à enseigner : </label> 
					<select id="matiere" name='matiere' class="form-control select2" style="width: 100%;">                  
	                  <option selected="selectionner">-----selectionner-----</option>   
	                  <?php 
	                    $req = $pdo->prepare("SELECT DISTINCT nom FROM matiere WHERE matiere.ecole='".$_SESSION['auth']['idEcole']."' order by nom asc");
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
			  <?php endif; ?> 

				<?php for ($i=1; $i <= 10 ; $i++) { 

					if ($fonction->classeVide($personnel['prof']? $personnel['matiere']? $ecole? $personnel['prenom'])) {
						
					}
				?>
									
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Classe N°<?php echo $i; ?>: </label>   
					<select id="ecole" name="classe<?php echo $i; ?>" class="form-control select2" style="width: 100%;">                  
	                  <option selected="selectionner">-----selectionner-----</option>   
	                  <?php 
	                    $req = $pdo->prepare("SELECT DISTINCT nom FROM classe WHERE classe.ecole='".$_SESSION['auth']['idEcole']."' order by nom asc");
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

				<?php } ?>
				
				
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
				<br><br>
					<label>  </label>   
					<input type="submit" class="btn btn-primary" name="ajout" value="AJOUTER" />
				</div>
							
			</p>
		</form>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->