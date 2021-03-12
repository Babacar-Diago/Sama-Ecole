<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'un(e) personnel(le) dans la base de donnée
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Nouveau personnel</li>
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
					<label> Pseudo : </label>   
					<input type="text" class="form-control" name="pseudo" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Nom : </label>   
					<input type="text" class="form-control" name="nom" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Prenom : </label>   
					<input type="text" class="form-control" name="prenom" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Sexe : </label>   
					<select id="sexe" name='sexe' class="form-control" style="width: 100%;">                  
	                  <option selected="selectionner">-----selectionner-----</option>   
	                  <option>Masculin</option>   
	                  <option>Feminin</option>               
	                </select>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Statut : </label>
					<select id="statut" name='statut' class="form-control" style="width: 100%;">                  
	                  <option selected="selectionner">-----selectionner-----</option> 

        			<?php if (isset($_SESSION['auth']) && $_SESSION['auth']['statut'] =='Ecole'): ?>

	                  <option>Senseur</option>

	                <?php else: ?>*

	                  <option>Professeur</option>   
	                  <option>Surveillant</option>

	                <?php endif; ?> 

	                </select>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Ecole : </label>   
					<select id="ecole" name='ecole' class="form-control select2" style="width: 100%;">                  
	                  <option selected="selectionner">-----selectionner-----</option>   
	                  <?php 
	                    $req = $pdo->prepare('SELECT DISTINCT nomEcole FROM ecole order by nomEcole asc');
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
					<label> N° Telephone : </label>  
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-phone"></i></span>  
						<input type="text" class="form-control" name="telephone" maxlength="19" data-inputmask='"mask": "(+221) 99 999 99 99"' data-mask />
					</div>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Email : </label>   
					<input type="mail" class="form-control" name="email" maxlength="100" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					 <label>Mot de passe : </label>
					 <input type="password" class="form-control" name="mdp" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					 <label>Confirmer mot de passe : </label>
					 <input type="password" class="form-control" name="mdp_confirm" maxlength="50" />
				</div>
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