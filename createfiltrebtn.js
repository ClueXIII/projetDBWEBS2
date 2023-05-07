const bouton = document.getElementById("filtrebtn"); // On récupère l'élément sur lequel on veut détecter le clic
bouton.addEventListener("click", function() { // On écoute l'événement click
  const formulaire = document.getElementById("filtre"); // on récupère le formulaire
  const categorie = formulaire.elements["categorie"].value;  // on récupère la valeur de l'input
  fetch('DB.txt') // on récupère le contenu du fichier DB.txt
    .then(response => response.text())
    .then(alldata => {
      const lignes = alldata.split('\n') // on sépare les lignes
      lignes.forEach(line => {
        const data = line.split('|') // on sépare les données avec le séparateur |
        console.log("donnée " + data[2] +" catégorie" + categorie); // on affiche les données dans la console
        if (data.length >= 3) {
          if (categorie === "Tout afficher") { // si la catégorie est "Tout afficher" on affiche tout
            let divcats = document.querySelectorAll('.article'); // on récupère tous les éléments avec la classe article
            divcats.forEach(function(divcat) {
              divcat.style.display = "block"; // on affiche tous les éléments
            });
          } else if (data[2] !== categorie) { // si la catégorie est différente de la catégorie de l'article on cache l'article
            let cat = data[2];
            let divcats = document.querySelectorAll('.' + cat); // on récupère tous les éléments avec la classe de la catégorie
            divcats.forEach(function(divcat) { // on parcourt tous les éléments
              divcat.style.display = "none"; // on cache l'élément
            });
          }else {
            let cat = data[2]; // si la catégorie est égale à la catégorie de l'article on affiche l'article
            let divcats = document.querySelectorAll('.' + cat); // on récupère tous les éléments avec la classe de la catégorie
            divcats.forEach(function(divcat) {
              divcat.style.display = "block"; // on affiche l'élément
            });
          }
        }
      })
    })
});
