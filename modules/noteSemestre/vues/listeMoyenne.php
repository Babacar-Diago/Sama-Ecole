

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liste des moyennes de la classe
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
            <div class="box-header">
              <h3 class="box-title">Informations générales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>MATRICULE</th>
                  <th>Prenom</th>
                  <th>NOM</th>
                  <th>MOYENNE SEMESTRIELLE</th>
                  <th>RANG SEMESTRIELLE</th>
                  <th>BULLETIN </th>
                  <th>IMPRESSION BULLETIN</th>
                </tr>
                </thead>
                <tbody>
                <?php

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

                  if ($req){
                            
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
                  <td><a href="#"> Afficher</a></td>
                  <td><a href="#"> Imprimer</a></td>
                </tr> 
                <?php } } } ?>                    
                </tbody>
              </table>             
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