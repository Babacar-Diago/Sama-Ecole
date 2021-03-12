<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'une nouvelle classe
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Nouveau classe</li>
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label>Nom de la classe :</label>      
					<input type="text" class="form-control" name="nom" maxlength="10" placeholder="TS2 / 2ndS ..." />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label>Niveau :</label>      
					<select id="niveau" name='niveau' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>
		            <?php 
			            $req = $pdo->prepare("SELECT DISTINCT niveau FROM niveau WHERE niveau.ecole='".$_SESSION['auth']['idEcole']."' order by niveau asc");
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
					<label>Serie :</label>      
					<select id="serie" name='serie' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>
		            <?php 
			            $req = $pdo->prepare("SELECT DISTINCT serie FROM serie WHERE serie.ecole='".$_SESSION['auth']['idEcole']."' order by serie asc");
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label>Nombre eleves :</label>      
					<input type="number" name="nombreEleves" class="form-control" maxlength="11" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<input type="submit" class="btn btn-primary" value="AJOUTER" name="ajouter" />
				</div>
			</p>					

		</form> 
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->