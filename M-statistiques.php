<?php
include 'includes/db.php';
include 'includes/affichage-avatar.php';
include 'includes/affichage-statistique.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <title>Mentalworks</title>
    </head>
<body>
<?php
include 'includes/header.php';
include 'includes/menu-manager.php';
?>
        <div class="content-bloc3">
            <h1>
                Statistiques
            </h1>
            <h3>
                Types de demandes sur l'année
            </h3>
            <canvas id="typeDemandesChart" style="max-width: 600px; width: 100%"></canvas>
            
            <div class="statistics-traits">
                <h3>
                    Pourcentage d'acceptation des demandes sur l'année
                </h3>
                <canvas id="acceptationChart" style="max-width: 700px;"></canvas>
            </div>
        </div>
    </section>

    <script>
    const labels = <?= json_encode($labels) ?>;
    const values = <?= json_encode($values) ?>;

    const defaultColors = [
    'rgba(54, 162, 235, 0.8)',
    'rgba(255, 205, 86, 0.8)',
    'rgba(75, 192, 192, 0.8)',
    'rgba(255, 99, 132, 0.8)',
    'rgba(153, 102, 255, 0.8)',
    'rgba(255, 159, 64, 0.8)',
    'rgba(201, 203, 207, 0.8)'
    ];

    const hasData = values.some(value => value > 0);
    const safeValues = hasData ? values : labels.map(() => 1); 
    const note = hasData ? '' : '';

    const doughnutData = {
    labels: labels.map(label => hasData ? label : `${label} (0)`),  
    datasets: [{
        data: safeValues,
        backgroundColor: defaultColors.slice(0, labels.length),
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
        title: {
            display: !hasData,
            text: note
        },
        tooltip: {
            callbacks: {
            label: function(context) {
                return hasData
                ? `${context.label}: ${values[context.dataIndex]}`
                : `${labels[context.dataIndex]}: 0`;
            }
            }
        }
        }
    }
    };

    new Chart(document.getElementById('typeDemandesChart'), doughnutConfig);
    </script>

    <script src="script.js"></script>
</body>
</html>
