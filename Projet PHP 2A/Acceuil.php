<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

		<?php
		error_reporting(E_ALL & ~E_NOTICE);
		session_start();

		function toutAfficher(){
			$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
			$result = $objPdo->query("SELECT * FROM NEWS,REDACTEUR WHERE NEWS.idredacteur = REDACTEUR.idredacteur ORDER BY datenews DESC");
			while($row = $result->fetch( )){
				echo "<div class=article>";
				echo "<h2>" . $row['titrenews'] . "</h2>";
				echo "<p class=auteur>" . "auteur : " . $row['nom'] . " " . $row['prenom'] . "</p>";
				echo "<p class=date>" . "date de publication : " . $row['datenews'] . "</p>";
				echo "<p class=info>" . $row['textenews'] . "</p>";
				echo "</div>";
			}
		}

		function sportAfficher(){
			$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
			$result2 = $objPdo->query("SELECT * FROM NEWS,REDACTEUR WHERE NEWS.idredacteur = REDACTEUR.idredacteur AND idtheme=1 ORDER BY datenews DESC");
			while($row = $result2->fetch( )){
				echo "<div class=article>";
				echo "<h2>" . $row['titrenews'] . "</h2>";
				echo "<p class=auteur>" . "auteur : " . $row['nom'] . " " . $row['prenom'] . "</p>";
				echo "<p class=date>" . "date de publication : " . $row['datenews'] . "</p>";
				echo "<p class=info>" . $row['textenews'] . "</p>";
				echo "</div>";
			}
		}

		function mangaAfficher(){
			$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
			$result3 = $objPdo->query("SELECT * FROM NEWS,REDACTEUR WHERE NEWS.idredacteur = REDACTEUR.idredacteur AND idtheme=2 ORDER BY datenews DESC");
			while($row = $result3->fetch( )){
				echo "<div class=article>";
				echo "<h2>" . $row['titrenews'] . "</h2>";
				echo "<p class=auteur>" . "auteur : " . $row['nom'] . " " . $row['prenom'] . "</p>";
				echo "<p class=date>" . "date de publication : " . $row['datenews'] . "</p>";
				echo "<p class=info>" . $row['textenews'] . "</p>";
				echo "</div>";
			}
		}

		function jeuvideoAfficher(){
			$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
			$result4 = $objPdo->query("SELECT * FROM NEWS,REDACTEUR WHERE NEWS.idredacteur = REDACTEUR.idredacteur AND idtheme=3 ORDER BY datenews DESC");
			while($row = $result4->fetch( )){
				echo "<div class=article>";
				echo "<h2>" . $row['titrenews'] . "</h2>";
				echo "<p class=auteur>" . "auteur : " . $row['nom'] . " " . $row['prenom'] . "</p>";
				echo "<p class=date>" . "date de publication : " . $row['datenews'] . "</p>";
				echo "<p class=info>" . $row['textenews'] . "</p>";
				echo "</div>";
			}
		}
		?>

	<title>Acceuil</title>
	<link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleAcceuil.css" />
	<link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileAcceuil.css" />
</head>

<header>
	<h2><a href="Acceuil.php">Toki</a></h2>
	<ul>
		<?php 
		if ($_SESSION['ouvert']== true){
			echo "<a href='deconnexion.php'>Deconnexion</a>";
		}
		else{
			echo "<a href='FormulaireConnexion.php'>Connexion</a>";
		}
		?>
		<?php 
		if ($_SESSION['ouvert']== true){
			echo "<a href='FormulaireNews.php'>Crée une news</a>";
		}
		else{
			echo "<a href='FormulaireInscription.php'>Inscription</a>";
		} 
		?>
		<?php
		if ($_SESSION['ouvert']== true){
			echo "<a href='MenuRedacteur.php'>Menu rédacteur</a>";
		}
		?>
	</ul>
</header> 

<body>
	<form class="filtre" action="" method="POST">
		<div>
			<nav>
				<ul>
					<select name="theme">
						<option value="0">Tout afficher</option>
						<option value="1">Sport</option>
						<option value="2">Manga</option>
						<option value="3">Jeux-vidéo</option>
					</select> 

					<input type="submit" name="filtre" value="Filtrer"> 

				</ul>
			</nav>
		</div>
	</form>
	<section class="panneau">
		<div class="conf">
		<?php
		include 'Connexion.php';

		if(isset($_POST['theme'])){
			$selectoption = $_POST['theme'];
			switch ($selectoption) {

				case '0':
				toutAfficher();
				break;

				case '1':
				sportAfficher();
				break;

				case '2':
				mangaAfficher();
				break;

				case '3':
				jeuvideoAfficher();
				break;
			}
		}
		else
			toutAfficher();
		?>
	</div>
	</section>

	<section class="redac">
		<div class="divredac">
	<table class="topredac">
		<tr>
			<th class="titretab"> Nom </th>
			<th class="titretab"> Prenom </th>
			<th class="titretab"> Nombre de news </th>
		</tr>
	<?php
		$_SESSION['nbprecedent']=0;
			$objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=djermou17u_PHP_Projet' , 'djermou17u_appli','31907816');
		$result = $objPdo->query("SELECT * FROM REDACTEUR ORDER BY nbnews DESC");
		while($row = $result->fetch( )){
			if ($row['nbnews']>$_SESSION['nbprecedent']) {
					echo "<tr>";
						echo "<th>"; echo  $row['nom'] ; echo "</th>";
						echo "<th>"; echo  $row['prenom'] ; echo "</th>";
						echo "<th>"; echo  $row['nbnews'] ; echo "</th>";
						echo "<th>"; echo  "★TOP REDACTEUR" ; echo "</th>";
					echo "</tr>";
			}
			elseif ($row['nbnews']==$_SESSION['nbprecedent']) {
					echo "<tr>";
						echo "<th>"; echo  $row['nom'] ; echo "</th>";
						echo "<th>"; echo  $row['prenom'] ; echo "</th>";
						echo "<th>"; echo  $row['nbnews'] ; echo "</th>";
						echo "<th>"; echo  "★CONCURRENT" ; echo "</th>";
					echo "</tr>";
			}
			else{
					echo "<tr>";
						echo "<th>"; echo  $row['nom'] ; echo "</th>";
						echo "<th>"; echo  $row['prenom'] ; echo "</th>";
						echo "<th>"; echo  $row['nbnews'] ; echo "</th>";
					echo "</tr>";
			}
		$_SESSION['nbprecedent']=$row['nbnews'];
		}
		?>
	</table>
</div>
	</section>
</body>
</html>