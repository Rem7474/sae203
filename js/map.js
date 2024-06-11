// Fonction de rappel appelée lorsque l'API Google Maps est chargée
function initMap() {
    // Créez une instance de l'autocomplétion d'adresse Google Maps
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('adresse'));
  
    // Écoutez l'événement de sélection d'une adresse complète
    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      
      // Vérifiez si une adresse complète a été sélectionnée
      if (place && place.formatted_address) {
        var adresseComplete = place.formatted_address;
    
        // Extraire l'adresse uniquement
        var adresse = adresseComplete.split(',')[0].trim();
        var cpville = adresseComplete.split(',')[1].trim();
        var cp = cpville.split(' ')[0].trim();
        //a partie de 1 jusqu'à la fin
        var ville = cpville.split(' ').slice(1).join(' ');
        var pays = adresseComplete.split(',')[2].trim();
        // Remplir un autre champ du formulaire avec l'adresse
        //on mes les valeurs dans les champs du formulaire
        $('#adresse').val(adresse);
        $('#ville').val(ville);
        $('#codePostal').val(cp);
        $('#pays').val(pays);
        
        
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
      script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAUPKPo6osvXu7VzHClxqeV8Oo3pb0wQMY&libraries=places&callback=initMap';
      script.async = true;
  
      // Attachez la fonction de rappel à l'objet `window` pour qu'elle soit appelée une fois le script chargé
      window.initMap = initMap;
  
      // Ajoutez le script au corps du document
      document.body.appendChild(script);
    }
  }
  
  // Appelez la fonction pour charger le script de l'API Google Maps
  loadGoogleMapsScript();
  