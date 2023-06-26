
<?php session_start(); ?>

<?php
if(isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
include("./database/connect-bd.php");

if(isset($_POST['submit'])) {
	$nom = $_POST['nom'];
	$Prenom = $_POST['Prenom'];
	$sexe = $_POST['sexe'];
	$age = $_POST['age'];
	$numTel = $_POST['numTel'];
    
	$login = $_POST['login'];
	$pass = $_POST['password'];

	if($login == "" || $pass == "" || $nom == "" ) {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
        
    // Requête SQL pour récupérer les détails de la voiture
    $sql="SELECT * from administrateur where login = '" . mysqli_real_escape_string($connexion, $login) . "'"; 
	// Exécution de la requête
    $resultat = mysqli_query($connexion, $sql) or die("Could not execute the insert query. ". $sql. mysqli_error($connexion));
	
    // Vérification du nombre de résultats
    if (mysqli_num_rows($resultat)>0){
        echo "<script>alert('l\'utilisateur". $login. " existe deja !!)</script>";
        echo "Veillez-vous <a href='./login.php'>Connecter</a><br>";
         die("Cet utilisateur existe deja dans la base de donnees, Changez le nom d'utlisateur et recommencez");
         
        
    } else{
       
        $sql = "INSERT INTO administrateur(login, password) VALUES ('$login', '" .md5('$pass'). "')";
		mysqli_query($connexion,$sql )
			or die("Could not execute the insert query. ". $sql. mysqli_error($connexion));
        
		$sql = "INSERT INTO fournisseur(nomFournisseur, PrenomFournisseur, ageFournisseur, sexe, numeroTel,  loginAdmin) VALUES ('$nom', '$Prenom',$age, '$sexe', $numTel, '$login'); ";
        echo "valeur de la requete: ". $sql;
		mysqli_query($connexion, $sql)
			or die("Could not execute the insert query." . $sql);
			
      $validuser = $row['username'];
			$_SESSION['valid'] = true;
			$_SESSION['login'] = $login;
	}
     header("Location: ./index.php");
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Formulaire de Voiture</title>
  <link rel="stylesheet" type="text/css" href="./annonce.css">
</head>
<body>
  <h1>Inscription</h1>
  <form method="post">
    <label for="titre">Nom :</label>
    <input type="text" id="title" id="titre" name="nom" required><br>

    <label for="numero_chassis">Prenom :</label>
    <input type="text" name="prenom" required><br>

    <label for="modele">  Age :</label>
    <input type="number" name="age" required><br>

    <td >Sexe:</td><br>

                <td><select id="marque" name="sexe">
                    <option value="">--Choisir votre sexe--</option>
                    <option value="Masculin">M</option>
                    <option value="Feminin">F</option>
    </select></td>

    <label for="marque">Numero de Téléphone :</label>
    <input type="number" name="numTel" required><br>

    <label for="couleur">Nom Utilisateur :</label>
    <input type="text" name="login" required><br>

    <label for="puissance">Mot de passe:</label>
    <input type="password"  name="password" required><br>

    <input type="submit"  name="submit" value="Enregistrer">

    <label >Deja inscris ?  <h3><a href="./login.php">Connectez vous</a></h3></label>

  </form>
  <?php
}?>
</body>
</html>