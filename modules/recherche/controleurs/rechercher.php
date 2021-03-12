<?php

	$pdo = PDO2::getInstance();

	if (!empty($_POST['valider']) && !empty($_POST['choix'])) {

		foreach ($_POST['choix'] as $choix) {
		
			if ($choix=='ListMoyClasse') {
				header('Location: index.php?module=recherche/&action=listeMoyenne');
			} elseif ($choix=='B_classe') {
				header('Location: index.php?module=recherche/&action=listeBulletin');
			} elseif ($choix=='B_eleve') {
				header('Location: index.php?module=recherche/&action=bulletinDunEleve');
			} elseif ($choix=='eleve') {
				header('Location: index.php?module=recherche/&action=infosEleve');
			} elseif ($choix=='liseClasse') { 
				header('Location: index.php?module=recherche/&action=listeElevesDuneClasse');
			} elseif ($choix=='listeNiveau') { 
				header('Location: index.php?module=recherche/&action=listeElevesParNiveau');
			} elseif ($choix=='listeNiveauSerie') { 
				header('Location: index.php?module=recherche/&action=listeElevesParNiveauEtSerie');
			}
		}
	}else{
		include CHEMIN_VUE.'rechercher.php';
	}

?> 