<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Affectation de classes à un Personnel
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Affectation de classes</li>
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
            	  <h4> <b>Nom</b> : ".$personnel['nom']." </h4>";
            	  
            	  	if ($personnel['statut']=='Professeur') {
            	  	 echo "<h4> <b>Statut</b> : ".$personnel['statut']." ".$_GET['matiere']." </h4> ";
            	  	}elseif ($personnel['statut']=='Surveillant') {
            	  	 echo "<h4> <b>Statut</b> : ".$personnel['statut']." </h4>";
            	  	}
            	  
            echo "<h4> <b>Pseudo</b> : ".$personnel['pseudo']." </h4>
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

			<?php 
			// Sélection des classe vide à renseigner
			if ($personnel['statut']=='Professeur') {
	            $enseignant = new Enseignant(array(
	            'prof' => $_GET['prof'], 
	            'matiere' => $_GET['matiere'], 
	            'ecole' => $_SESSION['auth']['ecole'], 
	            'idAnneeScolaire' => $_GET['anSco'])); // On attribut une nouvelle classe.
	        } 
	        // Sélection des classe vide à surveiller
			elseif ($personnel['statut']=='Surveillant') {
	            $surveillant = new Enseignant(array(
	            'prof' => $_GET['surv'], 
	            'ecole' => $_SESSION['auth']['ecole'], 
	            'idAnneeScolaire' => $_GET['anSco'])); // On attribut une nouvelle classe.
	        }
				echo "<h4><b> Classe déjà affectée pour <a href='#'> l'année scolaire ".$anneeScolaire." </a> </b></h4>";

				for ($i=1; $i <= 10 ; $i++) { 
					
					if ($personnel['statut']=='Professeur') {

			        	$classeNonVide = $fonction->selectClasseProf($i, $enseignant);

		            }elseif ($personnel['statut']=='Surveillant') {

		            	$classeNonVide = $fonction->selectClasseSurveillant($i, $surveillant);
		            }

		        if ($classeNonVide!=NULL) {
		        	echo '<b>Classe N°'.$i.' :</b> '.$classeNonVide;
		        	echo '<br>';
		        } 

				if ($classeNonVide==NULL) {
				$classe = 'classe'.$i;
			?>

				<br><br><br>					
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Classe N°<?php echo $i; ?>: </label>   
					<select id="classe" name='<?php echo $classe; ?>' class="form-control select2" style="width: 100%;">                  
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

				<?php } } ?>
				
				
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
				<br><br>
					<label>  </label>   
					<input type="submit" class="btn btn-primary" name="ajout" value="TERMINER" />
				</div>
							
			</p>
		</form>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->