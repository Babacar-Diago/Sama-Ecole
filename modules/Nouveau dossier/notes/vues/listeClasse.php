<form action="" method="post">

    <fieldset>
 	<legend> Informations generales : </legend>
	<p>
		
					<div>
						<label>Niveau :</label>      
						<select id="niveau" name='niveau'>
			            <option selected="selectionner"> </option>
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
				
					<div>
						<label> Classe : </label>    
						<select id="classe" name='classe'>
			            <option selected="selectionner"> </option>   
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
						<label> Annee Scolaire : </label>    
						<select id="anneeScolaire" name='anneeScolaire'>
			            <option selected="selectionner"> </option>   
			            <?php 
				            $req = $pdo->prepare('SELECT DISTINCT anneeScolaire FROM anneescolaire order by anneeScolaire asc');
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
					<br>
					<div>
						<input type='submit' id='liste' name='liste' value="Afficher la liste" />
						<input type="reset" value="Annuler" />
					</div>
	</p>
	</fieldset>
</form>