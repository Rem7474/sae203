//script pour le trie des articles sur la page index.php
//envoie de la requete ajax
$(document).ready(function() {
    // Écouteur d'événement pour soumettre le formulaire
    $('#formulaire_recherche').on('submit', function(e) {
      e.preventDefault(); // Empêche le formulaire de se soumettre normalement
  
      // Récupération des données du formulaire
      var formData = $(this).serialize();
  
      // Appel AJAX
      $.ajax({
        type: 'POST',
        url: 'recherche.php', // Remplacez 'recherche.php' par le chemin de votre script PHP
        data: formData,
        success: function(response) {
          // Affichage des résultats dans la zone d'affichage des résultats
          $('.resultats').animate({opacity: 0}, 0);
          $('#resultats').html(response);
          //changement de l'opacité en précisant la durée
          $('.resultats').animate({opacity: 1}, 1500);
        }
      });
    });
    $('#commander').on('submit', function(e) {
      e.preventDefault(); // Empêche le formulaire de se soumettre normalement
  
      // Récupération des données du formulaire
      var formData =  $(this).serialize();
      // Appel AJAX
      $.ajax({
        type: 'POST',
        url: 'commander.php',
        data: formData,
        success: function(response) {
          // Affichage des résultats dans la zone d'affichage des résultats
          //window.location.reload();
          //window.location.href = 'mescommandes.php';
          //masquage de la div panier
          $('.panier').hide();
          $('#resultats').html(response);
        }
      });
    });
    $('.scaleup').toggleClass('animate');
    $('.fade').animate({opacity: 1}, 1500);


    // Sélection du menu burger
    var burgerMenu = document.querySelector('.burger-menu');
    // Sélection du menu principal
    var mainMenu = document.querySelector('.menu');

    // Écouteur d'événement pour le clic sur le menu burger
    burgerMenu.addEventListener('click', function() {
      // Ajout ou suppression de la classe "open" sur le menu principal
      mainMenu.classList.toggle('open');
    });
  $('.menu-toggle').click(function() {
    $(this).toggleClass('menu-open');
  });

  });

  console.log('Le script est bien pris en compte V3!');