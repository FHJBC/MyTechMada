<?php
include "admin/conn-bdd.php";
$id = $_GET['id'];
//requête pour afficher les infos d'un employé
$req = mysqli_query($con, "SELECT * FROM produits WHERE id = $id");
$row = mysqli_fetch_assoc($req);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style6.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
    <title>Document</title>
</head>

<body>
    <header>
        <?php
        include "header.php";
        ?>
    </header>
    <div class="container" id="detail">
        <div class="row">
            <?php
            $req = mysqli_query($con, "SELECT * FROM produits WHERE id = $id");
            while ($row = mysqli_fetch_assoc($req)) {
            ?>
                <div class="col-md-7" id="text">
                    <h1>Description</h1>
                    <p>
                        <?php
                        echo $row['description']
                        ?>
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241599.21394161333!2d47.37242704066714!3d-18.887626047510334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21f07de34f1f4eb3%3A0xdf110608bcc082f9!2sTananarive!5e0!3m2!1sfr!2smg!4v1676879579714!5m2!1sfr!2smg" width="100%" height="auto" style="border:none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-5" id="image">
                    <img class="img_principal" src="admin/image/<?= $row['image'] ?>">
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="parent">
        <i class="fa-solid fa-chevron-left" id="left"></i>
        <div class="scrollmenu" id="scrollable">
            <li><img src="shopIMG/far1.png" alt="image"></li>
            <li><img src="shopIMG/far2.png" alt="image"></li>
            <li><img src="shopIMG/far3.png" alt="image"></li>
            <li><img src="shopIMG/far4.png" alt="image"></li>
        </div>
        <i class="fa-solid fa-chevron-right" id="right"></i>
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
            }, 400);
        });

        $('#left').click(function() {
            $('#scrollable').animate({
                scrollLeft: '-=200'
            }, 400);
        });
    </script>
</body>

</html>