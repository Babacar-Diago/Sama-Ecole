<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajout d'un(e) élève à la base de donnée
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-primary">
		<form action="" method="post" role="form" class="box-body">				
			<p>				
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Niveau : </label>    
					<select id="niveau" name='niveau' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>   
		            <?php 
			            $req = $pdo->prepare('SELECT DISTINCT niveau FROM niveau order by niveau asc');
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
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Serie : </label>    
					<select id="serie" name='serie' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>   
		            <?php 
			            $req = $pdo->prepare('SELECT DISTINCT serie FROM serie order by serie asc');
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
				<div>
					<input type="submit" value="AJOUTER" name="ajouter" />
				</div>

			</p>
		</form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>