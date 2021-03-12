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
              <h3 class="box-title" style="color: blue;"> Les classes qui vous ont été affecté pour l'année scolaire :
                <?php echo  $fonction->getAnneeScolaire($idAnneeScolaire); ?>
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
                    <th>CLASSE</th>
                    <th>MATIERE A ENSEIGNE</th>
                    <th>NIVEAU</th>
                    <th>SERIE</th>
                    <th>NOMBRE ELEVES</th>
                  </tr>
                  </thead>
                  <tbody> 

                  <?php 
                    
                    for ($i=1; $i <= 10 ; $i++) { 
                      
                        $classeNonVide = $fonction1->selectClasseProf($i, $enseignant);

                        $req = $pdo->prepare("SELECT * FROM classe WHERE nom=:nom AND idAnneeScolaire=:idAnneeScolaire AND ecole=:ecole ");
                        $req->execute(array('nom'=>$classeNonVide, 'idAnneeScolaire'=>$idAnneeScolaire, 'ecole'=>$ecole));
                        $personnel = $req->fetch();
                        
                        if ($classeNonVide!=NULL) {
                          echo "<tr>";
                            echo "<td align='center'><a href='#'>".$classeNonVide."</a></td>";
                            echo "<td align='center'>".$nomMatiere."</td>";

                            echo "<td>".$personnel['niveau']."</td>";
                            echo "<td align='center'>".$personnel['serie']."</td>";
                            echo "<td align='center'>".$personnel['nombreEleves']."</td>";
                          echo "</tr>";
                          
                        }
                    } 
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
              <h3 class="box-title" style="color: blue;">EMPLOI DU TEMPS</h3>
              <h3 class="box-title" style="color: red;"> => NON DISPONIBLE</h3>
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
                  <tr>
                    <th>Heures</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">8H-9H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">9H-10H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">10H-11H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">11H-12H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">12H-13H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">13H-14H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">14H-15H</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
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