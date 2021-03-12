<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Coef de la matière choisie 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Nouveau coef</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">

      	<?php 
      	/*
      	if (isset($_POST['ajouter'])) {
      	
      		$q = $pdo->prepare("SELECT matiere FROM avoirmatiere WHERE
				niveau='".$_POST['niveau']."' AND
				serie='".$_POST['serie']."' AND
				ecole='".$ecole."' ");
			$q->execute();
			$nbreLigne = $q->fetchAll();

			foreach ($nbreLigne as $key => $value) { 
				echo $value['matiere']." - ";
			}
		} */
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
					<label> Matiere : </label> 
					<select id="matiere" name='matiere' class="form-control">
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
				</div> </br>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Niveau : </label>    
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
				</div> </br>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Serie : </label>    
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
				</div> </br>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Coef : </label>    
					<input type="text" name="coef" class="form-control" maxlength="1" /> 
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8"> <br>
					<label>  </label>   
					<input type="submit" value="AJOUTER" class="btn btn-primary"  name="ajouter" class="form-control"/>
				</div>
								
			</p>
		</form>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->