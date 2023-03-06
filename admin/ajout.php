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

include "conn-bdd.php";

if (isset($_POST['Envoyer'])) {

    extract($_POST);

    $select = $_POST['select'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    if ($select != "" && !empty($_FILES['image']) && $description != "" && $prix != "") {

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


            $req = mysqli_query($con, "INSERT INTO produits VALUES(NULL,'$select','$nouveau_nom_img','$description', '$prix')");
            if ($req) {
                //si oui , faire une redirection vers la page liste.php
                header("location:ajout.php");
            } else {
                //si non
                $message = "Echec de l'ajout de produit !";
            }
        } else {
            $message = " l'image de produit n'est pas déplacer";
        }
    } else {
        $message = " remplir tous les champs";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        ul li#categorie2 {
            background: #396AFF;
        }
    </style>
    <title>ajouteur</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" class="logo">
            </a>
            <ul class="navbar-nav">
                <li class="li" id="categorie1">
                    <a href="acceuil.php">Insertion de catégorie</a>
                </li>
                <li class="li" id="categorie2">
                    <a href="ajout.php">Insertion de produits</a>
                </li>
                <li class="li" id="categorie3">
                    <a href="ajoutvendu.php"> Produits les plus vendus</a>
                </li>
            </ul>
            <a href="deconnexion.php"><i class="fa-solid fa-power-off fa-2x"></i></a>

        </div>
    </nav>
    <p style=" color:red">
        <?php
        //afficher une erreur si la variable message existe
        if (isset($message)) echo $message;
        ?>
    </p>
    <div class="flud">
        <div class="form">
            <form action="" method="post" enctype="multipart/form-data">
                <select name="select" id="select">
                    <option value="" disabled selected>choisissez une categorie</option>
                    <?php
                    $req = mysqli_query($con, "SELECT * FROM categorie");

                    //verifier que la liste n'est pas vide
                    if (mysqli_num_rows($req) < 1) {
                    } else {
                        while ($row = mysqli_fetch_assoc($req)) {
                    ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nom'] ?></option>
                    <?php
                        }
                    }

                    ?>
                </select><br><br>
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
                <textarea name="description" id="description" cols="30" rows="5"></textarea><br>

                <label for="text">prix</label><br>
                <input type="text" name="prix" id="prix"><br><br>

                <input type="submit" value="Envoyer" name="Envoyer" class="submit">

            </form>
        </div>
        <div class="table">
            <table id="table">
                <tr id="items">
                    <th id="N">N°</th>
                    <th>Produit</th>
                    <th>description</th>
                    <th>prix</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr id="tr">
                <?php
                //inclure la page de connexion
                include "conn-bdd.php";
                //requête pour afficher la liste des employés
                $req = mysqli_query($con, "SELECT * FROM produits");
                if (mysqli_num_rows($req) == 0) {
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore de produit ajouter !";
                } else {
                    //si non , affichons la liste de tous les employés
                    while ($row = mysqli_fetch_assoc($req)) {

                ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td id="image"><img class="img_principal" src="image/<?= $row['image'] ?>"></td>
                            <td><?= $row['description'] ?></td>
                            <td id="btn"><?= $row['prix'] ?></td>
                            <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                            <td id="btn"><a href="modifier.php?id=<?= $row['id'] ?>"><img src="images/pen.png"></a></td>
                            <td id="btn"><a href="delete.php?id=<?= $row['id'] ?>"><img src="images/trash.png"></a></td>
                        </tr>
                <?php
                    }
                }
                ?>


            </table>
        </div>
    </div>

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
    <script src="app.js"></script>
</body>

</html>