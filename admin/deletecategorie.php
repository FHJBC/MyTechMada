<?php
   //supprimer la photo
   //Récupérer l'ID dans le lien avec la methode GET
   $id = $_GET['id'];
   //inclure la page de connexion
   include "conn-bdd.php";
   //supprimer la photo qui a pour id $id
   $req = mysqli_query($con , "DELETE FROM categorie WHERE id = $id");
   //redirection vers la page liste.php
   header("location:acceuil.php");

?>