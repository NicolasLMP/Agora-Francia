// Récupère l'icône utilisateur et le sous-menu correspondant
const userIcon = document.getElementById('user-icon');
const userSubMenu = document.getElementById('user-submenu');

// Ajoute un gestionnaire d'événement au clic sur l'icône utilisateur
userIcon.addEventListener('click', () => {
  userSubMenu.classList.toggle('show');
});
