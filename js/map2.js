function initMap() {
    // Récupérer l'adresse depuis la variable PHP
  
    // Afficher la carte Google Maps avec l'adresse
    var map = new google.maps.Map(document.getElementById('map'), {
      center: { lat: 0, lng: 0 }, // Coordonnées par défaut
      zoom: 15 // Zoom par défaut
    });
  
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': adresse }, function (results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });

        // Ajouter un écouteur d'événement pour le clic sur le bouton "Itinéraire"
        // Ajouter un écouteur d'événement pour le clic sur le bouton "Itinéraire"
document.getElementById('btnItineraire').addEventListener('click', function() {
    var origin = ''; // Adresse de départ (peut être une adresse saisie par l'utilisateur)
    var destination = adresse; // Adresse de destination

    // Générer l'URL pour l'itinéraire avec les adresses de départ et de destination
    var url = 'https://www.google.com/maps/dir/?api=1&origin=' + encodeURIComponent(origin) + '&destination=' + encodeURIComponent(destination);

    // Ouvrir une nouvelle fenêtre ou un nouvel onglet avec l'URL de l'itinéraire
    window.open(url, '_blank');
});

      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
      }
    });
}

// Fonction pour charger de façon asynchrone le script de l'API Google Maps
function loadGoogleMapsScript() {
    // Vérifiez si l'API Google Maps est déjà chargée
    if (typeof google === 'object' && typeof google.maps === 'object') {
      // L'API Google Maps est déjà chargée, appelez la fonction de rappel directement
      initMap();
    } else {
      // L'API Google Maps n'est pas encore chargée, chargez le script de l'API
      var script = document.createElement('script');
      script.src = 'API';
      script.async = true;
  
      // Attachez la fonction de rappel à l'objet `window` pour qu'elle soit appelée une fois le script chargé
      window.initMap = initMap;
  
      // Ajoutez le script au corps du document
      document.body.appendChild(script);
    }
  }
  
  // Appelez la fonction pour charger le script de l'API Google Maps
  loadGoogleMapsScript();
