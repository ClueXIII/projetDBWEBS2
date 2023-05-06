const bouton = document.getElementById("filtrebtn");
bouton.addEventListener("click", function() {
  const formulaire = document.getElementById("filtre");
  const categorie = formulaire.elements["categorie"].value;
  fetch('DB.txt')
    .then(response => response.text())
    .then(alldata => {
      const lignes = alldata.split('\n')
      lignes.forEach(line => {
        const data = line.split('|')
        console.log("donnée " + data[2] +" catégorie" + categorie);
        if (data.length >= 3) {
          if (categorie === "Tout afficher") {
            let divcats = document.querySelectorAll('.article');
            divcats.forEach(function(divcat) {
              divcat.style.display = "block";
            });
          } else if (data[2] !== categorie) {
            let cat = data[2];
            let divcats = document.querySelectorAll('.' + cat);
            divcats.forEach(function(divcat) {
              divcat.style.display = "none";
            });
           }else {
            let cat = data[2];
            let divcats = document.querySelectorAll('.' + cat);
            divcats.forEach(function(divcat) {
              divcat.style.display = "block";
            });
            }
          }
      })
    })
});

const suppbtn = document.getElementById("suppbtn");
suppbtn.addEventListener("click", function() {
  alert("Vous avez supprimé un article");
} );
