<?php session_start(); 
error_reporting(E_ERROR| E_PARSE);

?>
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
    <title>Annonces</title>
</head>

<body>
    <header>
        <form id="search-form">
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
        <div class="head-logo"> <a class="btn1" href="./index.php">S. Y. Car </a> </div>
        <div class="es">
        <p class="tpr">Vendez votre</p> 
        <p class="tpr">voiture en un </p> 
        <p class="tpr">clic juste en  </p>
        <p class="tpr">s'incrivant sur </p>
        <p class="tpr">cette Application</p>
    </div>
       
    </nav>
    <section>
        <div id="courses" class="courses">
            <div class="spacial-head">
                <span>Nos Annonces</span>
            </div>
            <div class="container">
    
    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "car-bd-beta");

    // Vérification de la connexion
    if ($mysqli->connect_errno) {
        echo "Echec de la connexion MySQL: " . $mysqli->connect_error;
        exit();
    }

    if (isset($_GET['marque'])) {
  

            $marqueId = $_GET['marque'];
            /* // Requête SQL pour récupérer toutes les annonces de vente de voiture
            // Récupérer la valeur de l'ID de la marque depuis le formulaire

            $sql = "SELECT *
                    FROM annonce a
                    INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
                    INNER JOIN modele m ON v.IdModele = m.IdModele
                    INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
                    INNER JOIN fournisseur f ON f.IdFournisseur = a.IdFournisseur
                    WHERE v.IdMarque = $marqueId";
            
            // Exécution de la requête
            $resultat = $mysqli->query($sql);
            
                // Vérification du nombre de résultats
                if ($resultat->num_rows == 0) {
                    echo "Aucun résultat trouvé.";
                } else {
                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                    while ($row = $resultat->fetch_assoc()) {
                        echo "<div class='cadre'>";
                        echo "<h2>" . $row['nomVoiture'] . "</h2>";
                        echo "<p>Modèle: " . $row['NomModele'] . "</p>";
                        echo "<p>Marque: " . $row['nomMarque'] . "</p>";
                        echo "<p>Prix: " . $row['prix'] . " €</p>";
                        echo "<p>Puissance: " . $row['Puissance'] . "</p>";
                        echo "<p>Carburateur: " . $row['reservoir'] . "</p>";
                        echo "<p>Couleur: " . $row['couleur'] . "</p>";
                        echo "<p>Date de fabrication: " . $row['DateFabrication'] . "</p>";
                        echo "<p>VIN: " . $row['vin'] . "</p>";
                        echo "<img src='data:image/" . $row['type_fichier'] . ";base64," . base64_encode($row['contenu_fichier']) . "' />";
                        echo "<p>Localisation: " . $row['Lieu'] . "</p>";
                        echo "<a href='detail.php?IdVoiture=" . $row['IdVoiture'] . "'>Détails</a>";
                        echo "</div>";
                    }
                }*/ $requete = "SELECT * from voiture";
                // Exécution de la requête
                $resultat = $mysqli->query($requete);

                // Vérification du nombre de résultats
                if ($resultat->num_rows == 0) {
                    echo "base de donne vide ";
                
                } else {
                    
                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                    while ($voiture = $resultat->fetch_assoc()) {
                        $requete1 = "SELECT * from marque where nom='".$marqueId."'";
                        //echo $requete1;
                        // Exécution de la requête
                        $resultat1 = $mysqli->query($requete1);
                        
                        // Vérification du nombre de résultats
                        if ($resultat1->num_rows == 0) {
                            echo "Aucun résultat marque trouvé.";
                        
                        } else {               
                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                            while ($marque = $resultat1->fetch_assoc()) {

                                $requete3 = "SELECT * from modele";
                                // Exécution de la requête
                                $resultat3 = $mysqli->query($requete3);

                                // Vérification du nombre de résultats
                                if ($resultat3->num_rows == 0) {
                                    echo "";
                                    
                                } else {
                                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                                    while ($modele = $resultat3->fetch_assoc()) {
                                        
                                    // echo 'test: IdModele, IdModele de voiture, IdVoiture, marque'.$modele['IdModele']  .$voiture['IdModele'] , $marque['IdMarque'] == $voiture['IdModele'];
                                            if($modele['IdModele'] == $voiture['IdModele'] and $marque['IdMarque'] == $voiture['IdMarque']  )
                                            {
            ?>
                            
                        
                                <div class="card course-box">
                                <div class="head-course">
                                    <?php
                                $requete4 = "SELECT * from img where img.IdVoiture='".$voiture['IdVoiture']."'";
                                // Exécution de la requête
                                $resultat4 = $mysqli->query($requete4);

                                // Vérification du nombre de résultats
                                if ($resultat4->num_rows == 0) {
                                    echo ' <img src="../imges/course-01.jpg" alt="back-img">';
                                } else {
                                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                                    $img = $resultat4->fetch_assoc();
                                    echo ' <img src="' .$img['url']. '" alt="back-img"> ';     }         
                                
                                ?>
                                    <img src="../imges/team-01.png" alt="teacher-img" />
                                </div>
                                <span class="name-course"><?php echo $voiture['nomVoiture']?></span>
                                <p class="course-disc">Modele: <?php  echo $modele['NomModele']?></p>
                                <p class="course-disc">Puissance: <?php  echo  $modele['Puissance']?>hp</p>
                                <li class="course-disc"><a href="tel:+00000000000">Fournisseur: <i class="fa fa-phone"></i></a> <?php  echo "565656565"?></li>
                                <?php 
                                        $requete5 = "select IdFournisseur FROM annonce WHERE IdVoiture='". $voiture['IdVoiture'] ."'";
                                        $resultat5 = $mysqli->query($requete5);
                                        
                                        $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
                                        $resultat6 = $mysqli->query($requete6);
                                        
                                        $id_createur = $resultat5->fetch_assoc();
                                        $id_connecte = $resultat6->fetch_assoc();
                                        //echo "id_createur=" . $id_createur['IdFournisseur'];
                                    // echo "id_connecte=" . $id_connecte['IdFournisseur'];


                                                if ($id_connecte != $id_createur) {
                                                } else {
                                                    
                                                    echo "<a class='btn status pending'href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>modifier</a>";
                                                    echo "<a class=' btn status rejected'href='delete.php?IdVoiture=" . $voiture['IdVoiture'] . "'>supprimer</a>";
                                                }
                                echo "<a class='btn status in-prog' href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>Détails</a>";
                                ?>
                                <ul class="info-course">
                                    <li class="watched-user"> <?php  echo $marque['nom']?></li>
                                    <li>$  <?php  echo $modele['prix'] ?></li>
                                </ul>
                            </div>
                            <?php
                        }
                }
            }
            }
            }
            }
            }
        }
        elseif(isset($_GET['q'])) {
            
            $q = $_GET['q'];
            /* // Requête SQL pour récupérer toutes les annonces de vente de voiture
            // Récupérer la valeur de l'ID de la marque depuis le formulaire

            $sql = "SELECT *
                    FROM annonce a
                    INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
                    INNER JOIN modele m ON v.IdModele = m.IdModele
                    INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
                    INNER JOIN fournisseur f ON f.IdFournisseur = a.IdFournisseur
                    WHERE v.IdMarque = $marqueId";
            
            // Exécution de la requête
            $resultat = $mysqli->query($sql);
            
                // Vérification du nombre de résultats
                if ($resultat->num_rows == 0) {
                    echo "Aucun résultat trouvé.";
                } else {
                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                    while ($row = $resultat->fetch_assoc()) {
                        echo "<div class='cadre'>";
                        echo "<h2>" . $row['nomVoiture'] . "</h2>";
                        echo "<p>Modèle: " . $row['NomModele'] . "</p>";
                        echo "<p>Marque: " . $row['nomMarque'] . "</p>";
                        echo "<p>Prix: " . $row['prix'] . " €</p>";
                        echo "<p>Puissance: " . $row['Puissance'] . "</p>";
                        echo "<p>Carburateur: " . $row['reservoir'] . "</p>";
                        echo "<p>Couleur: " . $row['couleur'] . "</p>";
                        echo "<p>Date de fabrication: " . $row['DateFabrication'] . "</p>";
                        echo "<p>VIN: " . $row['vin'] . "</p>";
                        echo "<img src='data:image/" . $row['type_fichier'] . ";base64," . base64_encode($row['contenu_fichier']) . "' />";
                        echo "<p>Localisation: " . $row['Lieu'] . "</p>";
                        echo "<a href='detail.php?IdVoiture=" . $row['IdVoiture'] . "'>Détails</a>";
                        echo "</div>";
                    }
                }*/ $requete = "SELECT * from voiture where couleur like %". $q ."% or nomVoiture like %". $q ."% ";
                // Exécution de la requête
                $resultat = $mysqli->query($requete);

                // Vérification du nombre de résultats
                if ($resultat->num_rows == 0) {
                    //$marqueId = $_GET['marque'];
                    /* // Requête SQL pour récupérer toutes les annonces de vente de voiture
                    // Récupérer la valeur de l'ID de la marque depuis le formulaire
        
                    $sql = "SELECT *
                            FROM annonce a
                            INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
                            INNER JOIN modele m ON v.IdModele = m.IdModele
                            INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
                            INNER JOIN fournisseur f ON f.IdFournisseur = a.IdFournisseur
                            WHERE v.IdMarque = $marqueId";
                    
                    // Exécution de la requête
                    $resultat = $mysqli->query($sql);
                    
                        // Vérification du nombre de résultats
                        if ($resultat->num_rows == 0) {
                            echo "Aucun résultat trouvé.";
                        } else {
                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                            while ($row = $resultat->fetch_assoc()) {
                                echo "<div class='cadre'>";
                                echo "<h2>" . $row['nomVoiture'] . "</h2>";
                                echo "<p>Modèle: " . $row['NomModele'] . "</p>";
                                echo "<p>Marque: " . $row['nomMarque'] . "</p>";
                                echo "<p>Prix: " . $row['prix'] . " €</p>";
                                echo "<p>Puissance: " . $row['Puissance'] . "</p>";
                                echo "<p>Carburateur: " . $row['reservoir'] . "</p>";
                                echo "<p>Couleur: " . $row['couleur'] . "</p>";
                                echo "<p>Date de fabrication: " . $row['DateFabrication'] . "</p>";
                                echo "<p>VIN: " . $row['vin'] . "</p>";
                                echo "<img src='data:image/" . $row['type_fichier'] . ";base64," . base64_encode($row['contenu_fichier']) . "' />";
                                echo "<p>Localisation: " . $row['Lieu'] . "</p>";
                                echo "<a href='detail.php?IdVoiture=" . $row['IdVoiture'] . "'>Détails</a>";
                                echo "</div>";
                            }
                        }*/ $requete = "SELECT * from voiture";
                        // Exécution de la requête
                        $resultat = $mysqli->query($requete);
        
                        // Vérification du nombre de résultats
                        if ($resultat->num_rows == 0) {
                            echo "base de donne vide ";
                        
                        } else {
                            
                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                            while ($voiture = $resultat->fetch_assoc()) {
                                $requete1 = "SELECT * from marque";
                                //echo $requete1;
                                // Exécution de la requête
                                $resultat1 = $mysqli->query($requete1);
                                
                                // Vérification du nombre de résultats
                                if ($resultat1->num_rows == 0) {
                                    //echo "Aucun résultat marque trouvé.";
                                
                                } else {               
                                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                                    while ($marque = $resultat1->fetch_assoc()) {
        
                                        $requete3 = "SELECT * from modele where Puissance =".$q." or resevoir=".$q." or DateFabrication like $".$q."$ or Lieu like %".$q ."% or NomModele like $".$q ."$ or prix=".$q;
                                        // Exécution de la requête
                                        $resultat3 = $mysqli->query($requete3);
        
                                        // Vérification du nombre de résultats
                                        if ($resultat3->num_rows == 0) {
                                            echo "";
                                            
                                        } else {
                                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                                            while ($modele = $resultat3->fetch_assoc()) {
                                                
                                            // echo 'test: IdModele, IdModele de voiture, IdVoiture, marque'.$modele['IdModele']  .$voiture['IdModele'] , $marque['IdMarque'] == $voiture['IdModele'];
                                                    if($modele['IdModele'] == $voiture['IdModele'] and $marque['IdMarque'] == $voiture['IdMarque']  )
                                                    {
                    ?>
                                    
                                
                                        <div class="card course-box">
                                        <div class="head-course">
                                            <?php
                                        $requete4 = "SELECT * from img where img.IdVoiture='".$voiture['IdVoiture']."'";
                                        // Exécution de la requête
                                        $resultat4 = $mysqli->query($requete4);
        
                                        // Vérification du nombre de résultats
                                        if ($resultat4->num_rows == 0) {
                                            echo ' <img src="../imges/course-01.jpg" alt="back-img">';
                                        } else {
                                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                                            $img = $resultat4->fetch_assoc();
                                            echo ' <img src="' .$img['url']. '" alt="back-img"> ';     }         
                                        
                                        ?>
                                            <img src="../imges/team-01.png" alt="teacher-img" />
                                        </div>
                                        <span class="name-course"><?php echo $voiture['nomVoiture']?></span>
                                        <p class="course-disc">Modele: <?php  echo $modele['NomModele']?></p>
                                        <p class="course-disc">Puissance: <?php  echo  $modele['Puissance']?>hp</p>
                                        <li class="course-disc"><a href="tel:+00000000000">Fournisseur: <i class="fa fa-phone"></i></a> <?php  echo "565656565"?></li>
                                        <?php 
                                                $requete5 = "select IdFournisseur FROM annonce WHERE IdVoiture='". $voiture['IdVoiture'] ."'";
                                                $resultat5 = $mysqli->query($requete5);
                                                
                                                $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
                                                $resultat6 = $mysqli->query($requete6);
                                                
                                                $id_createur = $resultat5->fetch_assoc();
                                                $id_connecte = $resultat6->fetch_assoc();
                                                //echo "id_createur=" . $id_createur['IdFournisseur'];
                                            // echo "id_connecte=" . $id_connecte['IdFournisseur'];
        
        
                                                        if ($id_connecte != $id_createur) {
                                                        } else {
                                                            
                                                            echo "<a class='btn status pending'href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>modifier</a>";
                                                            echo "<a class=' btn status rejected'href='delete.php?IdVoiture=" . $voiture['IdVoiture'] . "'>supprimer</a>";
                                                        }
                                        echo "<a class='btn status in-prog' href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>Détails</a>";
                                        ?>
                                        <ul class="info-course">
                                            <li class="watched-user"> <?php  echo $marque['nom']?></li>
                                            <li>$  <?php  echo $modele['prix'] ?></li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                        }
                    }
                    }
                    }
                    }
                    }
                
                } else {
                    
                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                    while ($voiture = $resultat->fetch_assoc()) {
                        $requete1 = "SELECT * from marque ";
                        //echo $requete1;
                        // Exécution de la requête
                        $resultat1 = $mysqli->query($requete1);
                        
                        // Vérification du nombre de résultats
                        if ($resultat1->num_rows == 0) {
                            echo "Aucun résultat marque trouvé.";
                        
                        } else {               
                            // Parcourir les résultats et afficher chaque annonce dans un cadre
                            while ($marque = $resultat1->fetch_assoc()) {

                                $requete3 = "SELECT * from modele";
                                // Exécution de la requête
                                $resultat3 = $mysqli->query($requete3);

                                // Vérification du nombre de résultats
                                if ($resultat3->num_rows == 0) {
                                    echo "";
                                    
                                } else {
                                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                                    while ($modele = $resultat3->fetch_assoc()) {
                                        
                                    // echo 'test: IdModele, IdModele de voiture, IdVoiture, marque'.$modele['IdModele']  .$voiture['IdModele'] , $marque['IdMarque'] == $voiture['IdModele'];
                                            if($modele['IdModele'] == $voiture['IdModele'] and $marque['IdMarque'] == $voiture['IdMarque']  )
                                            {
            ?>
                            
                        
                                <div class="card course-box">
                                <div class="head-course">
                                    <?php
                                $requete4 = "SELECT * from img where img.IdVoiture='".$voiture['IdVoiture']."'";
                                // Exécution de la requête
                                $resultat4 = $mysqli->query($requete4);

                                // Vérification du nombre de résultats
                                if ($resultat4->num_rows == 0) {
                                    echo ' <img src="../imges/course-01.jpg" alt="back-img">';
                                } else {
                                    // Parcourir les résultats et afficher chaque annonce dans un cadre
                                    $img = $resultat4->fetch_assoc();
                                    echo ' <img src="' .$img['url']. '" alt="back-img"> ';     }         
                                
                                ?>
                                    <img src="../imges/team-01.png" alt="teacher-img" />
                                </div>
                                <span class="name-course"><?php echo $voiture['nomVoiture']?></span>
                                <p class="course-disc">Modele: <?php  echo $modele['NomModele']?></p>
                                <p class="course-disc">Puissance: <?php  echo  $modele['Puissance']?>hp</p>
                                <li class="course-disc"><a href="tel:+00000000000">Fournisseur: <i class="fa fa-phone"></i></a> <?php  echo "565656565"?></li>
                                <?php 
                                        $requete5 = "select IdFournisseur FROM annonce WHERE IdVoiture='". $voiture['IdVoiture'] ."'";
                                        $resultat5 = $mysqli->query($requete5);
                                        
                                        $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
                                        $resultat6 = $mysqli->query($requete6);
                                        
                                        $id_createur = $resultat5->fetch_assoc();
                                        $id_connecte = $resultat6->fetch_assoc();
                                        //echo "id_createur=" . $id_createur['IdFournisseur'];
                                    // echo "id_connecte=" . $id_connecte['IdFournisseur'];


                                                if ($id_connecte != $id_createur) {
                                                } else {
                                                    
                                                    echo "<a class='btn status pending'href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>modifier</a>";
                                                    echo "<a class=' btn status rejected'href='delete.php?IdVoiture=" . $voiture['IdVoiture'] . "'>supprimer</a>";
                                                }
                                echo "<a class='btn status in-prog' href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>Détails</a>";
                                ?>
                                <ul class="info-course">
                                    <li class="watched-user"> <?php  echo $marque['nom']?></li>
                                    <li>$  <?php  echo $modele['prix'] ?></li>
                                </ul>
                            </div>
                            <?php
                        }
                }
            }
            }
            }
            }
            }
            }
// Fermeture de la connexion à la base de données
$mysqli->close();
?>


        </div>
        </div>
    </section>

    <script>
        // Ajouter un gestionnaire d'événement lors de la sélection d'une marque
    document.getElementById('marque1').addEventListener('change', function() {
    

    var marqueSelectionnee = document.getElementById('marque1').value;
    var url = "http://localhost/buy-your-car/home/search.php"+ '?marque=' + marqueSelectionnee;

    window.location.href = url;
});


document.getElementById('search-form').addEventListener('submit', function(event) {


var chaine = document.getElementById('q').value;
if (chaine.trim() == "" ) {
    
    event.preventDefault(); // Empêche la soumission du formulaire
}

});

    

    </script>
</body>
</html>

