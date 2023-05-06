<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Darumadrop+One&display=swap" rel="stylesheet">
</head>
<body style="font-family:'Darumadrop One', cursive; font-size:20px; ">
    <header class="w3-theme-d1 w3-center w3-padding-16">
        <div class="" style="position:absolute; left : 0px;top:5px;">
            <img class="logo" style="height:210px" src="img\logo.png" alt="logo" >
        </div>
        <div class="">
            <h1 style="font-family:'Darumadrop One', cursive;font-size:80px; ">Tomber dans le panneau</h1>
            <h2 style="font-family:'Darumadrop One', cursive;" >Boutique de vente de panneau</h2>
        </div>
    </header>
    <main class="w3-row" style="height:80vh;">
        <div class="w3-col s3 m2 l1 w3-theme-d2" style="height: 100%;overflow: auto;">
            <ul class="" style="margin: 0; padding:0;">
               <?php
                   $TABPAGES = array("Page Intro"=>"intro.php","Panneaux"=>"panneaux.php","Gestion"=>"gestion.php");
                   foreach($TABPAGES as $key => $value){
                   echo '<li style="display:block;" class="w3-padding-large w3-hover-theme" onmouseover="this.style.color=\'yellow\'" onmouseleave="this.style.color=\'white\'" ><a style="text-decoration: none" href="index.php?page='.$value.'" title="'.$key.'">'.$key.'</a></li>';
                   }
               ?>
            </ul>
        </div>
        <div class="w3-col s9 m10 l11" style="height:80vh; overflow: scroll; overflow-x:hidden;">
            <div>
                <?php
                if (isset($_GET['page'])){
                    include($_GET['page']);
                } else {
                    include("intro.php");
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="w3-theme-d4 w3-center w3-padding-16">Pied de page</footer>
</body>
</html>
