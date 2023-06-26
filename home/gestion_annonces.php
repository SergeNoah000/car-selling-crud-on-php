


<?php
session_start();
require_once('./database/connect-bd.php');

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['admin'])) {
	header('Location: ./login.php');
}

// Récupérer l'identifiant de l'annonce à afficher

// Récupérer les informations de l'annonce dans la base de données
$sql = "SELECT *
FROM annonce a
INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
INNER JOIN modele m ON v.IdModele = m.IdModele
INNER JOIN documentdevalidation doc  ON doc.IdDoc = v.docValid
INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
INNER JOIN fournisseur f ON f.IdFournisseur= a.IdFournisseur";
$result = mysqli_query($connexion, $sql);/* 
 */
if(mysqli_num_rows($result) > 0) {

    $num_rows = mysqli_num_rows($result);
  


        
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
                        <a class="btn2" href="./index.php">Accueil  </a>\'

                            <div class="user-img">
                                <img src="../imges/avatar.png" alt="user-img" width="50"/>
                            </div>
                        </div>
                    </header>
                    <nav class="navbar-left">
                        <div class="head-logo"> <a href"./index.php">S. Y. Car </a> </div>
                        
                    </nav>
                    <section>
                <div class="plans">
                    <div class="spacial-head">
                        <span>Informations</span>
                    </div>
                    <div class="container">';
                    for($i = 0; $i < $num_rows; $i++) {
                        $row = mysqli_fetch_assoc($result);
                        $sql_imgs = "SELECT * FROM img WHERE IdVoiture='" . $row['IdVoiture'] . "'";
                        $result_imgs = mysqli_query($connexion, $sql_imgs);

                        echo '<div class="card plan-box free">';
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
                        <span>Nom du proprietaire: '. $row["PrenomFournisseur"].' ' .$row["nomFournisseur"].'</span>
                        <i class="fa fa-info-circle"></i>
                    </li>
                    <li>
                        <i class="fa fa-check check"></i>
                        <span>Description: '. $row["description"].'
                        <i class="fa fa-info-circle"></i>
                    </li>
                </ul>';

        echo '<div class="head-plan">
                            <img src="'.
                $row['urld'].'" alt="user-img" width="500"/>
                    </div>';
        echo '<div class="newbt">
                
                        <div class="newbt1">
                        <a href="./delete.php?IdVoiture='.$row['IdVoiture'].'" style="margin-top:20px; background-color: #ff0022; color: rgb(255, 255, 255);box-sizing: border-box;font-family: \'Rubik\', sans-serif;line-height: 1.15;  font-size: 15px;border-radius: 3px; margin-right: auto;  padding: 5px 10px; ">Supprimer</a>';
        if ($row['valide']==0 or $row['valide']==false) {
        echo '<a id = "validate" href="./validate.php?IdVoiture='.$row['IdVoiture'].'" style="margin-top:20px; background-color: rgba(37, 245, 210, 0.823); color: rgb(255, 255, 255);box-sizing: border-box;font-family: \'Rubik\', sans-serif;line-height: 1.15;  font-size: 15px;border-radius: 3px; margin-right: -100%;  padding: 5px 15px; ">valider</a>';
            
        }

    
        echo '
                        
                                </div>
                        </div>
                    </div>
                    
                    <br>
                    <hr style="height: 35px; opacity:0.3; background-color: black;">
                        ';
                    }
                    echo '
                    </div>
                </div>
                </section>
                <script>
                    document.getElementById(\'validate\').addEventListener(\'click\', function(event) {
                        let confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");

                        if (confirmation) {
                        // code exécuté si l\'utilisateur clique sur "OK"
                        window.location.href = "http://localhost/buy-your-car/home/validate.php?IdVoiture=' . $row['IdVoiture'] . '
                        } else {
                        // code exécuté si l\'utilisateur clique sur "Annuler"
                        event.preventDefault(); // Empêche la soumission du formulaire

                        }

                    });


                    // Ajouter un gestionnaire d\'événement lors de la sélection d\'une marque
                    document.getElementById(\'marque1\').addEventListener(\'change\', function() {


                    var marqueSelectionnee = document.getElementById(\'marque1\').value;
                    var url = "http://localhost/buy-your-car/home/search.php"+ \'?marque=\' + marqueSelectionnee;

                    window.location.href = url;
                    });

                    document.getElementById(\'search-form\').addEventListener(\'submit\', function(event) {


                    var chaine = document.getElementById(\'q\').value;
                    if (chaine.trim() == "" ) {
                        
                        event.preventDefault(); // Empêche la soumission du formulaire
                    }

                    });


                </script>
                </body>


                </html>';


   
}
else {
    
?>
echo '<script>alert("Nombres de ligne retourne par la requete: '.mysqli_num_rows($result).'")</script>';

   
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
        <title>Annonces </title>
    </head>

    <body>
        <header>
            <form id="search-form" action = "./search.php">
                <fieldset>
                    <i class="fa fa-search"></i>
                    <input type="search" id="q" name="q" placeholder="search keyword" />
                </fieldset>

            </form>

            <form id="marque11" action = "./search.php" method="post">
            <label for="marque1">Marque:</label><br>
            <select id="marque1" name="marque">
                <option value="">--Choisir une marque--</option>
                <?php 
                
                    require_once("./database/connect-bd.php");
                    $sql = "SELECT nom from marque where 1;";

                    $result = mysqli_query($connexion, $sql );
                    if(mysqli_num_rows($result)>0){
                        while ($element = mysqli_fetch_assoc($result)){
                            echo '<option value="' . $element["nom"].  '">' . $element["nom"]. '</option>';
                        }	}
                ?>
            </select>
            </form>
            <?php 
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'] .':Connecte';
                }
                if (isset($_SESSION['admin'])) {
                    echo '(admin)';
                    echo ' <a class="btn2" href="./admin.php">Dashbord  </a>';


                }
                
        
        if (isset($_SESSION['valid'] )) {
            echo ' <div class="userbtn">';
            echo ' <a class="btn2" href="./creation.php">Ajouter  </a>';
            echo ' <a class="btn1" href="./logout.php">Deconnexion </a>';
            echo ' </div>';
        
        }
        else {
            echo ' <div class="userbtn">
            <a href="./login.php" class="btn1">Se connecter</a>
            <a href="./register.php" class="btn2">S\'incrire</a>
        </div>';
        }?>
            
        </header>
        <nav class="navbar-left">
            <div class="head-logo"> <a href="./index.php">S. Y. Car </a> </div>
            <div class="es">
            <p class="tpr">Vendez votre</p> 
            <p class="tpr">voiture en un </p> 
            <p class="tpr">clic juste en  </p>
            <p class="tpr">s'incrivant sur </p>
            <p class="tpr">cette Application</p>
        </div>
        
        </nav><?php }?>`