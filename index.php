<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <title>Accueil</title>
</head>

<body>
    <header>
        <?php
        include "header.php";
        ?>
    </header>
    <div class="load">
        <p><i class="fa fa-spinner fa-7x fa-pulse"></i></p>
    </div>
    <div class="containeur" id="ct1">
        <div class="row" id="row1">
            <div class="col-lg-7" id="lg7">
                <h1 class="titre"><span class="h3">MyTech</span><br><span class="h1">MADAGASCAR</span></h1>
                <p class="p">Le monde de demain est déjà arrivé, c’est aujourd’hui. <br> N’attendons pas demain si l’on peut agir et interagir <br> maintenant.</p>
                <p class="gamme"><a href="shop.php">Nos gamme</a></p>
            </div>
        </div>
    </div>
    <div class="containeur anime" id="ct2">
        <div class="row" id="row2">
            <div class="col-lg-3" id="lg3">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>Laptop</h1>
            </div>
            <div class="col-lg-3" id="lg3_3">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>imprimantes</h1>
            </div>
            <div class="col-lg-6" id="lg6">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>Laptop</h1>
            </div>
        </div>
    </div>
    <div class="containeur anime" id="ct3">
        <div class="row" id="row3">
            <div class="col-lg-6" id="lg6">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>Desktop</h1>
            </div>
            <div class="col-lg-3" id="lg3_3">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>imprimantes</h1>
            </div>
            <div class="col-lg-3" id="lg3">
                <p><span class="p">Profitez de nos gammes</span><span class="h">de produits</span></p>
                <h1>Desktop</h1>
            </div>
        </div>
    </div>
    <div class="container" id="ct4">
        <div class="row">
            <div class="col-lg-12">
                <h1>Produits les plus vendus</h1>
                <p>Lorem ipsum dolor sit amet consectetur. Nulla venenatis id morbi massa <br> mauris enim id urna nibh. Dui nisl ut ornare nulla nibh id.</p>
            </div>
        </div>
    </div>
    <div class="container" id="gamme">
        <!-- <div class="row"> -->
        <section class="section">
            <?php
            //inclure la page de connexion
            include "admin/conn-bdd.php";
            //afficher la liste des photos qui sont dans la base de donnée
            $req = mysqli_query($con, "SELECT * FROM vendu");

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

                        <p>
                            <?= $row['prix'] ?>
                        </p>

                    </div>
                </div>
            <?php
            }
            ?>

        </section>
    </div>
    <div class="containeur" id="ct7">
        <img src="assets/images/AcceuilIMG/pngwing 9.png" alt="image">
        <div class="row">
            <div class="col-lg-6" id="lg6">
                <h1>Mytech <br> Mada</h1>
            </div>
            <div class="col-lg-6" id="lg6_1">
                <h5>Ventes & Opérations</h5>
                <p>Vous découvrirez, chez nous, notre gamme de matériel informatique avec plusieurs références dans l’univers de l’informatique, l’imprimante, de l’image et de la téléphonie.</p>
            </div>
        </div>
    </div>
    <div class="container" id="ct8">
        <div class="row">
            <div class="col-lg-12">
                <h1>Nos marques</h1>
                <p>Lorem ipsum dolor sit amet consectetur. Nulla venenatis id morbi massa <br> mauris enim id urna nibh. Dui nisl ut ornare nulla nibh id.</p>
            </div>
        </div>
    </div>
    <div class="containeur" id="ct9">
        <div class="row">
            <div class="col-lg-12">
                <img src="assets/images/AcceuilIMG/image.png" alt="">
            </div>
        </div>
    </div>
    <footer>
        <?php
        include "footer.php";
        ?>
    </footer>
    <script>
        const loader = document.querySelector('.load');

        function Wloader() {
            window.addEventListener('load', () => {

                loader.classList.add('fin');

            })
        }
        Wloader();
    </script>
    <script src="animation.js"></script>
</body>

</html>