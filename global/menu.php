<?php $pdo = PDO2::getInstance(); ?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">

        <?php if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ): ?>

          <?php 
// PHOTO DE PROFIL
            $a = "SELECT avatar FROM personnel WHERE identifiant = '{$_SESSION['auth']['identifiant']}'";
            $b = $pdo->prepare($a);
            $b->execute();
            $photo = $b->fetch();
              if ($photo['avatar']=='') { 
          ?>
                <div class="pull-left image">
                  <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                </div>
          <?php
              } else { 
          ?>
                <div class="pull-left image">
                  <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                </div> 
          <?php  } 
// FIN PHOTO DE PROFIL
          ?>
        <?php endif; ?>

          <?php if( $_SESSION['auth']['statut'] =='Ecole' ): ?>

          <?php 
// PHOTO DE PROFIL
            $a = "SELECT avatar FROM ecole WHERE idEcole = '{$_SESSION['auth']['idEcole']}'";
            $b = $pdo->prepare($a);
            $b->execute();
            $photo = $b->fetch();
              if ($photo['avatar']=='') { 
          ?>
                <div class="pull-left image">
                  <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                </div>
          <?php
              } else { 
          ?>
                <div class="pull-left image">
                  <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                </div> 
          <?php  } 
// FIN PHOTO DE PROFIL
          ?>
        <?php endif; ?>

          <?php if( $_SESSION['auth']['statut'] =='Inspection' ): ?>

          <?php 
// PHOTO DE PROFIL
            $a = "SELECT avatar FROM inspection WHERE idInspection = '{$_SESSION['auth']['idInspection']}'";
            $b = $pdo->prepare($a);
            $b->execute();
            $photo = $b->fetch();
              if ($photo['avatar']=='') { 
          ?>
                <div class="pull-left image">
                  <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                </div>
          <?php
              } else { 
          ?>
                <div class="pull-left image">
                  <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                </div> 
          <?php  } 
// FIN PHOTO DE PROFIL
          ?>
        <?php endif; ?>
<!--NOM DE L'UTILISATEUR-->
      <!--USER PROFESSEUR ET SURVEILLANT-->
        <?php if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] =='Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ): ?>
          <div class="pull-left info">
            <p><?= $_SESSION['auth']['prenom'].' '.$_SESSION['auth']['nom']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        <?php endif; ?>
      <!--USER ECOLE-->
        <?php if( $_SESSION['auth']['statut'] =='Ecole'): ?>
          <div class="pull-left info">
            <p><?= $_SESSION['auth']['nomEcole']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        <?php endif; ?>
      <!--USER INSPECTION-->
        <?php if( $_SESSION['auth']['statut'] =='Inspection'): ?>
          <div class="pull-left info">
            <p><?= $_SESSION['auth']['nomInspection']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        <?php endif; ?>
<!--FIN NOM DE L'UTILISATEUR-->
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <?php if (isset($_SESSION['auth'])): ?>

          <li class="header">MAIN NAVIGATION</li>

          <li  class="active">
            <a href="index.php">
              <i class="glyphicon glyphicon-home"></i> <span>Accueil</span>
            </a>          
          </li>

        <?php endif; ?>

        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['statut'] =='Professeur'): ?>

          <li>
            <a href="index.php?module=notes/&amp;action=ajoutNote">
              <i class="fa fa-pencil-square-o"></i> <span>Ajout de notes</span>
            </a>
          </li>
          
        <?php endif; ?>

        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['statut'] =='Ecole'): ?>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Administration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li><a href="index.php?module=inspection/&amp;action=ajoutInspection"><i class="fa fa-circle-o"></i> Nouvelle inspection</a></li>
              <li><a href="index.php?module=ecole/&amp;action=ajoutEcole"><i class="fa fa-circle-o"></i> Nouvelle école</a></li>
            </ul>
        </li>

        <li>
          <a href="index.php?module=personnel/&amp;action=ajoutPersonnel">
            <i class="fa fa-plus-square"></i> <span> Ajouter le senseur </span>
          </a>
        </li>

        <li>
          <a href="index.php?module=bulletin/&amp;action=listeMoyenne">
            <i class="fa fa-share"></i> <span>Lister les moyennes <br>
            (Selon une classe)</span>
          </a>
        </li>

        <li><a href="index.php?module=bulletin/&amp;action=listeBulletin"><i class="fa fa-book"></i> <span>Liste des bulletins <br> (Selon une classe)</span></a></li>

        <li><a href="index.php?module=recherche/&amp;action=rechercher"><i class="fa fa-search"></i> <span>Recherche</span></a></li>

        <?php endif; ?>

        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['statut'] =='Senseur'): ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Ajouter</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?module=personnel/&amp;action=ajoutPersonnel"><i class="fa fa-circle-o"></i> Un nouveau personnel</a></li>
            <li><a href="index.php?module=eleves/&amp;action=inscritEleve"><i class="fa fa-circle-o"></i> Un nouveau élève</a></li>
        </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Configuration générale</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?module=niveaus/&amp;action=ajoutNiveau"><i class="fa fa-circle-o"></i> Ajouter un niveau</a></li>
            <li><a href="index.php?module=series/&amp;action=ajoutSerie"><i class="fa fa-circle-o"></i> Ajouter une série</a></li>
            <li><a href="index.php?module=matieres/&amp;action=ajoutMatiere"><i class="fa fa-circle-o"></i> Ajouter une matière</a></li>
            <li><a href="index.php?module=avoirMatiere/&amp;action=ajoutAvMatiere"><i class="fa fa-circle-o"></i> Ajouter un coef d'une <br> matière (Selon le niveau et <br> la série)</a></li>
          </ul>          
        </li>

        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-cog"></i> <span>Configuration annuelle</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?module=anneeScolaire/&amp;action=ajoutAnneeScolaire"><i class="fa fa-circle-o"></i> Nouvelle année scolaire</a></li>
            <li><a href="index.php?module=classes/&amp;action=ajoutClasse"><i class="fa fa-circle-o"></i> Ajouter une classe</a></li>
          </ul>
        </li>

        <li>
          <a href="index.php?module=affecteClasse/&amp;action=identification">
            <i class="fa fa-folder"></i> <span> Affecter une classe </span>
          </a>
        </li>

       <li>
          <a href="index.php?module=noteSemestre/&amp;action=ajoutNoteSemestre">
            <i class="fa fa-calculator"></i> <span>Calcul moyenne semestrielle</span>
          </a>
        </li>

        <li>
          <a href="index.php?module=bulletin/&amp;action=listeMoyenne">
            <i class="fa fa-share"></i> <span>Lister les moyennes <br>
            (Selon une classe)</span>
          </a>
        </li>

        <li><a href="index.php?module=bulletin/&amp;action=listeBulletin"><i class="fa fa-book"></i> <span>Liste des bulletins <br> (Selon une classe)</span></a></li>

        <li><a href="index.php?module=recherche/&amp;action=rechercher"><i class="fa fa-search"></i> <span>Recherche</span></a></li>
        
        <?php endif; ?> 

        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['statut'] =='Surveillant'): ?>

        <li>
          <a href="index.php?module=etreEleve/&amp;action=etreEleve">
            <i class="fa fa-plus-square"></i> <span>Etre eleve</span>
          </a>
        </li>

        <?php endif; ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>