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
          <h3 class="home__card-title">Atendimentos em <?php echo date("F"); ?></h3>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Atendimentos por serviços</h3>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Atendimentos por colaboradores</h3>
        </div>
      </div>
      <div class="home__second-row">
        <div class="home__card">
          <h3 class="home__card-title">
            Dias da semana com mais atendimentos
          </h3>
        </div>
        <div class="home__card">
          <h3 class="home__card-title">Clientes menos frequentes</h3>
        </div>
      </div>
    </div>
  </div>


</body>

</html>