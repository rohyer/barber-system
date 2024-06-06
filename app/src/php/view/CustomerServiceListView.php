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
      <h1 class="general__title">Agenda</h1>
      <a href="agenda/cadastro"><i class="fa-solid fa-plus"></i></a>
    </div>

    <div class="schedule-list__data">
      <div class="schedule-list__options" style="display: none">
        <span class="schedule-list__categories" data-state="true">Ativos</span>
        <span class="schedule-list__categories" data-state="false">Desativos</span>
      </div>

      <div class="schedule-list__list">
        <div class="schedule-list__head-row">
          <span>Cliente</span>
          <span>Serviço</span>
          <span>Data</span>
          <span>Horário</span>
        </div>

        <?php
        foreach ($result as $r) : ?>

          <div class='schedule-list__row'>
            <a href='#'></a>
            <span><?php echo $r["client"] ?> </span>
            <span><?php echo $r["service"] ?></span>
            <span><?php echo $r["date"] ?></span>
            <span><?php echo $r["time"] ?></span>
            <span class="schedule-list__edit">
              <a href="atendimento/edita?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </span>
            <span class="schedule-list__delete">
              <a href="atendimento/deleta?id=<?php echo $r["id"] ?>">
                <i class='fa-solid fa-trash'></i>
              </a>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>