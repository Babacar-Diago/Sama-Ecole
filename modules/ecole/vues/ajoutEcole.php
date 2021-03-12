<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'une école dans la base de donnée
      </h1>
      <ol class="breadcrumb">
          
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">nouvelle école</li>

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
					<label> Nom de l'ecole : </label>      
					<input type="text" class="form-control" name="nomEcole" maxlength="100" /> 
				</div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Email : </label>      
          <input type="text" class="form-control" name="email" maxlength="100" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Telefax : </label>      
          <input type="text" class="form-control" name="telefax" maxlength="25" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> N°-Téléphone mobile : </label> 
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control" name="telephone1" maxlength="19" data-inputmask='"mask": "(+221) 99-999-99-99"' data-mask />
          </div>   
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> N°-Téléphone fixe : </label> 
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span> 
              <input type="text" class="form-control" name="telephone2" maxlength="19" data-inputmask='"mask": "(+221) 99-999-99-99"' data-mask />
          </div> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> BP : </label>      
          <input type="text" class="form-control" name="BP" maxlength="8" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
          <label> Commune : </label>      
          <input type="text" class="form-control" name="commune" maxlength="25" /> 
        </div>
        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8 form-group">
          <label> Inspection : </label>               
                <select id="nomInspection" name='nomInspection' class="form-control select2" style="width: 100%;">                  
                  <option selected="selectionner">-----selectionner-----</option>   
                  <?php 
                    $req = $pdo->prepare('SELECT DISTINCT nomInspection FROM inspection order by nomInspection asc');
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