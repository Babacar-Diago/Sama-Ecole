<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calcul de la moyenne d'une classe
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Calcul de moyenne</li>
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
	    

      <?php
		if (isset($message)) // On a un message à afficher ?
		{
		echo "<p style='color:red'>", $message, "</p>"; // Si oui, on l'affiche.
		}
	  ?>

		<form action="" method="post" role="form" class="box-body">
			<p>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Semestre : </label>
					<select id="semestre" name='semestre' class="form-control">
			            <option selected="selectionner">-----selectionner-----</option>
			            <option>Semestre 1</option>
			            <option>Semestre 2</option>
		            </select>    
					
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Classe : </label>    
					<select id="classe" name='classe' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>   
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Annee Scolaire : </label>    
					<select id="anneeScolaire" name='anneeScolaire' class="form-control">
		            <option selected="selectionner"><?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?></option>   
		            <?php 
			            $req = $pdo->prepare('SELECT DISTINCT anneeScolaire FROM anneescolaire order by anneeScolaire asc');
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label>  </label> <br>  
					<input type="submit" value="CALCULE LES MOYENNES " name="Calcul" class="btn btn-primary"/>
				</div>
								
			</p>
		</form>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
