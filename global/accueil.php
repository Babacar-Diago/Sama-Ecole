<?php
if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3> Page d'accueil </h3> 

      <?php if (!isset($_SESSION['auth'])): ?>  
        <ol class="breadcrumb">
          <li class="tab-pane"><a href="index.php?module=login/&amp;action=login">
            <h4> <i class="fa fa-plus-square"></i> Connexion </h4> </a></li>
        </ol>
      <?php endif; ?>

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
        
          <div class="nav-tabs-custom">
            
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    Blabla blabla blabla blabla blabla blabla blabla blabla blabla blabla
                    
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
            </div> 
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  