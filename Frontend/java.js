
function afficherProduits() {
  const produits = [
    {
      image: "gta5.png",
      nom: "GTA 5",
      categorie: "Article régulier",
      prix: 15,
      priorite: 3
    },
    {
      image: "mariokart.png",
      nom: "Mario Kart Ds",
      categorie: "Article régulier",
      prix: 14.99,
      priorite: 3
    },
    {
    image: "zelda.png",
    nom: "Zelda : ocarina of time ",
    categorie: "Article rare",
    prix: 4999,
    priorite: 1
  },
  {
    image: "god.png",
    nom: "God of War",
    categorie: "Article régulier",
    prix: 19.99,
    priorite: 3
  },
  {
    image: "nintendo.jpg",
    nom: "Nintendo NES",
    categorie: "Article haut de gamme",
    prix: 299.99 ,
    priorite: 2
  },
  {
    image: "acrossing.jpg",
    nom: "Animal Crossing",
    categorie: "Article regulier",
    prix: 19.99 ,
    priorite: 3
  },
  {
    image: "pacman.jpg",
    nom: " Ms PACMAN ",
    categorie: "Article rare",
    prix: 149.99 ,
    priorite: 1
  },
  {
    image: "tetris.jpg",
    nom: "Tetris",
    categorie: "Article rare",
    prix: 199.99 ,
    priorite: 1
  },
  {
    image: "wiisport.png",
    nom: "Wii sport",
    categorie: "Article regulier",
    prix: 19.99 ,
    priorite: 3
  },
  {
    image: "gta.jpg",
    nom: "Gta san andreas",
    categorie: "Article rare",
    prix: 29.99 ,
    priorite: 1
  },
  {
    image: "minecraft.jpg",
    nom: "Minecraft",
    categorie: "Article regulier",
    prix: 9.99 ,
    priorite: 3
  },
  {
    image: "mega.jpg",
    nom: "Mega Man 5",
    categorie: "Article rare",
    prix: 49.99,
    priorite: 1
  },
  {
    image: "pokemonRouge.png",
    nom: "Pokemon Rouge",
    categorie: "Article rare",
    prix: 49.99,
    priorite: 1
  },
  {
    image: "360.png",
    nom: "XBOX 360",
    categorie: "Article régulier",
    prix: 9.99,
    priorite: 3
  }
  ];



  produits.sort((a, b) => a.priorite - b.priorite);

  const sectionProduits = document.querySelector('.section_produits');
  const produitsDiv = document.createElement('div');
  produitsDiv.classList.add('produits');

  produits.forEach(function(produit) {
    const carte = document.createElement('div');
    carte.classList.add('carte');

    const imageDiv = document.createElement('div');
    imageDiv.classList.add('img');
    const image = document.createElement('img');
    image.src = produit.image;
    imageDiv.appendChild(image);
    carte.appendChild(imageDiv);

    const desc = document.createElement('div');
    desc.classList.add('desc');
    desc.textContent = produit.categorie;
    carte.appendChild(desc);

    const titre = document.createElement('div');
    titre.classList.add('titre');
    titre.textContent = produit.nom;
    carte.appendChild(titre);

    const box = document.createElement('div');
    box.classList.add('box');

    const prix = document.createElement('div');
    prix.classList.add('prix');
    prix.textContent = produit.prix + '€';
    box.appendChild(prix);

    const boutonAchat = document.createElement('button');
    boutonAchat.classList.add('achat');
    
    if (produit.priorite === 1) {
      boutonAchat.textContent = 'Enchérir';
    } else if (produit.priorite === 2) {
      boutonAchat.textContent = 'Ajouter au panier';
    } else if (produit.priorite === 3) {
      boutonAchat.textContent = 'Négocier';
    }
    box.appendChild(boutonAchat);

    carte.appendChild(box);
    produitsDiv.appendChild(carte);
  });

  sectionProduits.appendChild(produitsDiv);
}
/*FIN DE LA FONCTION AFFICHER PRODUIT*/


// Appeler la fonction pour afficher les produits
afficherProduits();

// Ajoutez un gestionnaire d'événements au clic sur le lien "Tout Parcourir"
document.addEventListener("DOMContentLoaded", function() {
  var toutParcourirLink = document.getElementById("tout-parcourir-link");
  toutParcourirLink.addEventListener("click", tout_parcourir);
});
