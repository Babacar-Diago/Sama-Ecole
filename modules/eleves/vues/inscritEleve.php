<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'un(e) élève dans la base de donnée
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Nouveau élève</li>
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
					<label> Matricule : </label>   
					<input type="text" class="form-control" name="matricule" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Nom : </label>   
					<input type="text" class="form-control" name="nom" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Prenom : </label>   
					<input type="text" class="form-control" id="eleve" name="prenom" />
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
					<label> Date Naissance : </label>
					<div class="input-group"> 
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>  
					<input type="text" class="form-control" name="dateNaissance" maxlength="10" data-inputmask='"mask": "9999-99-99"' data-mask placeholder="aaaa-mm-jj" />
					</div>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Lieu Naissance : </label>   
					<input type="text" class="form-control" name="lieuNaissance" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Origine : </label>   
					<input type="text" class="form-control" name="origine" maxlength="50" placeholder="établissement fréquenté avant" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Motif Entre : </label>   
					<input type="text" class="form-control" name="motifEntre" maxlength="50" />
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> N° Téléphone : </label>
					<div class="input-group">
            			<span class="input-group-addon"><i class="fa fa-phone"></i></span>
            			<input type="text" class="form-control" name="numeroTel" maxlength="19" data-inputmask='"mask": "(+221) 99-999-99-99"' data-mask />
          			</div>
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Mail : </label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>   
						<input type="mail" class="form-control" name="email" maxlength="50" />
					</div>
				</div>
				<br>
				
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label>  </label> <br>  
					<input type="submit" class="btn btn-primary" value="AJOUTER" name="inscrir" />
				</div>
							
			</p>
		</form>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->