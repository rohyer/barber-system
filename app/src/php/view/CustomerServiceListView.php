<?php

$formatter = new IntlDateFormatter(
  "pt_BR",
  IntlDateFormatter::RELATIVE_LONG,
  IntlDateFormatter::NONE,
  "America/Sao_Paulo",
  IntlDateFormatter::GREGORIAN,
);

?>

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

    <div class="list__data">
      <div class="list__options">
        <span class="list__categories" data-state="true">Ativos</span>
        <span class="list__categories" data-state="false">Desativos</span>
      </div>

      <div class="list__list">
        <div class="list__head-row">
          <span>Data</span>
          <span>Cliente</span>
          <span>Serviço</span>
          <span>Colaborador</span>
        </div>

        <?php
        foreach ($resultOpen as $r) :
          $phone = str_replace(array("(", ")", "-", " "), "", $r["phone"]);
          $date = new DateTime($r["date"], new DateTimeZone("America/Sao_Paulo")); ?>

          <div class='list__row'>
            <!-- <a href='#'></a> -->
            <span>
              <div><?php echo $formatter->format($date) ?></div>
              <div class="list__time"><?php echo $r["time"] ?></div>
            </span>
            <span>
              <div><?php echo $r["client"] ?></div>
              <a href="https://api.whatsapp.com/send?phone=55<?php echo $phone ?>" target="_blank" rel="noopener noreferrer" class="list__time">
                <?php echo $r["phone"] ?>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
              </a>
            </span>
            <span><?php echo $r["service"] ?></span>
            <span>
              <?php echo $r["employee"]; ?>
            </span>
            <span class="list__close">
              <a href="agenda/conclui?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-circle-check"></i>
              </a>
            </span>
            <span class="list__edit">
              <a href="agenda/edita?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </span>
            <span class="list__delete">
              <a href="agenda/deleta?id=<?php echo $r["id"] ?>">
                <i class='fa-solid fa-trash'></i>
              </a>
            </span>
          </div>
        <?php endforeach; ?>
        <?php
        foreach ($resultClosed as $r) :
          $phone = str_replace(array("(", ")", "-", " "), "", $r["phone"]);
          $date = new DateTime($r["date"], new DateTimeZone("America/Sao_Paulo")); ?>

          <div class='list__row'>
            <!-- <a href='#'></a> -->
            <span>
              <div><?php echo $formatter->format($date) ?></div>
              <div class="list__time"><?php echo $r["time"] ?></div>
            </span>
            <span>
              <div><?php echo $r["client"] ?></div>
              <a href="https://api.whatsapp.com/send?phone=55<?php echo $phone ?>" target="_blank" rel="noopener noreferrer" class="list__time">
                <?php echo $r["phone"] ?>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
              </a>
            </span>
            <span><?php echo $r["service"] ?></span>
            <span>
              <?php echo $r["employee"]; ?>
            </span>
            <span class="list__close">
              <a href="agenda/abre?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-circle-xmark"></i>
              </a>
            </span>
            <span class="list__edit">
              <a href="agenda/edita?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </span>
            <span class="list__delete">
              <a href="agenda/deleta?id=<?php echo $r["id"] ?>">
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