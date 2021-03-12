        <div class="col-md-3 col-sm-3">

          <!-- Profile Image -->
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

            <div class="box-body box-profile">
              
              <?php 
// PHOTO DE PROFIL
                $a = "SELECT avatar FROM personnel WHERE identifiant = '{$_SESSION['auth']['identifiant']}'";
                $b = $pdo->prepare($a);
                $b->execute();
                $photo = $b->fetch();

                  if ($photo['avatar']=='') { 
              ?>
                    <img class="profile-user-img img-responsive img-circle" src="style/dist/img/user2-160x160.png" alt="User profile picture">
              <?php
                  } else { 
              ?>
                    <img src="<?php echo DOSSIER_AVATAR.($photo['avatar']); ?>" class="profile-user-img img-responsive img-circle" alt="User Image" />
              <?php  } 
// FIN PHOTO DE PROFIL
              ?>

              <h4 class="profile-username text-center">

                <?php if( $_SESSION['auth']['statut'] =='Professeur'): ?>
                <?= $_SESSION['auth']['prenom'].' '.$_SESSION['auth']['nom']; ?>
                <?php endif; ?>
                  
              </h4>

              <p class="text-muted text-center">
                <?php echo $_SESSION['auth']['statut']; ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Matière enseignées : </b>
                   <br><a class="pull-right">
                      <?php
                       echo $nomMatiere; 
                      ?>
                      
                   </a><br>
                </li>
                <li class="list-group-item">
                  <b>Autres : </b> <a class="pull-right">Néant</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">A propos de mon école</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Ecole</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->