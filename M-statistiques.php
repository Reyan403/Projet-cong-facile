<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/affichage-statistiques.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Mentalworks</title>
</head>
<body>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menu-manager.php'; ?>

    <div class="content-bloc">
      <h1>Statistiques</h1>

      <h3>Types de demandes sur l'année</h3>
      <canvas id="typeDemandesChart" style="max-width: 600px; margin-bottom: 40px;"></canvas>

      <h3>Pourcentage d'acceptation des demandes sur l'année</h3>
      <canvas id="acceptationChart" style="max-width: 700px;"></canvas>
    </div>
</section>

    <script>
    // Données PHP injectées
    const labels = <?= json_encode($labels) ?>;
    const values = <?= json_encode($values) ?>;

    // Générer automatiquement des couleurs si besoin
    const backgroundColors = [
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 205, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(201, 203, 207, 0.8)'
    ];

    const doughnutData = {
        labels: labels,
        datasets: [{
        data: values,
        backgroundColor: backgroundColors.slice(0, labels.length),
        borderWidth: 1
        }]
    };

    const doughnutConfig = {
        type: 'doughnut',
        data: doughnutData,
        options: {
        responsive: true,
        plugins: {
            legend: { position: 'right' },
            title: { display: false }
        }
        }
    };

    new Chart(document.getElementById('typeDemandesChart'), doughnutConfig);

    // Données statiques pour le graphique en ligne
   const lineData = {
    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    datasets: [{
      label: '% acceptées',
      data: <?= json_encode($monthlyPercentages) ?>,
      fill: false,
      borderColor: 'rgba(54, 162, 235, 1)',
      tension: 0.3
    }]
  };

  const lineConfig = {
    type: 'line',
    data: lineData,
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: false }
      },
      scales: {
        y: {
          min: 0,
          max: 100,
          ticks: {
            callback: value => value + '%'
          },
          title: { display: true, text: '% acceptées' }
        },
        x: {
          title: { display: true, text: 'Mois de l’année' }
        }
      }
    }
  };

  new Chart(document.getElementById('acceptationChart'), lineConfig);
    </script>

<script src="script.js"></script>
</body>
</html>
