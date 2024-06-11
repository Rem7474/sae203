// Élément HTML où afficher le compte à rebours
var countdownElement = document.getElementById('countdown');

// Fonction pour mettre à jour l'affichage du compte à rebours
function updateCountdown() {
  countdownElement.textContent = countdown;

  if (countdown > 0) {
    countdown--;
    console.log(countdown);
    setTimeout(updateCountdown, 1000); // Appel récursif après 1 seconde
  }
}

// Lancement du compte à rebours au chargement de la page
updateCountdown();