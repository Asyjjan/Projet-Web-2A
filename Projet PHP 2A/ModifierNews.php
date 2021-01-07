<!DOCTYPE html>
<html>
<head>
	<title>Modification News</title>
	<link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleModif2.css" />
	<link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileModif2.css" />
	<meta charset="utf-8">
<?php
    include 'Connexion.php';
    error_reporting(E_ALL & ~E_NOTICE);
	session_start(); 
	
?>
</head>

<header>
	<h2><a href="Acceuil.php">Toki</a></h2>
</header> 

<body>
	<form class="modif" method="POST">
		<h1> Modifier une nouvelle </h1>
		<label>Titre de la news</label><input type="text" name="titre">
		<label>Contenu</label><textarea name = "description"></textarea>
		<input type="submit" name="Valider" value="Valider">
	</form>

<?php
			$select = $objPdo->prepare("SELECT * FROM NEWS WHERE idnews = ?");
			$select->bindValue(1, $_GET['idnews'], PDO::PARAM_INT);
			$select->execute();

		if(!empty($_POST)){
		$ok = true;
		$titre = $_POST['titre'] = trim(htmlentities($_POST['titre']));
		$description = $_POST['description'] = trim(htmlentities($_POST['description']));
		$idredacteur = $_SESSION['idredacteur'];

		if(empty($_POST['titre'])){
			$messageErrorTitre='Veuillez renseigner un titre correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorTitre.'");</script>';

			$ok = false;
		}

		if(empty($_POST['description'])){
			$messageErrorDescription='Veuillez renseigner une description correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorDescription.'");</script>';

			$ok = false;
		}

		if($ok){
			$update_stmt = $objPdo->prepare("UPDATE NEWS SET titrenews = ? , textenews = ? WHERE idnews= ? ");
			$update_stmt->bindValue(3, $_GET['idnews'], PDO::PARAM_STR);
			$update_stmt->bindValue(1, $titre, PDO::PARAM_STR);
			$update_stmt->bindValue(2, $description, PDO::PARAM_STR);
			$update_stmt->execute();

			header("Location: Acceuil.php");
		}
	}
?>
</body>
</html>