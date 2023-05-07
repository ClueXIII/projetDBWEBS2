<?php
$idToCheck = $_POST['id'];// Id du formulaire

$fileContent = file_get_contents('DB.txt'); // Récupère le contenu du fichier DB.txt

$lines = explode(PHP_EOL, $fileContent); // Sépare le contenu du fichier DB.txt en lignes

foreach ($lines as $key => $line) { // Sépare le contenu du fichier DB.txt
    $data = explode('|', $line); // Sépare le contenu du fichier DB.txt

    $id = $data[0]; // Récupère l'id de la ligne
    if ($id == $idToCheck) { // Si l'id de la ligne correspond à l'id du produit à modifier
        unset($lines[$key]); // Sépare le contenu du fichier DB.
        break; // Arrête la boucle
    }
}

$newContent = implode(PHP_EOL, $lines); //  Recrée le contenu du fichier DB.txt
file_put_contents("DB.txt", $newContent); // Écris le nouveau contenu dans le fichier DB.txt

header("Location: index.php?page=panneaux.php"); // Redirige vers la page panneaux.php
exit(); // Arrête le script
?>
