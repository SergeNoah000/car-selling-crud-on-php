


<?php
session_start();
require_once('./database/connect-bd.php');



// Récupérer l'identifiant de l'annonce à afficher
$id_voiture = mysqli_real_escape_string($connexion, $_GET["IdVoiture"]);

// Récupérer les informations de l'annonce dans la base de données
$sql = "SELECT *
FROM annonce a
INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
INNER JOIN modele m ON v.IdModele = m.IdModele
INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
INNER JOIN fournisseur f ON f.IdFournisseur= a.IdFournisseur
WHERE v.IdVoiture = '".$id_voiture . "'";
$result = mysqli_query($connexion, $sql);

if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
    $sql_imgs = "SELECT * FROM img WHERE IdVoiture='" . $row['IdVoiture'] . "'";
	$result_imgs = mysqli_query($connexion, $sql_imgs);

	
    echo '

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="this is template with css and html for more information in last languages" />
    <link rel="stylesheet" href="../style/normalize.css" />
    <link rel="stylesheet" href="../style/all.min.css" />
    <link rel="stylesheet" href="../style/main.css" />
    <title>info_annonces</title>
</head>

<body>
    <header>
        <form>
            <fieldset>
                <i class="fa fa-search"></i>
                <input type="search" name="searchHead" placeholder="search keyword" />
            </fieldset>
        </form>
        <div class="user-notification">
            <div class="">
            ';
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
            }
            echo '</div>
            <div class="user-img">
                <img src="../imges/avatar.png" alt="user-img" width="50"/>
           
            </div>
        </div>
    </header>
    <nav class="navbar-left">
        <div class="head-logo">S. Y. Car</div>
        
    </nav>
    <section>
<div class="plans">
    <div class="spacial-head">
        <span>Informations</span>
    </div>
    <div class="container">
        <div class="card plan-box free">
        ';
                if(mysqli_num_rows($result_imgs) > 0) {
                    echo '<div class="col-50">';
                    $row_img = mysqli_fetch_assoc($result_imgs);
                    echo '<div class="head-plan">
                              <img src="'.
                  $row_img['url'].'" alt="user-img" width="500"/>
                        </div>';
                }
                echo '
            <ul class="list-choice">
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Nom du véhicule: '.$row["nomVoiture"].' </span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Modéle: '. $row["NomModele"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Marque:  '.$row["nom"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Prix:  '.$row["prix"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Puissance:  '.$row["Puissance"].'hp</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Couleur: '. $row["couleur"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Année de fabrication:  '. $row["DateFabrication"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Immatriculation:  '.$row["IdVoiture"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Nom du proprietaire: '. $row["PrenomFournisseur"] .$row["nomFournisseur"].'</span>
                    <i class="fa fa-info-circle"></i>
                </li>
                <li>
                    <i class="fa fa-check check"></i>
                    <span>Description: '. $row["description"].'
                    <i class="fa fa-info-circle"></i>
                </li>
            </ul>
            <div class="newbt">
            ';
            if(isset($_SESSION['login'])){
            $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
            $resultat6 = mysqli_query($connexion, $requete6);
            $resul = mysqli_fetch_assoc($resultat6);
            //echo 'IdFournisseur'. $row['IdFournisseur'] . 'Id createur' . $resul['IdFournisseur'].  $_SESSION['login'];
            if($row['IdFournisseur'] == $resul['IdFournisseur']){
                echo '
                    <div class="newbt1">
                    <a href="./update.php?id='. $row['IdVoiture'].'" style="background-color: #ffd500; color: rgb(255, 255, 255);box-sizing: border-box;font-family: \'Rubik\', sans-serif;line-height: 1.15;  font-size: 15px;border-radius: 3px; margin-right: auto;  padding: 5px 10px; ">Modifier</a>
                    <a href="./delete.php?IdVoiture='. $row['IdVoiture'].'" style="background-color: #ff0022; color: rgb(255, 255, 255);box-sizing: border-box;font-family: \'Rubik\', sans-serif;line-height: 1.15;  font-size: 15px;border-radius: 3px; margin-right: auto;  padding: 5px 10px; ">Supprimer</a>
                </div>';
            }
            else {
                echo '<a href="#" class="btn plan-btn">Commander</a>';
            }}
            echo '
        </div>
    </div>
        
    </div>
</div>
</section>
</body>

</html>';

}
else {
    echo "UNe erreur s'est produite au niveau de la requete sql";
}?>