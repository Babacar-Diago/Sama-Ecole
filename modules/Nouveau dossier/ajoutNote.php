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
			<label> Note du devoir : </label>    
			<input type="text" name="devoir" maxlength="5" /> 
		</div>
		<div>
			<label> Note de la composition : </label>    
			<input type="text" name="composition" maxlength="5" /> 
		</div>
		<div>
			<label> Elève : </label> 
            <input type="text" name="eleve" maxlength="8" placeholder="renseignez le matricule" />
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
			<label> Classe : </label>    
			<select id="classe" name='classe'>
            <option selected="selectionner">-----selectionner-----</option>   
            <?php 
	            $req = $pdo->prepare('SELECT DISTINCT nom FROM classe order by nom asc');
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
			<input type="submit" value="AJOUTER" name="ajouter" />
		</div>
						
	</p>
</form>