
<form action="" method="post">
	<fieldset>
		<legend> Informations supplementaires : </legend>
		<div>
			<label> Semestre : </label>
			<select id="semestre" name='semestre'>
	            <option selected="selectionner">-----selectionner-----</option>
	            <option>Semestre 1</option>
	            <option>Semestre 2</option>
            </select>    						
		</div>
	
		<div>
			<label> Matiere : </label> 
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
			<label> Serie : </label>    
			<select id="serie" name='serie'>
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
	</fieldset>

	<fieldset>
		<legend> Informations generales : </legend>

		<b>✓</b><input type="text" name="niveau" value="<?php if (isset($_POST['niveau'])){echo $_POST['niveau'];} ?>"> 	
		<b>✓</b><input type="text" name="classe" value="<?php if (isset($_POST['classe'])){echo $_POST['classe'];} ?>"> 	
		<b>✓</b><input type="text" name="anneeScolaire" value="<?php if (isset($_POST['anneeScolaire'])){echo $_POST['anneeScolaire'];} ?>"> 	
		
		<?php 
		/*	echo '<b>✓</b><input type="text" name="niveau" value="' .$_POST['niveau']. '">' ;	
			echo '<b>✓</b><input type="text" name="classe" value="' .$_POST['classe']. '">' ;	
			echo '<b>✓</b><input type="text" name="anneeScolaire" value="' .$_POST['anneeScolaire']. '">' ;	
			
			echo "<h3> <b>✓</b> Niveau : ".  $_POST['niveau']." </h3> ";        
			echo "<h3> <b>✓</b> Classe : ".  $_POST['classe']."</h3> ";
			echo "<h3> <b>✓</b> Annee Scolaire : ".  $_POST['anneeScolaire']."</h3> ";
		*/?>
	</fieldset>


	<center><table>
	<tr>
		<th colspan="3"> <h2>Liste eleves</h2> </th>
	</tr>

	<tr>
		<th>eleve</th>
		<th>note devoir</th>
		<th>note composition</th>
	</tr>

		<?php 

		if (!empty($_POST['niveau']) && !empty($_POST['classe']) && !empty($_POST['anneeScolaire']) ) {
		 	
		  //if (isset($_POST['liste'])) {

	      $req = $pdo->prepare("SELECT eleve FROM etreeleve
	          WHERE etreeleve.niveau='".$_POST['niveau']."'
	            AND etreeleve.classe='".$_POST['classe']."'
	            AND etreeleve.anneeScolaire='".$_POST['anneeScolaire']."' ");
	       $req->execute();
	      
	      if ($req){
	          
	          $nbreLigne = $req->fetchAll();
	          //var_dump($nbreLigne);
	          $i = 0;
	          foreach ($nbreLigne as $key => $value) {
	          $i = ++$i; 
	          //$devoir = (isset($_POST['devoir'.$i])) ? $_POST['devoir'.$i] : null; 
	          //$composition = (isset($_POST['composition'.$i])) ? $_POST['composition'.$i] : null; 
	          	echo "<tr>";
	          	echo "<td><center>".$value[0]."</center></td>";
	            echo "<td><center><input type='number'  name='devoir[]' /></center></td>";
	            echo "<td><center><input type='number'  name='composition[]' /></center></td>";                        
	          	echo "</tr>";
	          }

	          echo "<tr>";
	          echo "<th colspan='3'> <input type='submit' id='valider' name='valider' value='Valider' /> </th>";
	          echo "</tr>";
	        }
	      //} 
		}

	     ?>
	</table></center>
</form>
