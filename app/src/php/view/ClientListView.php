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

  <div class="client__content">
    <div class="client__top">
      <h1 class="client__title">Clientes</h1>
      <a href="cliente/cadastro"><i class="fa-solid fa-plus"></i></a>
    </div>

    <div class="client__data">
      <div class="client__options" style="display: none">
        <span class="client__categories" data-state="true">Ativos</span>
        <span class="client__categories" data-state="false">Desativos</span>
      </div>

      <div class="client__list">
        <div class="client__head-row">
          <span>Nome</span>
          <span>Contato</span>
          <span>Idade</span>
          <span>Sexo</span>
        </div>

        <?php
        foreach ($result as $r) :
          $date = new DateTime($r["birth"]);
          $now = new DateTime();
          $age = $now->diff($date);
        ?>

          <div class='client__row'>
            <a href='#'></a>
            <span><?php echo $r["name"] ?></span>
            <span><?php echo $r["phone"] ?></span>
            <span><?php echo $age->y ?></span>
            <span><?php echo $r["sex"] ?> </span>
            <span class="client__edit">
              <a href="cliente/edita?id=<?php echo $r["id"] ?>">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
            </span>
            <span class="client__delete">
              <a href="cliente/deleta?id=<?php echo $r["id"] ?>">
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