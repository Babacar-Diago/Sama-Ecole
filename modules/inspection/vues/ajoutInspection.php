<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'une inspection dans la base de donnée
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Nouvelle inspection</li>
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
					<label> Nom de l'inspection : </label>      
					<input type="text" class="form-control" name="nomInspection" maxlength="100" /> 
				</div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Region : </label>      
          <input type="text" class="form-control" name="region" maxlength="25" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Departement : </label>      
          <input type="text" class="form-control" name="departement" maxlength="25" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Email : </label> 
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>     
            <input type="text" class="form-control" name="email" maxlength="100" /> 
          </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Telefax : </label>  
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-fax"></i></span>   
            <input type="text" class="form-control" name="telefax" maxlength="25" /> 
          </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> N°-Telephone mobile : </label> 
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control" name="telephone1" maxlength="19" data-inputmask='"mask": "(+221) 99-999-99-99"' data-mask />
          </div>   
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> N°-Telephone fixe : </label> 
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span> 
              <input type="text" class="form-control" name="telephone2" maxlength="19" data-inputmask='"mask": "(+221) 99-999-99-99"' data-mask />
          </div> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> BP : </label>      
          <input type="text" class="form-control" name="BP" maxlength="25" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label>Mot de passe : </label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> 
            <input type="password" class="form-control" name="mdp" maxlength="50" />
          </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
            <label>Confirmer mot de passe : </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="mdp_confirm" maxlength="50" />
          </div>
        </div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
        <br>       
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