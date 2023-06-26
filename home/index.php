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
    <title>Annonces </title>
    <style>
        cadre {
            background-color: rgba(255, 255, 255, 0.5); /* couleur de fond semi-transparente */
            opacity: 0.5; /* opacité du cadre */
            }

        
    </style>
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
       
    </nav>
    <section>
        <div id="courses" class="courses">
            <div class="spacial-head">
                <span>Nos Annonces </span>
            </div>
            <div class="container">
    
    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "car-bd-beta");

    // Vérification de la connexion
    if ($mysqli->connect_errno) {
        echo "Echec de la connexion MySQL: " . $mysqli->connect_error;
        exit(-1);
    }

   /* // Requête SQL pour récupérer toutes les annonces de vente de voiture
    $requete = "SELECT * FROM voiture v INNER JOIN modele m ON v.IdModele = m.IdModele INNER JOIN images i ON v.IdVoiture = i.IdVoiture INNER JOIN marque mrq ON v.IdMarque = mrq.IdMarque";

    // Exécution de la requête
    $resultat = $mysqli->query($requete);

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
    }*/
    $requete = "SELECT * from voiture";
    // Exécution de la requête
    $resultat = $mysqli->query($requete);

    // Vérification du nombre de résultats
    if ($resultat->num_rows == 0) {
        echo "base de donnees vide ";
    } else {
        
        // Parcourir les résultats et afficher chaque annonce dans un cadre
        while ($voiture = $resultat->fetch_assoc()) {
            
            $requete1 = "SELECT * from marque";
            // Exécution de la requête
            $resultat1 = $mysqli->query($requete1);
            
            // Vérification du nombre de résultats
            if ($resultat1->num_rows == 0) {
                echo "Aucun résultat trouvé.";
               
            } else {               
                // Parcourir les résultats et afficher chaque annonce dans un cadre
                while ($marque = $resultat1->fetch_assoc()) {

                    $requete3 = "SELECT * from modele";
                    // Exécution de la requête
                    $resultat3 = $mysqli->query($requete3);

                    // Vérification du nombre de résultats
                    if ($resultat3->num_rows == 0) {
                        die('Aucune marque trouve dans la base de donnees:' . mysqli_error($mysqli));
                        
                    } else {
                        // Parcourir les résultats et afficher chaque annonce dans un cadre
                        while ($modele = $resultat3->fetch_assoc()) {
                            
                           // echo 'test: IdModele, IdModele de voiture, IdVoiture, marque'.$modele['IdModele']  .$voiture['IdModele'] , $marque['IdMarque'] == $voiture['IdModele'];
                                if($modele['IdModele'] == $voiture['IdModele'] and $marque['IdMarque'] == $voiture['IdMarque']  )
                                {
                                    $requ = "select valide from voiture, documentdevalidation where voiture.docValid=documentdevalidation.IdDoc and IdVoiture='".$voiture['IdVoiture']."'";
                                    // Exécution de la requête
                                    $resul= $mysqli->query($requ);
                
                                    // Vérification du nombre de résultats
                                    if ($resul->num_rows == 0) {
                                        die("Il y eu un probleme");
                                    } else {
                                        $valide = $resul->fetch_assoc();
                                        if($valide['valide']==1 or $valide['valide']==true){

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
                                                   // echo ' <img src="' .$img['url']. '" alt="back-img"> ';     }         
                                                
                                                ?>
                                                    <div class="img_<?php echo $voiture['IdVoiture']?>" style = "width: 500px;
                                                                    height: 300px;
                                                                    background-image: url('<?php echo $img['url']?>');
                                                                    background-size: cover;
                                                                    transition: background-image 4s ease-in-out;"></div>
                                                </div><script>
                                                    const image_<?php echo $voiture['IdVoiture']?>s = [<?php while ($im = $resultat4->fetch_assoc()) {
                                                        echo "\"" . $im['url']. "\", ";
                                                    }?> ];
                                                    let index_<?php echo $voiture['IdVoiture']?>  = 0;

                                                    setInterval(() => {
                                                    const container = document.querySelector('.img_<?php echo $voiture['IdVoiture']?>');
                                                    container.style.backgroundImage = `url(${image_<?php echo $voiture['IdVoiture']; }?>s[index_<?php echo $voiture['IdVoiture']?>]})`;
                                                    
                                                    index_<?php echo $voiture['IdVoiture']?> ++;
                                                    if (index_<?php echo $voiture['IdVoiture']?> === image_<?php echo $voiture['IdVoiture']?>s.length) {
                                                        index_<?php echo $voiture['IdVoiture']?> = 0;
                                                    }
                                                    }, 5000);

                                                    
                                                
                                                </script>
                                                <span class="name-course"><?php echo $voiture['nomVoiture']?></span>
                                                <p class="course-disc">Modele: <?php  echo $modele['NomModele']?></p>
                                                <p class="course-disc">Puissance: <?php  echo  $modele['Puissance']; 
                                                
                                                $num = 0;
                                                $sq = "SELECT fournisseur.numeroTel FROM fournisseur, annonce, voiture WHERE annonce.IdVoiture='" . $voiture['IdVoiture'] . "' and annonce.IdFournisseur=fournisseur.IdFournisseur";
                                                $rest = mysqli_query($connexion, $sq);
                                                if(mysqli_num_rows($rest)>0){
                                                    while ($element = mysqli_fetch_assoc($rest)){
                                                        $num = $element["numeroTel"];
                                                            }	}
                                                    else{ die("Selection de l'id de l'admin echouee: ". mysqli_error($connexion)); }

                                                ?>hp</p>
                                                <li class="course-disc"><a href="tel:<?php  echo $num?>">Fournisseur: <i class="fa fa-phone"></i></a> <?php  echo $num?></li>
                                                <?php 
                                                        $requete5 = "select IdFournisseur FROM annonce WHERE IdVoiture='". $voiture['IdVoiture'] ."'";
                                                        $resultat5 = $mysqli->query($requete5);
                                                        
                                                        $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
                                                        $resultat6 = $mysqli->query($requete6);
                                                        
                                                        $id_createur = $resultat5->fetch_assoc();
                                                        $id_connecte = $resultat6->fetch_assoc();
                                                        //echo "id_createur=" . $id_createur['IdFournisseur'];
                                                    // echo "id_connecte=" . $id_connecte['IdFournisseur'];


                                                                if ($id_connecte['IdFournisseur'] == $id_createur['IdFournisseur'] ) {
                                                                    echo "<a class='btn status pending' href='detail.php?IdVoiture=" . $voiture['IdVoiture'] . "'>modifier</a>";
                                                                    echo "<a class=' btn status rejected' href=\"./delete.php?IdVoiture=" . $voiture['IdVoiture'] . "\">supprimer</a>";
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
                                        else {
                                            
                                            ?>
                                             <div class="card course-box cadre">
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
                                                   // echo ' <img src="' .$img['url']. '" alt="back-img"> ';     }         
                                                
                                                ?>
                                                    <div class="img_<?php echo $voiture['IdVoiture']?>" style = "width: 500px;
                                                                    height: 300px;
                                                                    background-image: url('<?php echo $img['url']?>');
                                                                    background-size: cover;
                                                                    transition: background-image 2.2s ease-in-out;"></div>
                                                </div><script>
                                                    const image_<?php echo $voiture['IdVoiture']?>s = [<?php while ($im = $resultat4->fetch_assoc()) {
                                                        echo "\"" . $im['url']. "\", ";
                                                    }?> ];
                                                    let index_<?php echo $voiture['IdVoiture']?> = 0;

                                                    setInterval(() => {
                                                    const container = document.querySelector('.img_<?php echo $voiture['IdVoiture']?>');
                                                    container.style.backgroundImage = `url(${image_<?php echo $voiture['IdVoiture']; }?>s[index_<?php echo $voiture['IdVoiture']?>]})`;
                                                    
                                                    index_<?php echo $voiture['IdVoiture']?> ++;
                                                    if (index_<?php echo $voiture['IdVoiture']?> === image_<?php echo $voiture['IdVoiture']?>s.length) {
                                                        index_<?php echo $voiture['IdVoiture']?> = 0;
                                                    }
                                                    }, 3000);

                                                </script>

                                                <span class="name-course"><?php echo $voiture['nomVoiture']?><div style=" color:red;">(Pas encore validé la source)</div></span>
                                                <p class="course-disc">Modele: <?php  echo $modele['NomModele']?></p>
                                                <p class="course-disc">Puissance: <?php  echo  $modele['Puissance']; 
                                                
                                                $num = 0;
                                                $sq = "SELECT fournisseur.numeroTel FROM fournisseur, annonce, voiture WHERE annonce.IdVoiture='" . $voiture['IdVoiture'] . "' and annonce.IdFournisseur=fournisseur.IdFournisseur";
                                                $rest = mysqli_query($connexion, $sq);
                                                if(mysqli_num_rows($rest)>0){
                                                    while ($element = mysqli_fetch_assoc($rest)){
                                                        $num = $element["numeroTel"];
                                                            }	}
                                                    else{ die("Selection numero de telephone  echouee: ". mysqli_error($connexion)); }

                                                ?>hp</p>
                                                <li class="course-disc"><a href="tel:<?php  echo $num?>">Fournisseur: <i class="fa fa-phone"></i></a> <?php  echo $num?></li>
                                                <?php 
                                                        $requete5 = "select IdFournisseur FROM annonce WHERE IdVoiture='". $voiture['IdVoiture'] ."'";
                                                        $resultat5 = $mysqli->query($requete5);
                                                        
                                                        
                                                        $requete6 = "select IdFournisseur from fournisseur where fournisseur.loginAdmin='" . $_SESSION['login'] . "'";
                                                        $resultat6 = $mysqli->query($requete6);
                                                        
                                                        $id_createur = $resultat5->fetch_assoc();
                                                        $id_connecte = $resultat6->fetch_assoc();
                                                        //echo "id_createur=" . $id_createur['IdFournisseur'];
                                                    // echo "id_connecte=" . $id_connecte['IdFournisseur'];


                                                                if ($id_connecte['IdFournisseur'] == $id_createur['IdFournisseur'] ) {
                                                        
                                                                    
                                                                    echo "<a class='btn status pending' href='update.php?IdVoiture=" . $voiture['IdVoiture'] . "'>modifier</a>";
                                                                    echo "<a class=' btn status rejected' href=\"./delete.php?IdVoiture=" . $voiture['IdVoiture'] . "\">supprimer</a>";
                                                                }
                                                echo "<a class='btn status in-prog' href='#'>Détails</a>";
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
    var url = "http://localhost/buy-your-car-beta/home/search.php"+ '?marque=' + marqueSelectionnee;

    window.location.href = url;
});

document.getElementById('search-form').addEventListener('submit', function(event) {


    var chaine = document.getElementById('q').value;
    if (chaine.trim() == "" ) {
        
        event.preventDefault(); // Empêche la soumission du formulaire
    }

});

        const cadre = document.querySelector('.cadre').style.opacity = '0.5'; // change l'opacité à 50%
        

    

    </script>
</body>
</html>
