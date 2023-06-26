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
			text-align: center;
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

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			border-radius: 5px;
			padding: 10px 20px;
			border: none;
			cursor: pointer;
			font-size: 18px;
			margin-top: 10px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<h2>Annonce de vente de voiture</h2>
		<label for="nom">Nom du véhicule:</label><br>
		<input type="text" id="nom" name="nom" required><br>

		<label for="modele">Modèle:</label><br>
		<input type="text" id="modele" name="modele" required><br>
		

		<label for="marque">Marque:</label><br>
		<select id="marque" name="marque" require>
			<option require value="">--Choisir une marque--</option>
			<?php 
			
				require_once("./database/connect-bd.php");
				$sql = "SELECT * from marque where 1;";

				$result = mysqli_query($connexion, $sql );
				if(mysqli_num_rows($result)>0){
					while ($element = mysqli_fetch_assoc($result)){
						echo '<option value="' . $element["IdMarque"].  '">' . $element["nom"]. '</option>';
					}	}
			?>
		</select><br>

		<label for="prix">Prix en USD:</label><br>
		<input type="number" id="prix" name="prix" required><br>

		<label for="puissance">Puissance en HP:</label><br>
		<input type="number" id="puissance" name="puissance"><br>

		<label for="photos">Document de validation (photo de la facture):</label><br>
		<input type="file" id="photos" name="doc"  required><br>


		<label for="carburateur">Carburateur:</label><br>
		<input type="number" id="carburateur" name="carburateur" default=100><br>

		<label for="couleur">Couleur:</label><br>
		<input type="text" id="couleur" name="couleur" default="Gris"><br>

		<label for="annee">Année de fabrication:</label><br>
		<input type="date" id="annee" name="annee"><br>

		<label for="vin">Numéro d'identification du véhicule (VIN):</label><br>
		<input type="text" id="vin" name="vin" required><br>

		<label for="photos">Photos:</label><br>
		<input type="file" id="photos" name="photos[]" multiple required><br>

		<label for="lieu">Localisation:</label><br>
		<input type="text" id="lieu" name="lieu" required><br>

		<label for="lieu">Description:</label><br>
		<textarea height= 130px name="description"></textarea><br>

		<input type="submit" value="Envoyer">
	</form>
</body>
</html>

<?php


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($connexion, $_POST["nom"]);
    $modele = mysqli_real_escape_string($connexion, $_POST["modele"]);
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
	$IdDoc = 0;
	
	$IdFournisseur = 0;

	// Insertion des données dans la table modele
    $sql_model = "insert into modele( Puissance, reservoir, DateFabrication, Lieu, NomModele, prix) VALUES (" .  $puissance . ", " . $carburateur. ", '" . $annee . "', '" . $lieu . "','" . $modele . "', " . $prix . ")" ;
	if (mysqli_query($connexion, $sql_model )){
	$IdModel = mysqli_insert_id($connexion);}
	else{die("insertion du modele a echoue: ". mysqli_error($connexion));}


	$sql = "SELECT IdFournisseur FROM fournisseur WHERE fournisseur.loginAdmin= '". mysqli_real_escape_string($connexion, $_SESSION['login'] ) . "'";
	$result = mysqli_query($connexion, $sql);
	if(mysqli_num_rows($result)>0){
		while ($element = mysqli_fetch_assoc($result)){
			$IdFournisseur = $element["IdFournisseur"];
				}	}
		else{ die("Selection de l'id de l'admin echouee: ". mysqli_error($connexion)); }

	
		
 

	if (isset($_FILES["doc"])) {
       
        
          
		$filename1 = $_FILES['doc']['name'];
		$extension1 = pathinfo($filename1, PATHINFO_EXTENSION);
		$target_dir1 = "uploaded-doc/";
		$target_file1 = $target_dir1 . $IdFournisseur  .'.'. $extension1 ;
		$imageFileType = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

		$check = getimagesize($_FILES["doc"]["tmp_name"]);
		if ($check === false) {
			echo "File is not an image.";
			exit();
		}
		$query = "INSERT INTO documentdevalidation (urld, IdFournisseur, valide) VALUES ('".$target_file1."', '".$IdFournisseur."', false)";
		//echo '<script>alert("requete sql pour insertion de la doc: '.$query.'")</script>';
		

		if (mysqli_query($connexion, $query )) {
			move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file1);
			$IdDoc = mysqli_insert_id($connexion);
		} else {
			die("insertion de la doc error: " . mysqli_error($connexion));
		}

	
}else {
	
	echo '<script>alert("probleme d\'images '. array_keys($_FILES).'")</script>';
	
}




    // Insertion des données dans la table voiture
	$sql_voiture ="INSERT INTO voiture(IdVoiture, IdModele, IdMarque, couleur, nomVoiture, docValid) VALUES ('" . $vin . "', " . $IdModel . ", " . $marque . ", '" .  $couleur . "', '" . $nom. "', ". $IdDoc . ")";
	//echo $sql_voiture.'\n';
	if (mysqli_query($connexion, $sql_voiture )){}
		else{die( "Insertion voiture:". mysqli_error($connexion));}

   


	

	// traitement annonces:
	

	$titre = $nom . " ".$modele; 
	$sql = "insert into annonce(titre, description, IdVoiture, IdFournisseur) values ('". $titre . "', '". $description . "' , '" . $vin . "', " . $IdFournisseur . ")" ; 
	if (mysqli_query($connexion, $sql )){}
		else{die( "Insertion  annonce:" . mysqli_error($connexion));}


    // Traitement des images
    if (isset($_FILES["photos"])) {
        $total = count($_FILES["photos"]["name"]);
        for ($i = 0; $i < $total; $i++) {
           
            $filename = $_FILES['photos']['name'][$i];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			$target_dir = "uploaded-img/";
			$target_file = $target_dir . $vin .'_'. $i .'.'. $extension ;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["photos"]["tmp_name"][$i]);
			if ($check === false) {
				echo "File is not an image.";
				exit();
			}

			if (mysqli_query($connexion, "INSERT INTO img (url, IdVoiture) VALUES ('$target_file', '$vin')")) {
				move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file);
			} else {
				die( "Insertion Error: " . mysqli_error($connexion));
			}
   

        }
    }else {
		
		echo '<script>alert("probleme d\'images '. array_keys($_FILES).'")</script>';
		
	}

	

    // Fermeture de la connexion à la base de données
    //echo '<script>alert("Creation reussie !!")</script>';
    header("Location: ./index.php");

}
?>