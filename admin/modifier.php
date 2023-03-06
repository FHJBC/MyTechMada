<?php
//démarer la session
session_start();
if (!isset($_SESSION['user'])) {
    // si l'utilisateur n'est pas connecté
    // redirection vers la page de connexion
    header("location:index.php");
}
$user = $_SESSION['user'] // email de l'utilisateur
?>
<?php

//on récupère le id dans le lien
$id = $_GET['id'];
//connexion à la base de donnée
include "conn-bdd.php";
//requête pour afficher les infos d'un employé
$req = mysqli_query($con, "SELECT * FROM produits WHERE id = $id");
$row = mysqli_fetch_assoc($req);
//verifier que les données sont envoyés
if (isset($_POST['sendgamme'])) {
    //verifiez que l'image et le texte ont été choisies
    if (!empty($_FILES['image']) && isset($_POST['description']) && $_POST['description'] != "" && isset($_POST['prix']) && $_POST['prix'] != "") {

        //On récupère d'abord le nom de l'image
        $img_nom = $_FILES['image']['name'];

        //Nous définissons un nom temporaire
        $tmp_nom = $_FILES['image']['tmp_name'];

        //On récupère l'heure actuelle
        $time = time();

        //On rennomme l'image en utilisant cette formule : heure + nom de l'image (Pour avoir des images uniques)
        $nouveau_nom_img = $time . $img_nom;

        //on déplace l'image dans un dossier appellé "image_bdd"
        $deplacer_img = move_uploaded_file($tmp_nom, "image/" . $nouveau_nom_img);

        if ($deplacer_img) {
            //si l'image a été mis dans le dossier 
            //insérons le texte et le nom de l'image dans la base de données
            $text = $_POST['description'];
            $prix = $_POST['prix'];
            $req = mysqli_query($con, "UPDATE produits SET image = '$nouveau_nom_img' , description = '$text' , prix = '$prix' WHERE id = $id");
            //verifier que la requête fonctionne
            if ($req) {
                //si oui , faire une redirection vers la page liste.php
                header("location:ajout.php");
            } else {
                //si non
                $message = "Echec de l'ajout de l'image !";
            }
        } else {
            //si non
            $message = "Veuillez choisir une image avec une taille inférieur à 1Mo !";
        }
    } else {
        //si les champs sont vides on affiche un message
        $message = "Veuillez remplir tous les champs !";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style4.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Liste des produits</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <nav class="navbar navbar-expand-sm" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" class="logo">
            </a>
            <ul class="navbar-nav">
                <li class="li" class="categorie">
                    <a href="acceuil.php">Insertion de catégorie</a>
                <li class="li" class="produit">
                    <a href="ajout.php">Insertion de produits</a>
                </li>
                <li class="li" class="categorie">
                    <a href="ajoutvendu.php"> Produits les plus vendus</a>
                </li>
            </ul>
            <a href="deconnexion.php"><i class="fa-solid fa-power-off"></i></a>

        </div>
    </nav>

    <p class="error">
        <?php
        //afficher une erreur si la variable message existe
        if (isset($message)) echo $message;
        ?>
    </p>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="parent-div">
            <button class="btn-upload">Inserez une photo</button>
            <input type="file" name="image" id="img" onchange="previewPicture(this)" required />
        </div>

        <!-- <input type="file" name="image" id="img" onchange= "previewPicture(this)" required><br><br> -->
        <div class="photo">
            <img src="#" alt="" id="image" style="max-width: 90%; max-height:20vh;">
        </div>
        <label for="text">Dercirption de votre produit</label><br>
        <!-- <input type="text" name="description" id="description"><br><br> -->
        <textarea name="description" id="description" cols="30" rows="5"> <?= $row['description'] ?> </textarea><br>

        <label for="text">prix</label><br>
        <input type="text" name="prix" id="prix" value="<?= $row['prix'] ?>"><br><br>

        <input type="submit" value="Envoyer" name="sendgamme" class="submit">
    </form>

    <script type="text/javascript">
        // L'image img#image
        var img = document.getElementById("image");

        // La fonction previewPicture
        var previewPicture = function(e) {

            // e.files contient un objet FileList
            const [image] = e.files

            // "picture" est un objet File
            if (image) {
                // On change l'URL de l'image
                img.src = URL.createObjectURL(image)
            }
        }
    </script>
</body>

</html>