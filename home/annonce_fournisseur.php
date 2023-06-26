<?php session_start(); 
if (!isset($_SESSION['admin'] )) {
	header('Location: ./index.php');
}
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
    <title>Annonces-fournisseur</title>
</head>

<body>
    <header>
        <form>
            <fieldset>
                <i class="fa fa-search"></i>
                <input type="search" name="searchHead" placeholder="search keyword" />
            </fieldset>
        </form>
        <div class="userbtn">
            <a href="#" class="btn1">Ajouter</a>
         <a href="#" class="btn1">Se deconnecter</a>
        </div>
    </header>
    <nav class="navbar-left">
        <div class="head-logo">S. Y. Car</div>   
        <ul class="nav-element">
            <li class="active">
                <i class="fa fa-person-booth"></i><a href="profile.html">profile</a>
            </li>
        </ul>    
    </nav>
    <section>
        <div id="courses" class="courses">
            <div class="spacial-head">
                <span>Annonces</span>
            </div>
            <div class="container">
                <div class="card course-box">
                    <div class="head-course">
                        <img src="./../../online-car-selling/uploaded-img/RGGE5G0000001_0.jpg" alt="back-img">
                        <img src="../imges/team-01.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">TOYOTA Carina</span>
                    <p class="course-disc">Modéle: Carina</p>
                    <p class="course-disc">Puissance: 150hp</p>
                    <li class="course-disc"><a href="tel:+00000000000"><i class="fa fa-phone"></i></a>Num Téléphone</li>
                    <div class="dp">
                    <a href="delete.php" class="btn btn-course">Supprimer</a>
                   </div>
                    <ul class="info-course">
                        <li class="watched-user">Toyota</li>
                        <li>$ 165</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-03.jpg" alt="back-img">
                        <img src="../imges/team-01.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Data Structure And Algorithms</span>
                    <p class="course-disc">Master The Art Of Data Strcuture And Famous Algorithms Like Sorting, Dividing And Conquering</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>210</li>
                        <li>$ 1150</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-02.jpg" alt="back-img">
                        <img src="../imges/team-02.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Responsive Web Design</span>
                    <p class="course-disc">Mastering Responsive Web Design And Media Queries And Know Everything About Breakpoints</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>650</li>
                        <li>$ 90</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-04.jpg" alt="back-img">
                        <img src="../imges/team-04.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Mastering Python</span>
                    <p class="course-disc">Mastering Python To Prepare For Data Science And AI And Automating Things in Your Life</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>950</li>
                        <li>$ 250</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-01.jpg" alt="back-img">
                        <img src="../imges/team-04.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">PHP Examples</span>
                    <p class="course-disc">PHP Tutorials And Examples And Practice On Web Application And Connecting With Databases</p>
                    <a href="#" class="btn btn-course"></a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>850</li>
                        <li>$ 150</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-05.jpg" alt="back-img">
                        <img src="../imges/team-04.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Data Structure And Algorithms</span>
                    <p class="course-disc">Master The Art Of Data Strcuture And Famous Algorithms Like Sorting, Dividing And Conquering</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>1150</li>
                        <li>$ 210</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-04.jpg" alt="back-img">
                        <img src="../imges/team-03.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Responsive Web Design</span>
                    <p class="course-disc">Mastering Responsive Web Design And Media Queries And Know Everything About Breakpoints</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>650</li>
                        <li>$ 90</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-03.jpg" alt="back-img">
                        <img src="../imges/team-02.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Mastering Web Design</span>
                    <p class="course-disc">Master The Art Of Web Designing And Mocking, Prototyping And Creating Web Design Architecture</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>850</li>
                        <li>$ 145</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-02.jpg" alt="back-img">
                        <img src="../imges/team-03.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">PHP Examples</span>
                    <p class="course-disc">PHP Tutorials And Examples And Practice On Web Application And Connecting With Databases</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>850</li>
                        <li>$ 150</li>
                    </ul>
                </div>
                <div class="card course-box">
                    <div class="head-course">
                        <img src="../imges/course-01.jpg" alt="back-img">
                        <img src="../imges/team-01.png" alt="teacher-img" />
                    </div>
                    <span class="name-course">Mastering Python</span>
                    <p class="course-disc">Mastering Python To Prepare For Data Science And AI And Automating Things in Your Life</p>
                    <a href="#" class="btn btn-course">Course Info</a>
                    <ul class="info-course">
                        <li class="watched-user"><i class="fa fa-user-alt"></i>950</li>
                        <li>$ 250</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</body>
</html>