<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Création d'une nouvelle</title>
	<link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleNews2.css" />
	<link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileNews2.css" />
	<?php 
	include 'Connexion.php';
	session_start();
	?>
</head>

<header>
	<h2><a href="Acceuil.php">Toki</a></h2>
</header> 

<body>

<form class="news" method="POST" name="formnews">
	<h1> Créer une news </h1>

	<label class="categ">Titre de la nouvelle</label>
	<input type="text" name="titre" placeholder="Titre de la nouvelle">

		<label class="categ">Thème de la nouvelle</label>
		<input type="radio" name="theme" value="2"> <label class="radio">Manga</label>
		<input type="radio" name="theme" value="1"> <label class="radio">Sport</label>
		<input type="radio" name="theme" value="3"> <label class="radio">Jeux-Video</label>

		<label class="categ">Contenu</label>
		<textarea name = "description"></textarea>

	<input type="submit" name="valider" value="Valider">
</form>

	<?php
	if(!empty($_POST)){
		$ok = true;
		$titre = $_POST['titre'] = trim(htmlentities($_POST['titre']));
		$theme = $_POST['theme'] = trim(htmlentities($_POST['theme']));
		$description = $_POST['description'] = trim(htmlentities($_POST['description']));
		date_default_timezone_set('UTC');
		$date = date('Y-m-d');
		$idredacteur = $_SESSION['idredacteur'];

		$select_stmt = $objPdo->prepare("SELECT nbnews FROM REDACTEUR WHERE idredacteur = '$idredacteur'");
		$select_stmt->bindValue('idredacteur', $idredacteur, PDO::PARAM_STR);
		$select_stmt->execute(); 
        while ($row=$select_stmt->fetch(PDO::FETCH_OBJ) ) {
            $nbnews=$row->nbnews;
        }
        ++$nbnews;

		if(empty($_POST['titre'])){
			$messageErrorTitre='Veuillez renseigner un titre correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorTitre.'");</script>';

			$ok = false;
		}

		if(empty($_POST['theme'])){
			$messageErrorTheme='Veuillez renseigner un thème correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorTheme.'");</script>';

			$ok = false;
		}

		if(empty($_POST['description'])){
			$messageErrorDescription='Veuillez renseigner une description correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorDescription.'");</script>';

			$ok = false;
		}

		$stmt = $objPdo->prepare("SELECT * FROM NEWS WHERE titrenews=?");
        $stmt->execute([$titre]); 
        $news = $stmt->fetch();
        if ($news) {
        $messageErrorNews="une news existe deja avec ce titre";
        echo '<script type="text/javascript">window.alert("'.$messageErrorNews.'");</script>';
        $ok = false;
        }

		if($ok){
			$insert_stmt = $objPdo->prepare("INSERT INTO NEWS(idnews,idtheme,titrenews,datenews,textenews,idredacteur) VALUES(?,?,?,?,?,?) ");
			$insert_stmt->bindValue(1, "0");
			$insert_stmt->bindValue(2, $theme);
			$insert_stmt->bindValue(3, $titre);
			$insert_stmt->bindValue(4, $date);
			$insert_stmt->bindValue(5, $description);
			$insert_stmt->bindValue(6, $idredacteur);
			$insert_stmt->execute();

			$update_stmt = $objPdo->prepare("UPDATE REDACTEUR SET nbnews = '$nbnews' WHERE idredacteur = '$idredacteur'");
        	$update_stmt->bindValue('idredacteur', $idredacteur, PDO::PARAM_STR);
        	$update_stmt->bindValue('nbnews', $nbnews, PDO::PARAM_STR);
			$update_stmt->execute();

			header("Location: Acceuil.php");
		}
	}
	?>
</body>
</html>