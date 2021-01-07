<!DOCTYPE html>
<html>
<head>
	<title>Deconnexion</title>
	<?php error_reporting( E_ALL ^ E_NOTICE );
	session_start() ;
	session_unset() ;
	session_destroy();
	header("location: Acceuil.php")
	 ?>
</head>
<body>

</body>
</html>