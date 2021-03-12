<?php
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
?>
  
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Diago Projet</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="style/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="style/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="style/bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="style/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="style/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="style/bower_components/select2/dist/css/select2.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="style/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="style/dist/css/AdminLTE.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="style/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="style/Ionicons/css/ionicons.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="style/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="style/plugins/iCheck/square/blue.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="style/plugins/iCheck/all.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Pour le pege de recherche -->
    <link href="style/line/blue.css" rel="stylesheet">
    <!-- Pour le pege de recherche -->  

  
   <!-- <link rel="stylesheet" href="style/bulletin/stylePrint.css" type="text/css" media="print" />  
    <link rel="stylesheet" href="style/bulletin/styleTb.css" type="text/css" media="screen" />  --> 

   <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: center;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette-box h4 {
      position: absolute;
      top: 100%;
      left: 25px;
      margin-top: -40px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>

  </head>
<?php if (isset($_SESSION['auth'])): ?>
  
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

<?php include 'global/menu.php'; ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>E</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> Sama Ecole </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">3</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 3 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="style/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="style/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="style/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="style/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>

                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ): ?>
              <?php 
// PHOTO DE PROFIL
                $a = "SELECT avatar FROM personnel WHERE identifiant = '{$_SESSION['auth']['identifiant']}'";
                $b = $pdo->prepare($a);
                $b->execute();
                $photo = $b->fetch();
                  if ($photo['avatar']=='') { 
              ?>
                    <div class="pull-left">
                      <img src="style/dist/img/user2-160x160.png" class="user-image" alt="User Image">
                    </div>
              <?php
                  } else { 
              ?>
                    <div class="pull-left">
                      <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="user-image" alt="User Image" />
                    </div> 
              <?php  } 
// FIN PHOTO DE PROFIL
              ?>

              <span class="hidden-xs">
                
                <?= $_SESSION['auth']['prenom'].' '.$_SESSION['auth']['nom']; ?>
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
                    <div class="pull-left">
                      <img src="style/dist/img/user2-160x160.png" class="user-image" alt="User Image">
                    </div>
              <?php
                  } else { 
              ?>
                    <div class="pull-left">
                      <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="user-image" alt="User Image" />
                    </div> 
              <?php  } 
// FIN PHOTO DE PROFIL
              ?>

                <?= $_SESSION['auth']['nomEcole']; ?>
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
                    <div class="pull-left">
                      <img src="style/dist/img/user2-160x160.png" class="user-image" alt="User Image">
                    </div>
              <?php
                  } else { 
              ?>
                    <div class="pull-left">
                      <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="user-image" alt="User Image" />
                    </div> 
              <?php  } 
// FIN PHOTO DE PROFIL
              ?>

                <?= $_SESSION['auth']['nomInspection']; ?>
                <?php endif; ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <?php if( $_SESSION['auth']['statut'] =='Professeur' OR $_SESSION['auth']['statut'] == 'Surveillant' OR $_SESSION['auth']['statut'] == 'Senseur' ): ?>
                
                <?php 
// PHOTO DE PROFIL
                  $a = "SELECT avatar FROM personnel WHERE identifiant = '{$_SESSION['auth']['identifiant']}'";
                  $b = $pdo->prepare($a);
                  $b->execute();
                  $photo = $b->fetch();
                    if ($photo['avatar']=='') { 
                ?>
                        <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                <?php
                    } else { 
                ?>
                        <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                <?php  } 
// FIN PHOTO DE PROFIL
                ?>

                <p>
                  <?= $_SESSION['auth']['pseudo'].' - '.$_SESSION['auth']['statut']
                  .'<br> <small> e-mail: '.$_SESSION['auth']['email'].'</small>'; ?>
                  <small>
                    Inscrit le : <?= $_SESSION['auth']['confirmation_at']; ?>
                    <?php endif; ?>
                  </small>
                </p>
                  <?php if( $_SESSION['auth']['statut'] =='Ecole' ): ?>

                <?php 
// PHOTO DE PROFIL
                  $a = "SELECT avatar FROM ecole WHERE idEcole = '{$_SESSION['auth']['idEcole']}'";
                  $b = $pdo->prepare($a);
                  $b->execute();
                  $photo = $b->fetch();
                    if ($photo['avatar']=='') { 
                ?>
                        <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                <?php
                    } else { 
                ?>
                        <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                <?php  } 
// FIN PHOTO DE PROFIL
                ?>
                <p>
                  <?= $_SESSION['auth']['nomEcole'].'<br> 
                    <small> e-mail: '.$_SESSION['auth']['email'].'</small>'; ?>
                  <small>
                    Inscrit le : <?= $_SESSION['auth']['confirmation_at']; ?>
                    <?php endif; ?>
                  </small>
                </p>
                  <?php if( $_SESSION['auth']['statut'] =='Inspection' ): ?>

                <?php 
// PHOTO DE PROFIL
                  $a = "SELECT avatar FROM inspection WHERE idInspection = '{$_SESSION['auth']['idInspection']}'";
                  $b = $pdo->prepare($a);
                  $b->execute();
                  $photo = $b->fetch();
                    if ($photo['avatar']=='') { 
                ?>
                        <img src="style/dist/img/user2-160x160.png" class="img-circle" alt="User Image">
                <?php
                    } else { 
                ?>
                        <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="img-circle" alt="User Image" />
                <?php  } 
// FIN PHOTO DE PROFIL
                ?>
                <p>
                  <?= $_SESSION['auth']['nomInspection'].'<br>'; ?>
              <?php endif; ?>
                </p>
              </li>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?module=profil/&amp;action=profil" class="btn btn-default btn-flat">
                    <i class=" fa fa-user"></i> Profil
                  </a>
                </div>
                <div class="pull-right">
                  <a href="index.php?module=login/&amp;action=logout" class="btn btn-default btn-flat">
                    <i class=" fa fa-power-off"></i> Déconnexion
                  </a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

<?php else: ?>

  <body class="sidebar-collapse"> 

<?php endif; ?>