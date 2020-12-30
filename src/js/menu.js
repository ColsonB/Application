/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function aidFunction() {
  document.getElementById("dropdown-aid").classList.toggle("show");

}

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
  if (!event.target.matches('.dropdown-aid-menu')) {

    var dropdowns = document.getElementsByClassName("dropdown-aid");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

