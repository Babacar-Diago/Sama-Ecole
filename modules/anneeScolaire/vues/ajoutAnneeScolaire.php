<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Année scolaire
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Année scolaire</li>
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
					<label> Année scolaire : </label>     
					<input type="text" class="form-control" name="anneeScolaire" maxlength="11" data-inputmask='"mask": "9999 - 9999"' data-mask /> 
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