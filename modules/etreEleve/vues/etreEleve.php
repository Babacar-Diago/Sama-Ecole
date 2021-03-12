<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inscription des élèves 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Inscription</li>
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
					<label> Eleve </label>   
					<input type="text" class="form-control" id="eleve" name="eleve" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label> Niveau : </label>    
					<select id="niveau" name='niveau' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label> Serie : </label>    
					<select id="serie" name='serie' class="form-control select2">
		            <option selected="selectionner">-----selectionner-----</option>
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label> Classe : </label>    
					<select id="classe" name='classe' class="form-control select2">
		            <option selected="selectionner">-----selectionner-----</option>   
		            <?php 
			            $req = $pdo->prepare("SELECT DISTINCT nom FROM classe WHERE classe.ecole='".$_SESSION['auth']['ecole']."' order by nom asc");
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label> Annee Scolaire : </label>    
					<select id="anneeScolaire" name='anneeScolaire' class="form-control">
			            <option selected="selectionner">
			            <option><?= $anneeScolaire ?></option>
		            </select>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label> Classe doublee ? : </label>    
					<select id="classeDoublee" name='classeDoublee' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>
		            <option>Oui</option>               
		            <option>Non</option>               
		            </select>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label>  </label>   
					<input type="submit" value="INSCRIR" name="inscrir" class="btn btn-primary" />
				</div>
								
			</p>
		</form>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->