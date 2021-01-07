/* Fonction js pour afficher le menu déroulant pour la déconnexion en cliquant sur le bouton de profil */

function profilFunction() {
    document.getElementById("dropdown-profil").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropdown-profil-menu')) {

    var dropdowns = document.getElementsByClassName("dropdown-profil");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

