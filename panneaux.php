<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>panneau</title>
    <meta name = "viewport" content = "width =  device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body>
<div class="w3-padding-large">
    <form id="filtre">
        <label for="categorie">Sélectionner une catégorie a rechercher :</label>
        <select style="display: inline-block" id="categorie" name="categorie" class="w3-input w3-section">
            <option value="Tout afficher">Tout afficher</option>
            <option value="rond">Rond</option>
            <option value="carré">Carré</option>
            <option value="triangle">Triangle</option>
        </select>
        <br>
        <input class="w3-button w3-theme" id="filtrebtn" style="display: inline-block" value="Envoyer">
    </form>
</div>
<div class="w3-padding-large w3-row">
        <?php
            $fichier = fopen('DB.txt', 'r');
            $articles = array();
            while (!feof($fichier)) {
                $ligne = fgets($fichier);
                if (!empty($ligne)) {
                    $enregistrement = explode('|', $ligne);
                    $article = array(
                        'id' => $enregistrement[0],
                        'nom' => $enregistrement[1],
                        'forme' => $enregistrement[2],
                        'prix' => $enregistrement[3],
                        'urlimg' => $enregistrement[4]
                    );
                    $articles[] = $article;
                }
            }
            fclose($fichier);

        // Fonction de comparaison personnalisée pour trier par catégorie
        function compareByCategory($a, $b) {
            return strcmp($a['forme'], $b['forme']);
        }
        // Trier le tableau par catégorie
        usort($articles, 'compareByCategory');

        foreach ($articles as $article) {
            echo "<div class=\"w3-col s12 m6 l4\"><div class='w3-margin w3-card-2 w3-center w3-theme-d2 w3-padding-8 article {$article['forme']}' style='display: block'><img src='{$article['urlimg']}' class='w3-margin' style='height:120px;'><p>Nom : {$article['nom']}</p><p> Catégorie : {$article['forme']}</p> <p> Prix : {$article['prix']} € </p></div></div>";
            } //les class du nom de la catégorie permettent de filtrer les articles
        ?>
</div>
<script src="index.js"></script>
</body>
</html>
