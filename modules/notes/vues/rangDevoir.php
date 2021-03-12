<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Coef de la matière choisie 
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
					<label> Semestre : </label>
					<select id="semestre" name='semestre' class="form-control">
			            <option selected="selectionner">-----selectionner-----</option>
			            <option>Semestre 1</option>
			            <option>Semestre 2</option>
		            </select>    
					
				</div>
				<div class="col-md-8 col-lg-8 col-xs-12 col-sm-8">
					<label> Matière : </label>    
					<select id="matiere" name='matiere' class="form-control">
		            <option selected="selectionner">-----selectionner-----</option>   
		            <?php 
			            $req = $pdo->prepare('SELECT DISTINCT nom FROM matiere order by nom asc');
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
					<label>  </label>   
					<input type="submit" value="RANGER" name="ranger" class="btn btn-primary />
				</div>
								
			</p>
		</form>
	  </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->