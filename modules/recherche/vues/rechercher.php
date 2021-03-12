<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        BIENVENU DANS LA PAGE DE RECHERCHE
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="glyphicon glyphicon-home"></i>Accueil </a></li>
        <li><a href="index.php?module=profil/&action=profil"><i class="glyphicon glyphicon-user"></i>profil </a></li>
        <li class="active"><i class="fa fa-search"></i> Recherche</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
		<p>
				
		<!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#Ecole" data-toggle="tab">Ecole</a></li>
              <li><a href="#Classe" data-toggle="tab">Classe</a></li>
              <li><a href="#Eleve" data-toggle="tab">Eleve</a></li>
              <li><a href="#Bulletin" data-toggle="tab">Bulletin</a></li>
            </ul>
            
            <form action="" method="post" role="form" class="box-body">
            <div class="tab-content">

              <div class="active tab-pane" id="Ecole">
                	
                <br><br><br><br><br><br><br><br><br><br><br><br><br>    
                <br><br><br><br><br><br><br><br><br><br><br><br><br>    

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="Classe">

              	<br>
            	<div style="margin-left:5px; color:blue;">
            		<h3> VEUILLEZ CHOISIR UN TYPE DE RECHERCHE </h3>
            	</div>
            	<br>

                    <label>
                      <input class="minimal" type="radio" name='choix[]' id="minimal-radio-1" value='listeClasse' /> 
                      Rechercher une classe 
                    </label>
                    <br><br><br>
                    <label>
                      <input type="radio" name='choix[]' id="minimal-radio-1" value='classe' />
              		    Rechercher la liste des classes 
                    </label>
                    <br><br><br>
                    <label>
                      <input type="radio" name='choix[]' id="minimal-radio-1" value='listeNiveau' />
              		    Rechercher la liste des classes selon le niveau 
                    </label>
                    <br><br><br>
                    <label>
                      <input type="radio" name='choix[]' id="minimal-radio-1" value='liseNiveauSerie' />
              		    Rechercher la liste des classes selon le niveau et la série 
                    </label>
                    <br><br><br>
                    <input type='submit' id='valider' name='valider' value='Valider' class='btn btn-primary'/>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="Eleve">

              	<br>
            	<div style="margin-left:5px; color:blue;">
            		<h3> VEUILLEZ CHOISIR UN TYPE DE RECHERCHE </h3>
            	</div>
            	<br>
                	<label>
                    <input class="flat-red" type="radio" name='choix[]' value='eleve' />
              		 Rechercher un élève 
                  </label>
                  <br><br><br>
                  <label>
                    <input class="flat-red" type="radio" name='choix[]' value='liseClasse' />
              		  Rechercher la liste des élèves d'une classe 
                  </label>
                  <br><br><br>
                  <label>
                    <input class="flat-red" type="radio" name='choix[]' value='listeNiveau' />
              		  Rechercher la liste des élèves selon le niveau 
                  </label>
                  <br><br><br>
                  <label> 
                    <input class="flat-red" type="radio" name='choix[]' value='listeNiveauSerie' />
              		  Rechercher la liste des élèves selon le niveau et la série 
                  </label>
                    
                  <br><br><br>
                  <input type='submit' id='valider' name='valider' value='Valider' class='btn btn-primary'/>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="Bulletin">

              	<br>
            	<div style="margin-left:5px; color:blue;">
            		<h3> VEUILLEZ CHOISIR UN TYPE DE RECHERCHE </h3>
            	</div>
            	<br>
                
                  <label>
              		  <input class="flat-red" type="radio" name='choix[]' value='B_eleve' />
              		  Rechercher le bulletin d'un élève 
                  </label>
                  <br><br><br>
                  <label>  
                    <input class="flat-red" type="radio" name='choix[]' value='B_classe' />
              		  Rechercher la liste de bulletin d'une classe 
                  </label>
                    <br><br><br>
                  <label> 
                    <input class="flat-red" type="radio" name='choix[]' value='ListMoyClasse' />
              		  Rechercher la liste des moyennes d'une classe 
                  </label>
                    
                    <br><br><br>
                    <input type='submit' id='valider' name='valider' value='Valider' class='btn btn-primary'/>

              </div>
              <!-- /.tab-pane -->


            </div>
            <!-- /.tab-content -->
            </form>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

		</p>					
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->