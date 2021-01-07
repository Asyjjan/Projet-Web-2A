<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleConnexion2.css" />
	<link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileConnexion2.css" />
	<?php
	include 'Connexion.php';
	?>
</head>

<body>

		<form class="box" method="POST" name="forminscription">
			<h1> Créer un compte </h1>
				<input type="text" name="nom" placeholder="Nom">
				<input type="text" name="prenom" placeholder="Prénom">
				<input type="text" name="email" placeholder="Email">
				<input type="password" name="mdp" placeholder="Mot de passe">
				<input type="submit" name="valider" value="Valider">
		</form>

	<?php
	if(!empty($_POST)){
		$ok = true;
		$nom = $_POST['nom'] = trim(htmlentities($_POST['nom']));
		$prenom = $_POST['prenom'] = trim(htmlentities($_POST['prenom']));
		$email = $_POST['email'] = trim(htmlentities($_POST['email']));
		$mdp = $_POST['mdp'] = trim(htmlentities($_POST['mdp']));
		$regexEmail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
		$regexNom = "/^[a-z]+[\-']?[[a-z]+[\-']?]*[a-z]+$/i";

		if(empty($_POST['nom']) || !preg_match($regexNom, $_POST['nom'])){
			$messageErrorNom='Veuillez renseigner un nom correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorNom.'");</script>';

			$ok = false;
		}

		if(empty($_POST['prenom']) || !preg_match($regexNom, $_POST['prenom'])){
			$messageErrorPrenom='Veuillez renseigner un prénom correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorPrenom.'");</script>';

			$ok = false;
		}

		if(empty($_POST['email']) || !preg_match($regexEmail, $_POST['email'])){
			$messageErrorEmail='Veuillez renseigner un mail correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorEmail.'");</script>';

			$ok = false;
		}

		if(empty($_POST['mdp'])){
			$messageErrorMdp='Veuillez renseigner un mot de passe correct';
			echo '<script type="text/javascript">window.alert("'.$messageErrorMdp.'");</script>';

			$ok = false;
		}

		$stmt = $objPdo->prepare("SELECT * FROM REDACTEUR WHERE adressemail=?");
        $stmt->execute([$email]); 
        $user = $stmt->fetch();
        if ($user) {
        $messageErrorEmail="un compte existe deja avec ce mail";
        echo '<script type="text/javascript">window.alert("'.$messageErrorEmail.'");</script>';
        $ok = false;
        }

		if($ok){
			$insert_stmt = $objPdo->prepare("INSERT INTO REDACTEUR(nom,prenom,adressemail,motdepasse,nbnews) VALUES(?,?,?,?,?) ");
			$insert_stmt->bindValue(1, $nom);
			$insert_stmt->bindValue(2, $prenom);
			$insert_stmt->bindValue(3, $email);
			$insert_stmt->bindValue(4, $mdp);
			$insert_stmt->bindValue(5, "0");
			$insert_stmt->execute();
			header("location: FormulaireConnexion.php");
		}
	}
	?>
</body>
</html>