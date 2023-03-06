<?php
include "admin/conn-bdd.php";

if (isset($_POST['Envoyer'])) {

    extract($_POST);

    $name = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if ($name != "" && $prenom != "" && $email != "" && $message != "") {

        $req = mysqli_query($con, "INSERT INTO contact VALUES(NULL,'$name','$prenom','$email','$message')");
        if ($req) {
            $message = "Nous avons reçu votre message !";
        }
    } else {
        $erreur = "Remplir tous les champs !";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <title>Contact</title>
</head>

<body>
    <div class="containeur">
        <div class="row">
            <div class="col-12 col-md-5" id="information">
                <div>
                    <h1>Contactez-nous!</h1>
                    <div class="informations">
                        <p><i class="fa-sharp fa-solid fa-phone-volume"></i> <a href="tel:+261 32 64 372 36">+261 32 64 372 36</a></p>
                        <p><i class="fa-sharp fa-solid fa-envelope"></i> <a href="mailto:noella@mytechmada.com">noella@mytechmada.com</a></p>
                        <p><i class="fa-solid fa-location-dot"></i> Antananarivo, Madagascar</p>
                    </div>
                    <div class="reseau">
                        <a href="http://"><img src="assets/icons/instagram.png" alt="instagram-icon" srcset=""></a>
                        <a href="http://"><img src="assets/icons/Group 5.png" alt="group 5 icon" srcset=""></a>
                        <a href="http://"><img src="assets/icons/twitter.png" alt="twitter-icon" srcset=""></a>
                        <a href="http://"><img src="assets/icons/facebook.png" alt="facebook-icon" srcset=""></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7" id="form">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Nom</label>
                        <input type="text" class="form-control bottom" name="nom">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Prénom</label>
                        <input type="text" class="form-control bottom" name="prenom">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" class="form-control bottom" name="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Message</label>
                        <textarea class="form-control bottom" name="message" placeholder="Commencez à écrire"></textarea>
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn btn-primary" name="Envoyer">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/8819a2739b.js" crossorigin="anonymous"></script>
</body>

</html>