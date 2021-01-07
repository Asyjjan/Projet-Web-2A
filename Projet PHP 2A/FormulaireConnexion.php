<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" media="screen and (min-width:721px)" href="CSS/styleConnexion2.css" />
    <link rel="stylesheet" media="screen and (max-width:720px)" href="CSS/mobileConnexion2.css" />

    <?php
    include 'Connexion.php';

    if(isset($_POST['email']) && isset($_POST['mdp']))
    {

        $email = $_POST['email'];
        $password = $_POST['mdp'];

        $result = $objPdo->query("SELECT * FROM REDACTEUR WHERE adressemail = '$email' AND motdepasse = '$password' ");
        $result->bindValue('email', $_POST['email'], PDO::PARAM_STR);
        $result->bindValue('mdp', $_POST['mdp'], PDO::PARAM_STR);
        $count = $result->rowCount();

        if($count == 1)
        {
            echo "Connexion avec un compte existant";
            session_start();
            $_SESSION['ouvert']=true;
            $stmt = $objPdo->query("SELECT idredacteur FROM REDACTEUR WHERE adressemail = '$email'");
            $stmt->bindValue('email', $_POST['email'], PDO::PARAM_STR);
            $id = $stmt->fetch();
            $_SESSION['idredacteur']=$id[0];
            header("location: Acceuil.php");
        }
        else
        {
            echo "<p class=alert> Connexion avec un compte inexistant </p>";
        }
    }

    ?>

</head>
<body>

    <form class="box" method="POST">
        <h1> Connexion </h1>
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="mdp" placeholder="Mot de passe">
        <input type="submit" name="valider" value="Valider" class="submit">
    </form>

</body>
</html>