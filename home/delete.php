<?php
session_start();
require_once("./database/connect-bd.php");


if (isset($_GET["IdVoiture"])) {
     $id = mysqli_real_escape_string($connexion, $_GET['IdVoiture']);
    /*$sql = "delete from annonce where IdVoiture='".$id."'";
	 //echo '<script>alert("requete sql pour delete annonce: '.$sql.'!!")</script>';
   $result1 = mysqli_query($connexion, $sql ) or die("Could not execute the delete query. ". $sql);
    $sqfl = "SELECT IdModele FROM voiture WHERE IdVoiture='". $id. "'";
	//echo '<script>alert("requete sql pour selection de IdModele: '.$sqfl.'!!")</script>';

		$result1 = mysqli_query($connexion, $sqfl ) or die("Could not execute the select query. ". $sqfl);
		if(mysqli_num_rows($result1) > 0) { 
			$row = mysqli_fetch_assoc($result1);
	//echo '<script>alert("resultat: '.$row['IdModele'].'!!")</script>';
    
            $sql1 = "DELETE FROM voiture  WHERE IdVoiture='".$id."'";
          //   echo '<script>alert("requete sql pour delete voiture '.$sql1.'!!")</script>';
        $result0 = mysqli_query($connexion, $sql1 ) or die("Could not execute the delete query. ". $sql1);
 */
        $sql4 = "DELETE from modele  WHERE IdModele =".$id;
          //   echo '<script>alert("requete sql pour delete modele '.$sql4.'")</script>';
        $result = mysqli_query($connexion, $sql4 ) or die("Could not execute the delete query. ". $sql4);

         header("Location: ./index.php");  
    //}
} else {
    echo '<script>alert("Une erreur est survenue, contactez l\'administrateur !!")</script>';
}

?>