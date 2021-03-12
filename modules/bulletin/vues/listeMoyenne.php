
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liste des moyennes d'une classe
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i> profil </a></li>
        <li class="active">Liste des moyennes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">

        <div class="box">         
            
            <div class="box-body">
      <p>
      <form action="" method="post" role="form" class="box-body">
        <table id="tableau" border="1" class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
          <tr>
            
            <td>
              <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
                <label> Classe : </label>    
                <select id="classe" name='classe' class="form-control select2">
                      <option selected="selectionner"><?php if (isset($_POST['classe'])){echo $_POST['classe'];} ?></option>   
                      <?php 
                        $req = $pdo->prepare('SELECT DISTINCT nom FROM classe order by nom asc');
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
            </td>

            <td>
              <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
                <label> Semestre : </label>
                <select id="semestre" name='semestre' class="form-control select2">
                        <option selected="selectionner"><?php if (isset($_POST['semestre'])){echo $_POST['semestre'];} ?></option>
                        <option>Semestre 1</option>
                        <option>Semestre 2</option>
                      </select>               
              </div>
            </td> 

            <td>
              <div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
                <label> Annee Scolaire : </label>    
                <select id="anneeScolaire" name='anneeScolaire' class="form-control select2">
                      <option selected="selectionner"><?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?></option>   
                      <?php 
                        $req = $pdo->prepare('SELECT DISTINCT anneeScolaire FROM anneescolaire order by anneeScolaire desc');
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
            </td> 

          </tr>
          <tr>
            <td colspan="3"> <br> <input type='submit' id='liste' name='liste' class="btn btn-primary" value="Afficher moyennes"></td>
          </tr>
        </table> 
      </form>              
      


         <?php
         if (!empty($_POST['semestre']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire']) ) {

          $anneeScolaire = new AnneeScolaire(array('anneeScolaire' => $_POST['anneeScolaire'], 'ecole' => $ecole)); 
          $idAnneeScolaire = $fonction->getIdAnneeScolaire($anneeScolaire);
          
            $req = $pdo->prepare("SELECT eleve, prenom, nom, moyGenerale, rang 
              FROM noteSemestre, eleve
              WHERE noteSemestre.nomSemestre='".$_POST['semestre']."'
                AND noteSemestre.classe='".$_POST['classe']."'
                AND noteSemestre.idAnneeScolaire='".$idAnneeScolaire."'
                AND noteSemestre.ecole='".$ecole."'

                AND noteSemestre.eleve=eleve.matricule 
                AND noteSemestre.ecole=eleve.ecole 
                order by noteSemestre.rang asc ");
            $req->execute();

            if ($req){  ?> <br><br>

            <div class="table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: grey;">
                  <th>MATRICULE</th>
                  <th>Prenom</th>
                  <th>NOM</th>
                  <th>MOYENNE SEMESTRIELLE</th>
                  <th>RANG SEMESTRIELLE</th>
                </tr>
                </thead>
                <tbody>                

              <?php        
                $nbreLigne = $req->fetchAll();
                //var_dump($nbreLigne);
                $i = 0;
                foreach ($nbreLigne as $key => $value) {
                  $i = ++$i; 

                  if ($i < $nbreLigne) {                       
                                
                    $eleve = $value['eleve'];
                    $prenom = $value['prenom'];
                    $nom = $value['nom'];
                    $moyGenerale = $value['moyGenerale'];
                    $rang = $value['rang'];
          ?>           
              
                <tr>
                  <td><?php echo $eleve; ?></td>
                  <td><?php echo $prenom; ?></td>
                  <td><?php echo $nom; ?></td>
                  <td><center><?php echo $moyGenerale; ?></center></td>
                  <td><center><?php echo $rang; ?></center></td>
                </tr> 
                <?php } } } } ?>                    
                </tbody>
              </table> 
            </div> 
            </p>           
            </div>
            <!-- /.box-body -->           
          </div>
          <!-- /.box -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>