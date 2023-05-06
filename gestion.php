<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>gestion</title>
    <meta name = "viewport" content = "width =  device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body>
<div class="w3-padding-large">
    <div>
        <h1>Ajouter un produit</h1>
        <form>
        </form>
    </div>
</div>
<?php
$contenu = "Contenu de la première ligne.\n";
$contenu .= "Contenu de la deuxième ligne.\n";
$contenu .= "Contenu de la troisième ligne.\n";

// Chemin vers le fichier
$cheminFichier = "DB.txt";

// Ouverture du fichier en mode écriture
$fichier = fopen($cheminFichier, "w");

// Écriture dans le fichier
fwrite($fichier, $contenu);

// Fermeture du fichier
fclose($fichier);
?>
</body>
</html>
