<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <title>Dashboard</title>
  <script src="https://kit.fontawesome.com/5d76c62972.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../dist/css/style.min.css">
  <script type="module" src="../dist/js/all.js"></script>
</head>

<body>

  <?php include dirname(__DIR__) . "/view/components/nav.php"; ?>

  <div class="general__content">
    <div class="general__top">
      <h1 class="general__title">Dashboard</h1>
    </div>

    <div class="home__cards">
      <div class="home__first-row">
        <div class="home__card">
          <h3 class="home__card-title">Dados do mês atual</h3>

          <p class="home__card-text">Atendimentos feitos: <?php echo $amountClosedCustomerService[0]["amount"]; ?></p>
          <p class="home__card-text">Previsão de atendimentos: <?php echo $amountOpenCustomerService[0]["amount"]; ?></p>
          <p class="home__card-text">Faturamento: R$ <?php echo $closedValue[0]['value']; ?></p>
          <p class="home__card-text">Valor a entrar: R$ <?php echo $openValue[0]['value']; ?></p>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Atendimentos por serviços</h3>
          <div class="home__chart">
            <canvas id="chartDataByServices"></canvas>
          </div>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Atendimentos por colaboradores</h3>
          <div class="home__chart">
            <canvas id="chartDataByEmployee"></canvas>
          </div>
        </div>
      </div>
      <div class="home__second-row">
        <div class="home__card">
          <h3 class="home__card-title">Dias da semana com mais atendimentos</h3>

          <div class="home__chart">
            <canvas id="chartDataByWeekend"></canvas>
          </div>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Atendimentos por mês</h3>

          <div class="home__chart">
            <canvas id="chartDataByMonths"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  $amountByService = [];
  $services = [];
  for ($i = 0; $i < count($dataByService); $i++) :
    $amountByService[$i] = $dataByService[$i]["amount_by_service"];
    $services[$i] = $dataByService[$i]["service"];
  endfor;

  $amountByEmployee = [];
  $employee = [];

  for ($i = 0; $i < count($dataByEmployee); $i++) :
    $amountByEmployee[$i] = $dataByEmployee[$i]["amount_by_employee"];
    $employee[$i] = $dataByEmployee[$i]["employee"];
  endfor;

  $customerServiceByWeekend = [
    "Sunday" => 0,
    "Monday" => 0,
    "Tuesday" => 0,
    "Wednesday" => 0,
    "Thursday" => 0,
    "Friday" => 0,
    "Saturday" => 0,
  ];

  foreach ($dateByWeekend as $value) {
    $nameOfDay = date('l', strtotime($value["date"]));
    $customerServiceByWeekend[$nameOfDay]++;
  }

  ?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const dataByService = document.getElementById('chartDataByServices');
    const dataByEmployee = document.getElementById('chartDataByEmployee');
    const dataByWeekend = document.getElementById('chartDataByWeekend');
    const dataByMonths = document.getElementById('chartDataByMonths');

    new Chart(dataByService, {
      type: 'doughnut',
      data: {
        labels: <?= json_encode($services) ?>,
        datasets: [{
          label: '# atendimentos',
          data: <?= json_encode($amountByService) ?>,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Chart.js Doughnut Chart'
          }
        }
      },
    });

    new Chart(dataByEmployee, {
      type: 'doughnut',
      data: {
        labels: <?= json_encode($employee) ?>,
        datasets: [{
          label: '# atendimentos',
          data: <?= json_encode($amountByEmployee) ?>,
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Chart.js Doughnut Chart'
          }
        }
      },
    });

    new Chart(dataByWeekend, {
      type: 'bar',
      data: {
        datasets: [{
          label: "",
          data: <?= json_encode([
                  "Domingo" => $customerServiceByWeekend["Sunday"],
                  "Segunda" => $customerServiceByWeekend["Monday"],
                  "Terça" => $customerServiceByWeekend["Tuesday"],
                  "Quarta" => $customerServiceByWeekend["Wednesday"],
                  "Quinta" => $customerServiceByWeekend["Thursday"],
                  "Sexta" => $customerServiceByWeekend["Friday"],
                  "Sábado" => $customerServiceByWeekend["Saturday"]
                ]) ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.4)',
            'rgba(255, 159, 64, 0.4)',
            'rgba(255, 205, 86, 0.4)',
            'rgba(75, 192, 192, 0.4)',
            'rgba(54, 162, 235, 0.4)',
            'rgba(153, 102, 255, 0.4)',
            'rgba(201, 203, 207, 0.4)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1

        }]
      },
      options: {
        responsive: true,
        plugins: {
          filler: {
            propagate: false,
          },
          title: {
            display: true,
            text: (ctx) => 'Fill: ' + ctx.chart.data.datasets[0].fill
          }
        },
        interaction: {
          intersect: false,
        },
        scale: {
          ticks: {
            precision: 0
          },
          y: {
            beginAtZero: true
          }
        },
      },
    });

    new Chart(dataByMonths, {
      type: 'bar',
      data: {
        datasets: [{
          label: "",
          data: <?= json_encode($dataByMonths) ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.8)',
            'rgba(255, 159, 64, 0.8)',
            'rgba(255, 205, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(153, 122, 255, 0.8)',
            'rgba(201, 193, 207, 0.8)',
            'rgba(201, 203, 207, 0.8)',
            'rgba(201, 223, 207, 0.8)',
            'rgba(201, 233, 207, 0.8)',
            'rgba(201, 73, 207, 0.8)',
            'rgba(201, 53, 207, 0.8)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            'rgb(201, 193, 207)',
            'rgb(201, 203, 207)',
            'rgb(201, 223, 207)',
            'rgb(201, 233, 207)',
            'rgb(201, 73, 207)',
            'rgb(201, 53, 207)'
          ],
          borderWidth: 1

        }]
      },
      options: {
        responsive: true,
        plugins: {
          filler: {
            propagate: false,
          },
          title: {
            display: true,
            text: (ctx) => 'Fill: ' + ctx.chart.data.datasets[0].fill
          }
        },
        interaction: {
          intersect: false,
        },
        scale: {
          ticks: {
            precision: 0
          },
          y: {
            beginAtZero: true
          }
        },
      },
    });
  </script>

</body>

</html>