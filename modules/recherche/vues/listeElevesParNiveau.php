<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LISTES DES ELEVES PAR NIVEAU 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i>Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i>profil </a></li>
        <li><a href="index.php?module=recherche/&amp;action=rechercher"><i class="fa fa-search"></i>Rechercher </a></li>
        <li class="active">Liste des élèves d'une classe par niveau</li>
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
    <!--row-->
    <div class="row">
    <form action="" method="post" role="form" class="box-body">
              <div class="col-md-3 col-lg-8 col-xs-8 col-sm-3">
          <label>Niveau :</label>      
          <select id="niveau" name='niveau' class="form-control">
            <option selected="selectionner"><?php if (isset($_POST['niveau'])){echo $_POST['niveau'];} ?></option>
            <?php 
              $req = $pdo->prepare("SELECT niveau FROM niveau WHERE ecole='".$ecole."' order by niveau asc");
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

        <div class="col-md-3 col-lg-8 col-xs-8 col-sm-3">
          <label> Annee Scolaire : </label>    
          <select id="anneeScolaire" name='anneeScolaire' class="form-control select2">
            <option selected="selectionner"><?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?></option>   
            <?php 

              $req = $pdo->prepare("SELECT DISTINCT anneeScolaire FROM anneeScolaire WHERE ecole='".$ecole."' order by anneeScolaire desc ");
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
      
      <div class="col-md-3 col-lg-8 col-xs-8 col-sm-3"> <br>
        <input type='submit' id='liste' name='liste' class="btn btn-primary" value="Afficher la liste" /> 
      </div>
    </form>
    </div>
    <!-- /row -->
     <br><br>
          
          <?php 

            if (!empty($_POST['niveau']) && !empty($_POST['anneeScolaire']) ) {
          ?>
      <div id='section2Aimprimer' style='page-break-before:always'>
        <div class="row">
          <div class="col-md-12">
            <h2 colspan="9" style="text-align: center;"> <em>Liste des élèves de <b><?= $_POST['niveau'] ?></b> pour l'année scolaire <b><?= $anneeScolaire ?></b></em> </h2>
          </div>
        </div>

        <br>  
        <div class="table-responsive content">
          <table class="table table-bordered table-striped">
            
           <thead>
            <tr>
              <th><center>Matricule</center></th>
              <th><center>Prénom</center></th>
              <th><center>Nom</center></th>
              <th><center>Série</center></th>
              <th><center>Date inscription</center></th>
           </thead>
           <tbody>
            <?php
                

              $req = $pdo->prepare("SELECT * FROM etreeleve, eleve WHERE etreeleve.eleve=eleve.matricule
                AND etreeleve.niveau='".$_POST['niveau']."'
                AND etreeleve.idAnneeScolaire='".$idAnneeScolaire."' AND etreeleve.ecole='".$ecole."' ");
               $req->execute();
              
              if ($req){
                  
                  $nbreLigne = $req->fetchAll();
                  //var_dump($nbreLigne);
                  $i = 0;
                  foreach ($nbreLigne as $key => $value) {
                  $i = ++$i; 
                   
                    echo "<tr>";
                      echo "<td align='center'>".$value['matricule']."</td>";
                      echo "<td align='center'>".$value['prenom']."</td>";
                      echo "<td align='center'>".$value['nom']."</td>";
                      echo "<td align='center'>".$value['serie']."</td>";
                       echo "<td align='center'>".$value['dateInscription']."</td>";
                    echo "</tr>";
                  }
            ?>
           </tbody>
          </table> 
        </div>
      </div> 
            <script>
              function imprimer(divName) {
                var printContents = document.getElementById(divName).innerHTML;    
                var originalContents = document.body.innerHTML;      
                document.body.innerHTML = printContents;     
                window.print();     
                document.body.innerHTML = originalContents;
              }
            </script>

            <button onClick="imprimer('section2Aimprimer')" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer la liste</button> 
        <?php  
            } 
          }
        ?>             
    </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

