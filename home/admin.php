
<?php session_start(); 
if (!isset($_SESSION['admin'] )) {
	header('Location: ./index.php');
}
require_once("./database/connect-bd.php");


if (isset($_GET['id'] ) and $_GET['action']=='rm') {
    $id = mysqli_real_escape_string($connexion, $_GET['id']);
	$sql0= "DELETE FROM fournisseur WHERE IdFournisseur=".$id;
    $result0 = mysqli_query($connexion, $sql0);
    if (mysqli_num_rows($result0)>0) {}else{die( mysqli_connect_error($connexion) );}
}
    $sql= "select * from fournisseur";
    $result = mysqli_query($connexion, $sql);
    if (mysqli_num_rows($result)>0) {
    
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
    <title>Admin</title>
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
        <a class="btn2" href="./index.php">Accueil  </a>'

            <span class="name-friend"><?php echo $_SESSION['login'];?></span>
            <div class="user-img">
                <img src="../imges/avatar.png" alt="user-img" width="50" />
            </div>
        </div>
    </header>
    <nav class="navbar-left">
        <div class="head-logo">S. Y. Car</div>
        <ul class="nav-element">
            <li>
                <i class="fa fa-person-booth"></i><a href="./admin.php">Fournisseurs</a>
            </li>
            <li class="active">
                <i class="fa fa-project-diagram"></i><a href="./gestion_annonces.php">Annonces</a>
            </li>
        </ul>
    </nav>
    <section>
        <div id="friends" class="friends">
            <div class="spacial-head">
                <span>Fournisseurs</span>
            </div>
            <div class="container">
                <?php 
                        While($row = mysqli_fetch_assoc($result)){
            ?>
                <div class="card friend-box">
                    
                    
                    <div class="friend-info">
                        <img src="../imges/friend-01.jpg" alt="friend-img"/>
                        <span class="name-friend"><?php echo $row['nomFournisseur']. ' ' . $row['PrenomFournisseur'];?></span>
                        <span class="job-friend"><?php echo $row['loginAdmin'];?></span>
                    </div>
                    <ul class="list-jobsNbr vip">
                        <li><i class="fa fa-smile-wink"></i><?php 
                        $sql2 = "select * from annonce where IdFournisseur=".$row['IdFournisseur'] ;
                        $result2 = mysqli_query($connexion, $sql2);
                        echo mysqli_num_rows($result2);
                        ?> Annonces Postées</li>
                        <li class="course-disc"><a href="tel:<?php echo $row['numeroTel'];?>"><i class="fa fa-phone"></i></a><?php echo $row['numeroTel'];?></li>
                    </ul>
                    <ul class="foot-friend-box">
                        <li>Rejoint le: <?php echo $row['DateCreation'];?></li>
                        <li><a href="./admin.php?id=<?php echo $row['IdFournisseur'];?>&action=rm" class="btn remove">Supprimer</a></li>
                    </ul>
                </div>
                <?php }?>

            </div>
        </div>
        </section>
</body>
</html>

<?php }?>