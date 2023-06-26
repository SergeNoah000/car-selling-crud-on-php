<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ./login.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulaire d'annonce de vente de voiture</title>
	<style>
		body {
			background-image: linear-gradient(to bottom, #00bfff 0%, #66ccff 100%);
			background-attachment: fixed;
			background-size: cover;
			animation: move_wave 20s linear infinite;
		}

		@keyframes move_wave {
			0% {
				background-position-x: 0px;
			}
			100% {
				background-position-x: 1366px;
			}
		}

		form {
			background-color: #ffffff;
			width: 50%;
			margin: auto;
			box-shadow: 5px 10px 18px #888888;
			padding: 20px;
			border-radius: 10px;
			font-family: Arial, sans-serif;
			margin-top: 50px;
		}

		h2{
			text-align: center; /* bonjour bonjour le centre */
		}

		input[type="text"], input[type="number"], input[type="date"], textarea {
			width: 100%;
			height: 30px;
			margin-bottom: 10px;
			border-radius: 3px;
			border: 1px solid #cccccc;
			padding-left: 5px;
			font-family: Arial, sans-serif;
			font-size: 16px;
		}

		select {
			width: 100%;
			height: 30px;
			margin-bottom: 10px;
			border-radius: 3px;
			border: 1px solid #cccccc;
			padding-left: 5px;
			font-family: Arial, sans-serif;
			font-size: 16px;
		}

		input[type="submit"] , button{
			background-color: #4CAF50;
			color: white;
			border-radius: 5px;
			padding: 10px  20px;
			margin: 30px  30px;
			border: none;
			cursor: pointer;
			font-size: 18px;
			margin-top: 10px;
		}

		input[type="submit"]:hover {
			background-color: rgba(202, 2, 106, 0.748);}

			button:hover {
			background-color: #3e8e41;
		}
        .col-50 {
						float: left;
						width: 50%;
						margin-top: 4px;
					}

					img {
						max-width: 100%;
						height: auto;
					}

					.image-item {
  display: inline-block;
  text-align: center;
}
.image-item img {
  max-width: 100px;
  max-height: 100px;
}

	</style>
</head>
<body>
<?php
// Connexion à la base de données
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "car-bd-beta";
    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Vérifier la connexion
    if (!$conn) {
        die("Connexion échouée : " . mysqli_connect_error());
    }


	
if(isset($_POST['id'])){
	$id =$_POST['id'];
	

	$i = 0;
	while($i < count($tab)) {
		$sq = "delete from img where id=". $id[$i];
		 mysqli_query($conn, $sq) or die("La requete de suppression a echoue: ".$sq . mysqli_error($conn));	
		$i++;
	}
}


    // Récupérer les informations du véhicule depuis la base de données
    $id = $_GET['id']; // ou tout autre méthode pour récupérer l'identifiant du véhicule à afficher
    $sql1 = "SELECT *
    FROM annonce a
    INNER JOIN voiture v ON a.IdVoiture = v.IdVoiture
    INNER JOIN modele m ON v.IdModele = m.IdModele
    INNER JOIN marque mr ON v.IdMarque = mr.IdMarque
    WHERE v.IdVoiture = '".$id . "'"; // modifier selon votre structure de table et vos colonnes
    $result = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nom_voiture = $row['nomVoiture'];
        $nom_modele = $row['NomModele'];
        $nom_marque = $row['nom'];
        $prix = $row['prix'];
        $puissance = $row['Puissance'];
        $reservoir = $row['reservoir'];
        $couleur = $row['couleur'];
        $annee_fabrication = $row['DateFabrication'];
        $description = $row['description'];
       // $transmission = $row['transmission'];
	  // echo "test". $couleur;

   ?>
	<form action="" method="post" enctype="multipart/form-data">
		<h2>Annonce de vente de voiture</h2>
		<label for="nom">Nom du véhicule:</label><br>
		<input type="text" id="nom" name="nom" value ="<?Php echo $nom_voiture ?>" required><br>

		<label for="modele">Modèle:</label><br>
		<input type="text" id="modele" name="modele" value ="<?Php echo $nom_modele ?>"require><br>
		

		<label for="marque">Marque:</label><br>
		<select id="marque" name="marque">
			<option value ="<?Php echo $nom_marque ?>" required>--Choisir une marque--</option>
			<?php 
			
				require_once("./database/connect-bd.php");
				$sql0 = "SELECT nom from marque where 1;";

				$result = mysqli_query($connexion, $sql0 );
				if(mysqli_num_rows($result)>0){
					while ($element = mysqli_fetch_assoc($result)){
						echo '<option value="' . $element["nom"].  '">' . $element["nom"]. '</option>';
					}	}
			?>
		</select><br>

		<label for="prix">Prix en USD:</label><br>
		<input type="number" id="prix" name="prix" value ="<?Php echo $prix ?>" required><br>

		<label for="puissance">Puissance en HP:</label><br>
		<input type="number" id="puissance" name="puissance" value ="<?Php echo $puissance ?>"><br>

		<label for="carburateur">Carburateur:</label><br>
		<input type="text" id="carburateur" name="carburateur" value ="<?Php echo $reservoir ?>" required><br>

		<label for="couleur">Couleur:</label><br>
		<input type="text" id="couleur" name="couleur" value ="<?Php echo $couleur ?> " required><br>

		<label for="annee">Année de fabrication:</label><br>
		<input type="date" id="annee" name="annee" value ="<?Php echo $annee_fabrication ?>"><br>

		<label for="vin">Numéro d'identification du véhicule (VIN):</label><br>
		<input type="text" id="vin" name="vin" value ="<?Php echo $id ?>" required	><br>

		<input type="hidden" id="IdModele" name="IdModele" value ="<?Php echo $row['IdModele'] ?>"><br>


		<label for="photos">Photos:<br>
        <?php 
            $sql_imgs = "SELECT * FROM img WHERE IdVoiture='" . $row['IdVoiture'] . "'";
	        $result_imgs = mysqli_query($connexion, $sql_imgs);
            if(mysqli_num_rows($result_imgs) > 0) {
                echo '
				Selectionnes les images que vous voulez supprimer et entrez d\'autre dans le champ d\'images pour les aujouter</label><div class="col-50">';
				echo '<div id="image-container">';
                    while($row_img = mysqli_fetch_assoc($result_imgs)) {
						
							echo '<div class="image-item">
								<input type="checkbox" name="'. $row_img['id'].'" value="'. $row_img['id'].'">';
								echo '<img src="' . $row_img['url'] . '" alt="' . $row["titre"] . '">' ;
							echo '</div>';
						

                    }
                echo '</div>
				<button onclick="deleteSelectedImages()">Supprimer les images sélectionnées</button>
				</div>';
            }
			else{
        ?><br><br><br><br><br><br><br><br>
		<input type="file" id="photos" name="photos[]" multiple  <?php echo 'required'; }?> ><br>

		<br><label for="lieu">Localisation:</label><br>
		<input type="text" id="lieu" name="lieu" value ="<?Php echo $row['Lieu'] ?>" required><br>

		<label for="lieu">Description:</label><br>
		<textarea height= 130px name="description" ><?Php echo $description ?></textarea><br>

		<input type="submit" value="Envoyer">
		<button  id="annuler" >Annuler</button>
	</form>
	<script>
		function deleteSelectedImages(event) {
			var imageItems = document.getElementsByName("image-item");
			var selectedImageIds = [];
			for (var i = 0; i < imageItems.length; i++) {
				if (imageItems[i].checked) {
				selectedImageIds.push(imageItems[i].value);
				}
		}
		$.ajax({
			type: "POST",
			url: "update.php",
			data: {id: selectedImages},
			success: function(response){
				console.log(response);
			}
		});
		event.preventDefault();
		}

		document.getElementById('annuler').addEventListener('onclick', function() {
    
    window.location.href = "http://localhost/buy-your-car/home";});

	</script>
</body>

</html>

<?php


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['lieu'])) {
    $nom = mysqli_real_escape_string($connexion, $_POST["nom"]);
    $modele = mysqli_real_escape_string($connexion, $_POST["modele"]);
    $id_modele = mysqli_real_escape_string($connexion, $_POST["IdModele"]);
    $marque = mysqli_real_escape_string($connexion, $_POST["marque"]);
    $prix = mysqli_real_escape_string($connexion, $_POST["prix"]);
    $puissance = mysqli_real_escape_string($connexion, $_POST["puissance"]);
    $carburateur = mysqli_real_escape_string($connexion, $_POST["carburateur"]);
    $couleur = mysqli_real_escape_string($connexion, $_POST["couleur"]);
    $description = mysqli_real_escape_string($connexion, $_POST["description"]);
    $annee = mysqli_real_escape_string($connexion, $_POST["annee"]);
    $vin = mysqli_real_escape_string($connexion, $_POST["vin"]);
    $lieu = mysqli_real_escape_string($connexion, $_POST["lieu"]);
	$IdModel = 0;
	$IdMarque = 0; 

	$pl = "select * from img";
	$res = mysqli_query($connexion, $pl );
	if(mysqli_num_rows($res)>0){
		while ($img = mysqli_fetch_assoc($res)){
			if (array_key_exists($img['id'], $_POST)) {
				
			$pl1 = "delete  from img where id=".$img['id'];
			 mysqli_query($connexion, $pl1 ) or die (mysqli_error($connexion));
			
				}	}	}
		else{echo mysqli_error($connexion);}

	
	
    // Insertion des données dans la table modele
    $sql_model = "update  modele set  Puissance=".  $puissance . ", reservoir=" . $carburateur. ", DateFabrication='" . $annee . "', Lieu='" . $lieu . "', NomModele='" . $modele . "', prix=" . $prix . " where IdModele= ".$id_modele ;
	//echo '<script>alert("requete sql pour annonce '.$sql_model.'!!")</script>';
	///echo $sql_model;
	mysqli_query($connexion, $sql_model ) or die( mysqli_error($connexion));

    // Insertion des données dans la table marque
	$IdMarque = 0;
	$sqlm ="select IdMarque from marque where marque.nom='" .$marque. "'";
	$result = mysqli_query($connexion, $sqlm );
		if(mysqli_num_rows($result)>0){
			while ($element = mysqli_fetch_assoc($result)){
			$IdMarque = $element["IdMarque"];
					}	}
	else{echo mysqli_error($connexion);}


    // Insertion des données dans la table voiture
	$sql_voiture ="update  voiture set  IdModele=" . $id_modele . ", IdMarque=" . $IdMarque . ", couleur='" .  $couleur . "', nomVoiture= '" . $nom. "'";
	//echo '<script>alert("requete sql pour annonce '.$sql_voiture.'!!")</script>';
	//echo $sql_voiture.'\n';
	if (mysqli_query($connexion, $sql_voiture )){}
		else{echo mysqli_error($connexion);}
   


	$id_voiture = $vin ; 

	// traitement annonces:
	$IdFournisseur = 0;
	$sqlf = "SELECT IdFournisseur FROM fournisseur WHERE fournisseur.loginAdmin= '". mysqli_real_escape_string($connexion, $_SESSION['login'] ) . "'";
	$result = mysqli_query($connexion, $sqlf);
	if(mysqli_num_rows($result)>0){
		while ($element = mysqli_fetch_assoc($result)){
			$IdFournisseur = $element["IdFournisseur"];
				}	}
		else{echo mysqli_error($connexion);}
	$id = $id_voiture;
	$titre = $nom . " ".$modele; 
	$sqla = "update annonce set titre='". $titre . "', description='". $description .  "' where IdVoiture='". $id_voiture."'" ; 
	//echo '<script>alert("requete sql pour annonce '.$sqla.'!!")</script>';
	mysqli_query($connexion, $sqla ) or die(  mysqli_error($connexion));


    // Traitement des images
    if (isset($_FILES["photos"])) {
        $total = count($_FILES["photos"]["name"]);
		if($total>0){
        for ($i = 0; $i < $total; $i++) {
           /* $nom_fichier = $_FILES["photos"]["name"][$i];
            $taille_fichier = $_FILES["photos"]["size"][$i];
            $type_fichier = $_FILES["photos"]["type"][$i];
            $contenu_fichier = file_get_contents($_FILES["photos"]["tmp_name"][$i]);

            // Insertion des données dans la table images
            $stmt ="INSERT INTO images (nom_fichier, taille_fichier, type_fichier, contenu_fichier, IdVoiture) VALUES ( '" . $nom_fichier . ", " . $taille_fichier . ", " . $type_fichier . ", " .$contenu_fichier . ", " . $id_voiture . ")";
			echo '<script> alert(' . $sql . ')</script>';
            if (mysqli_query($connexion, $stmt )){}
			else{echo '<script> alert(' . mysqli_error($connexion). ')</script>';}*/
            $filename = $_FILES['photos']['name'][$i];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			$target_dir = "uploaded-img/";
			$target_file = $target_dir . $id_voiture .'_'. $i .'.'. $extension ;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["photos"]["tmp_name"][$i]);
			if ($check === false) {
				echo "File is not an image.";
				exit();
			}

			if (mysqli_query($connexion, "INSERT INTO img (url, IdVoiture) VALUES ('$target_file', '$id_voiture')")) {
				move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file);
			} else {
				echo "Error: " . mysqli_error($connexion);
			}
   

        
	}
    }else {
		
		echo '<script>alert("probleme d\'images '. array_keys($_FILES).'")</script>';
		
	}}


    // Fermeture de la connexion à la base de données
    //echo '<script>alert("Creation reussie !!")</script>';
    	header("Location: ./detail.php?IdVoiture=".$id);

}


} else {
        echo "Aucun résultat trouvé.";
    }

    mysqli_close($conn);
?>