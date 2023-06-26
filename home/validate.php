<?php
session_start();
if (!isset($_SESSION['admin'] )) {
	header('Location: ./index.php');
}
require_once("./database/connect-bd.php");


if (isset($_GET["IdVoiture"])) {
    $id = mysqli_real_escape_string($connexion, $_GET['IdVoiture']);
    $sql = "update  documentdevalidation, voiture  set valide=1 where  IdVoiture='".$id."' and IdDoc=docValid";
	 //echo '<script>alert("requete sql pour delete annonce: '.$sql.'!!")</script>';
   $result1 = mysqli_query($connexion, $sql ) or die("Could not execute the delete query. ". $sql . " : " . mysqli_error($connexion));
   header("Location: ./gestion_annonces.php");
    
    
} else {
    echo '<script>alert("Une erreur est survenue, contactez l\'administrateur !!")</script>';
}

?>
