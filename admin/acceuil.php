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

if (isset($_POST['Enregistrer'])) {

  extract($_POST);

  $text = $_POST['text'];

  if ($text != "") {

    $req = mysqli_query($con, "SELECT * FROM categorie WHERE nom = '$text'");
    if (mysqli_num_rows($req) == 0) {

      $req = mysqli_query($con, "INSERT INTO categorie VALUES (NULL, '$text') ");
      if ($req) {
        header("location:acceuil.php");
      }
    } else {
      $message = "ce nom est déjà dans la base de donné";
    }
  } else {
    $message = " le champs est vide";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/fonts/fontawesome-free-6.2.1-web/css/all.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    ul li#categorie1 {
      background: #396AFF;
    }
  </style>
  <title><?= $user ?></title>
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
  <form action="" method="post">
    <input type="text" name="text" id="text" placeholder="Votre categorie">
    <input type="submit" value="+ ajouter" name="Enregistrer">
  </form>
  <h1>Liste des categories</h1>
  <table>
    <tr id="items">
      <th id="N">N°</th>
      <th>categorie</th>
      <!-- <th>Modifier</th> -->
      <th>Supprimer</th>
    </tr>
    <?php
    //inclure la page de connexion
    include "conn-bdd.php";
    //requête pour afficher la liste des employés
    $req = mysqli_query($con, "SELECT * FROM categorie");
    if (mysqli_num_rows($req) == 0) {
      //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
      echo "Il n'y a pas encore de categorie ajouter !";
    } else {
      //si non , affichons la liste de tous les employés
      while ($row = mysqli_fetch_assoc($req)) {

    ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['nom'] ?></td>
          <!--Nous alons mettre l'id de chaque employé dans ce lien -->
          <!-- <td id="btn"><a href="modifier.php?id=<?= $row['id'] ?>"><img src="images/pen.png"></a></td> -->
          <td id="btn"><a href="deletecategorie.php?id=<?= $row['id'] ?>"><img src="images/trash.png"></a></td>
        </tr>
    <?php
      }
    }
    ?>


  </table>
</body>

</html>