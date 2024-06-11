// Récupération des données nécessaires depuis PHP (par exemple, dans une variable PHP $data)

document.addEventListener('DOMContentLoaded', function() {
    //tester si la variable ne contient pas de données dans les données issues de PHP
    if (typeof jsonDonneesGraphique !== 'undefined' && jsonDonneesGraphique !== null) {
        console.log(jsonDonneesGraphique);
      donnees = jsonDonneesGraphique;
      var ctx = document.getElementById('graphique').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: donnees.mois,
          datasets: [{
            label: 'Prix Total des articles vendus par mois',
            data: donnees.totalArticlesVendus,
            backgroundColor: 'rgba(0, 123, 255, 0.5)',

          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value, index, values) {
                  return value + ' €';
                }
              }
            }
          }
        }
      });

    }
  });
