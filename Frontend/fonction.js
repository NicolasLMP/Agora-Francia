function afficherImage() {
      var image = document.getElementById("image");
      image.classList.add("visible"); // Ajouter la classe "visible" pour afficher progressivement l'image
    }

    function masquerImage() {
      var image = document.getElementById("image");
      image.classList.remove("visible"); // Retirer la classe "visible" pour masquer progressivement l'image
    }

    function redirectToNewPage() {
      window.location.href = "suites3.html";
    }
