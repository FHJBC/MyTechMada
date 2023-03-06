<?php
//démarer la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
</head>

<body>
    <?php
    if (isset($_POST['button_con'])) {
        //si le formulaire est envoyé
        //se connecter à la base de donnée
        include "conn-bdd.php";
        //extraire les infos du formulaire
        extract($_POST);
        //verifions si les champs sont vides
        if (isset($email) && isset($mdp1) && $email != "" && $mdp1 != "") {
            //verifions si les identifiants sont justes
            $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email = '$email' AND mdp = '$mdp1'");
            if (mysqli_num_rows($req) > 0) {
                //si les ids sont justes
                //Création d'une session qui contient l'email
                $_SESSION['user'] = $email;
                //redirection vesr la page chat
                header("location:acceuil.php");
            } else {
                //si non
                $error = "Email ou Mots de passe incorrecte(s) !";
            }
        } else {
            //si les champs sont vides
            $error = "Veuillez remplir tous les champs !";
        }
    }
    ?>
    <form action="" method="POST" class="form_connexion_inscription">
        <div class="img">
            <img src="images/Group 1393.png" alt="logo" width="189px">
        </div>
        <p class="message_error">
            <?php
            //affichons l'erreur
            if (isset($error)) {
                echo $error;
            }
            ?>
        </p>
        <div class="user">
            <i class="fa fa-user"></i>
            <input type="email" name="email" placeholder="NOM D'UTILISATEUR">
        </div>
        <div class="mdp">
            <i class="fa fa-lock"></i>
            <input type="password" name="mdp1" placeholder="MOTS DE PASSE">
        </div>
        <input type="submit" value="Connexion" name="button_con">
        <!-- <p class="link">Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p> -->
    </form>

</body>

</html>