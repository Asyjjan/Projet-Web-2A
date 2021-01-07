<?php
    include 'Connexion.php';
    session_start();
    $idredacteur = $_SESSION['idredacteur'];

    $delete_stmt=$objPdo->prepare('DELETE FROM NEWS WHERE idnews=?');
    $delete_stmt->bindValue(1, $_GET['idnews'], PDO::PARAM_INT);
    $delete_stmt->execute(); 

	$select_stmt = $objPdo->prepare("SELECT nbnews FROM REDACTEUR WHERE idredacteur = '$idredacteur'");
	$select_stmt->bindValue('idredacteur', $idredacteur, PDO::PARAM_STR);
	$select_stmt->execute(); 
    while ($row=$select_stmt->fetch(PDO::FETCH_OBJ) ) {
        $nbnews=$row->nbnews;
    }
    --$nbnews;

	$update_stmt = $objPdo->prepare("UPDATE REDACTEUR SET nbnews = '$nbnews' WHERE idredacteur = '$idredacteur'");
    $update_stmt->bindValue('idredacteur', $idredacteur, PDO::PARAM_STR);
    $update_stmt->bindValue('nbnews', $nbnews, PDO::PARAM_STR);
	$update_stmt->execute();

    header('location:Acceuil.php');

?>