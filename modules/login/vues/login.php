<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li class="tab-pane"><a href="index.php"> <h4><i class="fa fa-dashboard"></i> Accueil </h4> </a></li>
      </ol>
    </section>

  <!-- Home -->
  <section class="sections home text-center">
    <div class="overlay">
      <div class="container">
        <div class="home-content">
          <p class="lead home-description">
            <div class="login-box">
              

                <!-- Message flash -->
                <?php if(isset($_SESSION['flash'])): ?>
                  
                    <?php foreach($_SESSION['flash'] as $type => $message ): ?>
                        <div class="alert alert-<?= $type; ?>">
                            <?= $message; ?>
                        </div>
                     <?php endforeach; ?>
                     <?php unset($_SESSION['flash']) ; ?>         
                     
                <?php endif; ?>

              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Ouvrir une session</p>

                <form action="" method="post">
                  <div class="form-group has-feedback">
                    <input name="login" type="text" class="form-control" placeholder="Email ou Pseudo">
                    <span class=" fa fa-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input name="mdp" type="password" class="form-control" placeholder="Mot de passe">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <div class="col-xs-7">
                      <div class="checkbox icheck">
                        <label>
                          <input type="checkbox"> Remember Me
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-5">
                      <input type="submit" class="btn btn-primary" value="Connexion" name="Connexion" />
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                   <a href="#">Mot de passe oublier?</a><br>
                </div>
                 
              </div>
              <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- END Home -->