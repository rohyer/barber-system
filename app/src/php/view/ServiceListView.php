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
      <h1 class="general__title">Serviços</h1>
      <a href="servico/cadastro"><i class="fa-solid fa-plus"></i></a>
    </div>

    <div class="card__data">
      <div class="card__group">
        <?php
        foreach ($result as $r) :?>
          <div class='card__card'>
            <p class="card__title"><?php echo $r["name"]; ?></p>
            <p class="card__value">Preço: R$ <?php echo $r["value"]; ?></p>

            <div class="card__options">
              <span class="card__edit">
                <a href="servico/edita?id=<?php echo $r["id"] ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
              </span>
              <span class="card__delete">
                <a href="servico/deleta?id=<?php echo $r["id"] ?>">
                  <i class='fa-solid fa-trash'></i>
                </a>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>