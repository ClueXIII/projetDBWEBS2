<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header class="w3-theme-d1 w3-center w3-padding-16">
        <div class="" style="position:absolute; left : 0px;top:5px;">
            <img class="logo" style="height:135px" src="img\logo.png" alt="logo" >
        </div>
        <div class="">
            <h1>Tomber dans le panneau</h1>
            <p>Boutique de vente de panneau</p>
        </div>
    </header>
    <main class="w3-row" style="height: 500px">
        <div class="w3-col s3 m2 l1 w3-theme-d2" style="height: 100%;">
            <ul class="" style="margin: 0; padding:0;">
               <?php
                   $TABPAGES = array("Page Intro"=>"intro.php","Panneaux"=>"panneaux.php","Gestion"=>"gestion.php");
                   foreach($TABPAGES as $key => $value){
                   echo '<li style="display:block;" class="w3-padding-large w3-hover-theme" onmouseover="this.style.color=\'yellow\'" onmouseleave="this.style.color=\'white\'" ><a style="text-decoration: none" href="index.php?page='.$value.'" title="'.$key.'">'.$key.'</a></li>';
                   }
               ?>
            </ul>
        </div>
        <div class="w3-col s7 m8 l11">
        <?php
            if (isset($_GET['page'])){
            include($_GET['page']);
            } else {
            include("intro.php");
            }
        ?>

        </div>
    </main>
    <footer class="w3-theme-d4 w3-center w3-padding-16">Pied de page</footer>
</body>
</html>
