<?php
include "admin/conn-bdd.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <style>
        nav ul li a.nav-link#link2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 900;
            line-height: 22px;
            color: #1C8C74;
            transition: color 0.2s ease-in-out;
        }
    </style>
    <title>shop</title>
</head>

<body>
    <header>
        <?php
        include "header.php";
        ?>
    </header>
    <div class="containeur" id="ct1">
        <div class="row1">
            <div class="col-md-12">
                <h1><span class="h">Shop</span><br><span class="p">MyTech Mada</span></h1>
                <p>Du matériel fiable et performant est exigé</p>
                <form action="resultat.php" method="get">
                    <input type="text" name="cherche" id="cherche" placeholder="Entrer le nom d'un produit">
                    <button type="submit" name="button"> <i class="fa-solid fa-magnifying-glass"></i></button>
                    <p style="color:red">
                        <?php
                        // si la variable message existe , affichons son contenu
                        if (isset($erreur)) {
                            echo $erreur;
                        }
                        ?>

                    </p>
                </form>
            </div>
        </div>
    </div>
    <div class="parent">
        <i class="fa-solid fa-chevron-left" id="left"></i>
        <div class="scrollmenu" id="scrollable">
            <?php
            //afficher la liste des photos qui sont dans la base de donnée
            $req = mysqli_query($con, "SELECT * FROM categorie");

            //verifier que la liste n'est pas vide
            if (mysqli_num_rows($req) < 1) {
            ?>
                <p class="vide_message">La liste est vide.</p>
            <?php
            }

            //afficher la liste des photos
            while ($row = mysqli_fetch_assoc($req)) {
            ?>
                <li> <a href="listecategorie.php?id=<?= $row['id'] ?>"><?= $row['nom'] ?></a></li>
            <?php
            }
            ?>
        </div>
        <i class="fa-solid fa-chevron-right" id="right"></i>
    </div>
    <div class="container" id="gamme">
        <div class="row">
            <section class="section">
                <?php
                //inclure la page de connexion
                //afficher la liste des photos qui sont dans la base de donnée
                $req = mysqli_query($con, "SELECT * FROM produits");

                //verifier que la liste n'est pas vide
                if (mysqli_num_rows($req) < 1) {
                ?>
                    <p class="vide_message">Cette section est vide</p>
                <?php
                }

                //afficher la liste des photos
                while ($row = mysqli_fetch_assoc($req)) {
                ?>
                    <div class="box">
                        <div class="image">
                            <img class="img_principal" src="admin/image/<?= $row['image'] ?>">
                        </div>
                        <div class="description">

                            <p>
                                <?php
                                echo $row['description']
                                ?>
                            </p>

                        </div>
                        <div class="prix">

                            <p id="prix">
                                <?= $row['prix'] ?>
                            </p>

                            <p class="plus"><a href="detail.php?id=<?= $row['id'] ?>">Voir plus</a></p>

                        </div>
                    </div>
                <?php
                }
                ?>

            </section>
        </div>


        <footer>
            <?php
            include "footer.php";
            ?>
        </footer>

        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script>
            $('#right').click(function() {
                $('#scrollable').animate({
                    scrollLeft: '+=200'
                }, 800);
            });

            $('#left').click(function() {
                $('#scrollable').animate({
                    scrollLeft: '-=200'
                }, 800);
            });
        </script>
</body>

</html>