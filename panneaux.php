<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>panneau</title>
    <meta name = "viewport" content = "width =  device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
</head>
<body>

<script>alert("Si l'ajout, la suppression ou la modification de produit ne fonctionne pas, cela peut être du a la permission du fichier DB.txt qui a été reset. Il faut ainsi faire dans la console 'chmod 777 DB.txt'")</script>

<form action='index.php?page=modifprod.php' method="POST" name="ADD" onsubmit="return confirm('Vous allez être redirigé vers la page d\'ajout d\'article')" >
    <input class="w3-input w3-theme" id="addbtn" type="submit" value="Ajouter un article">
</form>

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
            $fichier = fopen('DB.txt', 'r'); //ouverture du fichier en lecture seule
            $articles = array(); //tableau qui contiendra les articles
            while (!feof($fichier)) { //tant qu'on est pas à la fin du fichier
                $ligne = fgets($fichier); //on récupère la ligne
                if (!empty($ligne)) { //si la ligne n'est pas vide
                    $enregistrement = explode('|', $ligne); //on sépare les données
                    $article = array( //on crée un tableau associatif avec les données
                        'id' => $enregistrement[0],
                        'nom' => $enregistrement[1],
                        'forme' => $enregistrement[2],
                        'prix' => $enregistrement[3],
                        'urlimg' => $enregistrement[4]
                    );
                    $articles[] = $article; //on ajoute l'article au tableau
                }
            }
            fclose($fichier); //fermeture du fichier

        // Fonction de comparaison personnalisée pour trier par catégorie
        function compareByCategory($a, $b) {
            return strcmp($a['forme'], $b['forme']);
        }
        // Trier le tableau par catégorie
        usort($articles, 'compareByCategory');

        foreach ($articles as $article) { //pour chaque article
            echo "<div class=\"w3-col s12 m6 l4 \"><div class='w3-margin w3-card-2 w3-center w3-theme-d2 w3-padding-8 article {$article['forme']} w3-padding' style='display: block'><img src='{$article['urlimg']}' class='w3-margin' style='height:120px;'><p>Nom : {$article['nom']}</p><p> Catégorie : {$article['forme']}</p> <p> Prix : {$article['prix']} € </p>"; //on affiche les données
            echo "<form action='suppression.php' method=\"POST\" name=\"DEL\" onsubmit='return confirm(\"Êtes-vous sûr de vouloir supprimer cet article ?\")' ><input type=\"hidden\" name=\"id\" value=\"{$article['id']}\"><input class=\"w3-input w3-theme w3-padding w3-round-xlarge w3-section\" id=\"suppbtn\" type=\"submit\" value=\"Supprimer\"></form>"; //on crée un bouton pour supprimer l'article
            echo "<form action='index.php?page=modifprod.php' method=\"POST\" name=\"modif\" onsubmit=\"return confirm('Vous allez être redirigé vers la page de modification de l \'article ')\" ><input type=\"hidden\" name=\"id\" value=\"{$article['id']}\"><input class=\"w3-input w3-theme w3-round-xlarge w3-section\" id=\"modifbtn\" type=\"submit\" value=\"Modifier\"></form></div></div>"; //on crée un bouton pour modifier l'article en envoyant l'id dans un formulaire
        }
        ?>
</div>
<script type="text/javascript" src="createfiltrebtn.js"></script>
</body>
</html>
