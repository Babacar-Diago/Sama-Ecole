<form action="" method="post">
	<p>
		<div>
			<label> Semestre : </label>
			<select id="semestre" name='semestre'>
	            <option selected="selectionner">-----selectionner-----</option>
	            <option>Semestre 1</option>
	            <option>Semestre 2</option>
            </select>    
			
		</div>
		<div>
			<label> Matière : </label>    
			<select id="matiere" name='matiere'>
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
		<div>
			<label>  </label>   
			<input type="submit" value="RANGER" name="ranger" />
		</div>
						
	</p>
</form>