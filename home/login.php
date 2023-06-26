<?php session_start(); 
if (isset($_SESSION['valid'] )) {
	header('Location: ./index.php');
}?>
<html>
<head>
	<title>Login</title>
</head>

<body>
<?php
require_once("./database/connect-bd.php");

if(isset($_POST['username'])) {
	$user = mysqli_real_escape_string($connexion, $_POST['username']);
	$pass = mysqli_real_escape_string($connexion, $_POST['password']);

	if($user == "" || $pass = "") {
			echo '<script>alert("connexion failed= '.$_POST['username'].'!!")</script>';
			echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$sql = "SELECT * FROM administrateur WHERE login='". $user."' AND password='". md5('$pass'). "'";

		$result = mysqli_query($connexion, $sql )
					or die("Could not execute the select query. ". $sql);
		
		
		if(mysqli_num_rows($result) > 0) { 
			$validuser = $row['username'];
			$row = mysqli_fetch_assoc($result);
			echo '<script>alert("Connexion reussie '.$row['login'].'!!")</script>';
			$_SESSION['valid'] = true;
			$_SESSION['login'] = $row['login'];

			if ($row['admin']==1) {
				$_SESSION['admin'] = true;
				
			}
		} else {
			echo "Invalid username or password.";
			echo "<br/>";
			echo "<a href='login.php'>Go back</a>";
			die("FAiled");
		}

		if($_SESSION['valid'] == true) {
			header('Location: index.php');			
		}
	}
} else {
?><!DOCTYPE html>
<html>
<head>
  <title>Connexion </title>
  <link rel="stylesheet" type="text/css" href="annonce.css">
  <style>
    body{
      padding-top: 7%;
    }
    input[type="password"] {
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 16px;
    margin-bottom: 10px;
}
  </style>
</head>
<body>
  <h1>Connexion</h1>
  <form method="post">
    <label for="titre">Nom d'utilisateur :</label>
    <input type="text" name="username" required><br>

    <label for="puissance">Mot de passe:</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="submit" value="Connexion">
  </form>
<?php }?>
</body>
</html>