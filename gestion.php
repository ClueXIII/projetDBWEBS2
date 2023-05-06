<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>gestion</title>
    <meta name = "viewport" content = "width =  device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body>
<div class="w3-padding-large w3-theme-d2 w3-card-2 w3-margin w3-round-xlarge">
    <p style="font-size: 25px;">Ajouter un nouveau produit</p>

    <form method="POST">
        <label for="nom_produit">Nom du produit:</label>
        <input class="w3-input" type="text" id="nom_produit" name="nom_produit" required><br>

        <label for="forme">Forme:</label>
        <select class="w3-input w3-animate-input" id="forme" name="forme">
            <option value="rond">Rond</option>
            <option value="carré">Carré</option>
            <option value="triangle">Triangle</option>
        </select><br>

        <label for="prix">Prix:</label>
        <input class="w3-input" type="number" id="prix" name="prix" required><br>

        <label for="image">URL de l'image:</label>
        <input class="w3-input" type="url" id="image" name="image" required><br>

        <input class="w3-input w3-theme" type="submit" value="Ajouter">
    </form>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $nomProduit = $_POST['nom_produit'];
    $forme = $_POST['forme'];
    $prix = $_POST['prix'];
    $urlImage = $_POST['image'];

    // Générer l'ID (incrémenté à chaque fois)
    $lastId = 0;
    if (file_exists('DB.txt')) {
        $lines = file('DB.txt');
        $lastLine = end($lines);
        $lastId = explode('|', $lastLine)[0];
    }
    $id = $lastId + 1;

    // Format de la ligne à écrire dans le fichier DB.txt
    $line = $id . '|' . $nomProduit . '|' . $forme . '|' . $prix . '|' . $urlImage . PHP_EOL;

    // Écrire la ligne dans le fichier DB.txt
    file_put_contents('DB.txt', $line, FILE_APPEND);
}
?>
</body>
</html>
