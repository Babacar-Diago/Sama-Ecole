 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votre profil
      </h1>
      <ol class="breadcrumb">
          
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Paramètre</li>

        <!-- button with a dropdown -->
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-cog"></i></button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="index.php?module=profil/&action=modifieAvatar"><i class="glyphicon glyphicon-camera"></i>
              Changer votre photo de profil</a></li>
              <li class="divider"></li>
              <li><a href="index.php?module=profil/&action=modifieNomPrenom"><i class="glyphicon glyphicon-user"></i>
              Changer votre nom d'utilisateur</a></li>
              <li class="divider"></li>
              <li><a href="index.php?module=profil/&action=modifie_mdp"><i class="glyphicon glyphicon-lock"></i>
              Changer votre mot de passe</a></li>
            </ul>
          </div>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <?php include CHEMIN_VUE.'profil'.$_SESSION['auth']['statut'].'/user'.$_SESSION['auth']['statut'].'.php'; ?>
        <div class="col-md-9 col-sm-9">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title" style="color: blue;">Changer Photo de profil</h3>
            </div> <br><br> 
            <!-- /.box-header -->
            
              <div class="tab-pane" id="settings">
                
                <!-- Message flash -->
                <?php if(isset($_SESSION['flash'])): ?>
                    
                    <?php foreach($_SESSION['flash'] as $type => $message ): ?>
                        <div class="alert alert-<?= $type; ?>">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['flash']) ; ?>         
                       
                <?php endif; ?>
                <!-- FIN Message flash -->
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
                <!-- FIN Message d'erreur -->
                
                
                  <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="avatar" class="col-sm-3 control-label">Votre photo de profil</label>

                      <div class="col-sm-8">
                        <input type="file" name="avatar" class="form-control">
                      </div>

                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Changer</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>

          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->