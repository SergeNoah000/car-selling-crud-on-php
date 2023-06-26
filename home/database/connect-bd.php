<?php $serveur = "localhost";
$username = "root";
$password = "";
$nom_base_de_données = "car-bd-beta";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $username, $password, $nom_base_de_données);

// Vérification de la connexion
if (!$connexion) {
die("La connexion a échoué: " . mysqli_connect_error());
}
?>

