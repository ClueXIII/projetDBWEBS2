<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>gestion</title>
    <meta name = "viewport" content = "width =  device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body>
<div class="w3-padding-large w3-theme-d2 w3-card-2 w3-margin w3-round-xlarge" id="addform">
    <p style="font-size: 25px;">Ajouter un nouveau produit</p>

    <form method="POST" onsubmit='return confirm("Êtes-vous sûr de vouloir ajouter cet article ?")'>
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

<div class="w3-padding-large w3-theme-d2 w3-card-2 w3-margin w3-round-xlarge" id="divmodifform">
    <p style="font-size: 25px;">modifier produit</p>

    <form method="POST" id="modifform" onsubmit='return confirm("Êtes-vous sûr de vouloir modifier cet article ?")'>
        <label for="id_produit">ID de l'article :</label>
        <input class="w3-input" type="text" id="id_produit" name="id_produit" readonly><br>

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

        <input class="w3-input w3-theme" type="submit" value="modifier">
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifie si la méthode utilisée est POST
    if (isset($_POST['id'])) { // Vérifie si le champ id existe => on veux modifier un produit
        echo '<script> document.getElementById("addform").style.display = "none"; document.getElementById("modifform").style.display="block";</script>'; // Affiche le formulaire de modification
        $idToCheck = $_POST['id']; // Récupère l'id du produit à modifier

        $fileContent = file_get_contents('DB.txt'); // Récupère le contenu du fichier DB.txt

        $lines = explode(PHP_EOL, $fileContent); // Sépare le contenu du fichier DB.txt en lignes

        foreach ($lines as $key => $line) { // Pour chaque ligne du fichier DB.txt
            $data = explode('|', $line); // Sépare la ligne en données

            $id = $data[0];
            if ($id == $idToCheck) { // Si l'id de la ligne correspond à l'id du produit à modifier
                echo '<script>let form = document.getElementById("modifform");form.elements["id_produit"].value = "'.$data[0].'";form.elements["nom_produit"].value = "'.$data[1].'";form.elements["forme"].value = "'.$data[2].'";form.elements["prix"].value = '.$data[3].';form.elements["image"].value = "'.$data[4].'";</script>'; //  Rempli le formulaire avec les données du produit à modifier
            }
        }
    } else {
        echo '<script> document.getElementById("addform").style.display = "block"; document.getElementById("divmodifform").style.display="none";</script>'; // Affiche le formulaire d'ajout car il n'y a pas d'id
        }
    }

    if (isset($_POST['id_produit'])){ // Vérifie si l'id du produit à modifier existe
        if (isset($_POST['nom_produit']) && isset($_POST['forme']) && isset($_POST['prix']) && isset($_POST['image'])) { // Vérifie si les champs du formulaire existent

            // Récupérer les valeurs des champs du formulaire
            $id = $_POST['id_produit'];
            $nomProduit = $_POST['nom_produit'];
            $forme = $_POST['forme'];
            $prix = $_POST['prix'];
            $urlImage = $_POST['image'];


            // Format de la ligne à écrire dans le fichier DB.txt
            $line = $id . '|' . $nomProduit . '|' . $forme . '|' . $prix . '|' . $urlImage . PHP_EOL;

            // Écrire la ligne dans le fichier DB.txt
            file_put_contents('DB.txt', $line, FILE_APPEND);

            $idToCheck = $_POST['id_produit']; // Id du formulaire
            $fileContent = file_get_contents('DB.txt'); // Récupère le contenu du fichier DB.txt
            $lines = explode(PHP_EOL, $fileContent); // Sépare le contenu du fichier DB.txt en lignes
            foreach ($lines as $key => $line) { // Pour chaque ligne du fichier DB.txt
                $data = explode('|', $line); // Sépare la ligne en données

                $id = $data[0]; // Récupère l'id de la ligne
                if ($id == $idToCheck) { // Si l'id de la ligne correspond à l'id du produit à modifier
                    unset($lines[$key]); // Supprime la ligne
                    break; // Arrête la boucle
                }
            }
            $newContent = implode(PHP_EOL, $lines); // Recrée le contenu du fichier DB.txt
            file_put_contents("DB.txt", $newContent); // Écris le nouveau contenu dans le fichier DB.txt
            echo '<script> alert("Produit modifié avec succès !"); window.location.href = "index.php?page=panneaux.php";</script>'; // Affiche une alerte et redirige vers la page panneaux.php
        }
    }else {
        if (isset($_POST['nom_produit']) && isset($_POST['forme']) && isset($_POST['prix']) && isset($_POST['image'])) { // Vérifie si les champs du formulaire existent
            // Récupérer les valeurs des champs du formulaire
            $nomProduit = $_POST['nom_produit'];
            $forme = $_POST['forme'];
            $prix = $_POST['prix'];
            $urlImage = $_POST['image'];

            // Générer l'ID (incrémenté à chaque fois)
            $lastId = 0;
            if (file_exists('DB.txt')) { // Vérifie si le fichier DB.txt existe
                $lines = file('DB.txt'); // Récupère le contenu du fichier DB.txt
                $lastLine = end($lines); // Récupère la dernière ligne du fichier DB.txt
                $lastId = explode('|', $lastLine)[0]; // Récupère l'id de la dernière ligne du fichier DB.txt
            }
            $id = $lastId + 1; // Génère l'id du new produit

            // Format de la ligne à écrire dans le fichier DB.txt
            $line = $id . '|' . $nomProduit . '|' . $forme . '|' . $prix . '|' . $urlImage . PHP_EOL;

            // Écrire la ligne dans le fichier DB.txt
            file_put_contents('DB.txt', $line, FILE_APPEND);

            echo '<script> alert("Produit ajouté avec succès !"); window.location.href = "index.php?page=panneaux.php";</script>'; // Affiche une alerte et redirige vers la page panneaux.php
    }
}
?>
</body>
</html>
