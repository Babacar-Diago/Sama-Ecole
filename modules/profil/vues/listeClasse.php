             
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votre profil
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li class="active">profil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="color: blue;">  
                Liste de la classe
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
                <table class="table no-margin">
                  <thead>
                  <tr>
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
                      
                        $classeNonVide = $fonction1->selectClasse($i, $enseignant);

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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->