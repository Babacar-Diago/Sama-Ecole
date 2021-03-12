<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INFORMATIONS GENERALES SUR UN ELEVE 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i>Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i>profil </a></li>
        <li><a href="index.php?module=recherche/&amp;action=rechercher"><i class="fa fa-search"></i>Rechercher </a></li>
        <li class="active">Infos d'une élève</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">

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
      		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-3">
	      		<label>Matricule de l'élève : </label>
	      		<input type="text" name="matricule" placeholder="Matricule de l'élève" class="form-control" value=<?php if (isset($_POST['matricule'])){echo $_POST['matricule'];} ?>>
	      	</div>

	      	<div class="col-md-2 col-lg-2 col-xs-12 col-sm-2"> <br>
      			<input type="submit" name="cherche" class="btn btn-primary" value="CHERCHER" >
      		</div>

      	</form> 

      	<br>
    <?php if (isset($_POST['cherche'])) : ?>
      	<!-- Information générales de l'élève -->
      	<div class="row" style="border: 1px solid #000;
								width: 96%;
								margin: auto;
								height: justify;">
      	  <div class="col-sm-6"> 
	      	<?php
	          echo "<h4> <b>Matricule</b> : ".$eleve['matricule']." </h4>";
	          echo "<h4> <b>Prénom et Nom</b> : ".$eleve['prenom']." ".$eleve['nom']." </h4>";
	          echo "<h4> <b>Sexe</b> : ".$eleve['sexe']." </h4>";
	          echo "<h4> <b>Date de naissance</b> : ".$eleve['dateNaissance']." </h4>";
	          echo "<h4> <b>Lieu de naissance</b> : ".$eleve['lieuNaissance']." </h4>";
	      	?>
      	  </div>
      	  <div class="col-sm-6">
	      	<?php
	        echo "<h4> <b>Origine</b> : ".$eleve['origine']." </h4>";
	          echo "<h4> <b>Motif entré</b> : ".$eleve['motifEntre']." </h4>";
	          echo "<h4> <b>N° Téléphone</b> : ".$eleve['numeroTel']." </h4>";
	          echo "<h4> <b>Statut</b> : ".$eleve['statut']." </h4>";
	      	?>
      	  </div>
      	</div>
      	<!-- End Information générales de l'élève -->
      	<br>
      	<!-- Information générales le parcour de l'élève -->
      	<div class="row" style="width: 100%;
								margin: auto;
								height: justify;">
      		<style type="text/css">
      			div.case {
      				border: 1px solid #000;
					height: 50px;
					margin-left: 5%;
					margin-bottom: 10px;
				}
				b.forme{
					color: blue;
					font-size: 20px;
				}
      		</style>

      		<div class="col-sm-5 case">
      			<b class="forme">Année scolaire <?= $anneeScolaire ?> </b>
      		</div>
      		<div class="col-sm-5 case">
      			
      		</div>
      		<div class="col-sm-5 case">
      			
      		</div>
      		<div class="col-sm-5 case">
      			
      		</div>
      	</div>
      	<!-- End Information générales le parcour de l'élève -->

    <?php endif; ?>

    <!--
      	<form action="" method="post" class="sidebar-form">
	        <div class="input-group">
	          <input type="text" name="q" class="form-control" placeholder="Search...">
	              <span class="input-group-btn">
	                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
	                </button>
	              </span>
	        </div>
	    </form>
	-->


	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
