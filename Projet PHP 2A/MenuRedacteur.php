<!DOCTYPE html>
<html>
<head>
	<title>Menu rédacteur</title>
	<link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleRedac2.css" />
	<link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileRedac2.css" />
	<meta charset="utf-8">
	<?php
	include 'Connexion.php';
	error_reporting(E_ALL & ~E_NOTICE);
	session_start(); 
	$idredacteur = $_SESSION['idredacteur'];
	?>
</head>

<header>
	<h2><a href="Acceuil.php">Toki</a></h2>
</header> 

<body>
	<div class="table">
				<h1>Voici vos articles : </h1>
<table>

		<tr>
			<th class="titretab"> Titre News </th>
			<th class="titretab"> Date de publication </th>
			<th class="titretab"> Action </th>
		</tr>
<?php
			$result = $objPdo->prepare("SELECT * FROM NEWS,REDACTEUR WHERE NEWS.idredacteur = REDACTEUR.idredacteur AND NEWS.idredacteur='$idredacteur' ORDER BY datenews DESC");
			$result->bindValue('idredacteur', $idredacteur, PDO::PARAM_STR);
			$result->execute(); 
			while($row = $result->fetch( )){
					echo "<tr>";
						echo "<th>"; echo  $row['titrenews'] ; echo "</th>";
						echo "<th>"; echo  $row['datenews'] ; echo "</th>";
						echo "<th>"; echo '<a href="SupprimerNews.php?idnews='.$row['idnews'] .'" > Supprimer </a>'; echo "</th>";
						echo "<th>"; echo '<a href="ModifierNews.php?idnews='.$row['idnews'] .'" > Modifier </a>'; echo "</th>";
					echo "</tr>";
			}
?>
</table>
</div>
</body>
</html>