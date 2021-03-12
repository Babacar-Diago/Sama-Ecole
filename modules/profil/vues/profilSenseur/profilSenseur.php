 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votre profil
      </h1>
      <ol class="breadcrumb">
          
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li class="active"><i class="glyphicon glyphicon-user"></i> profil</li>

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


          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="color: blue;"> 
                Fenêtre 1
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin table-bordered table-striped">
                  <thead>
                  <tr style="background-color: grey;">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                  </thead>
                  <tbody> 

                  <?php 
                    
                    
                  ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="color: blue;"> 
                Fenêtre 2
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin table-bordered table-striped">
                  <thead>
                  <tr style="background-color: grey;">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                  </thead>
                  <tbody> 

                  <?php 
                    
                    
                  ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="color: blue;"> 
                Fenêtre 3
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin table-bordered table-striped">
                  <thead>
                  <tr style="background-color: grey;">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                  </thead>
                  <tbody> 

                  <?php 
                    
                    
                  ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->