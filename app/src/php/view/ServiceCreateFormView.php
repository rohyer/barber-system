<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <title>Cadastro de Clientes</title>
  <script src="https://kit.fontawesome.com/5d76c62972.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../dist/css/style.min.css">
</head>

<body>
  <?php include dirname(__DIR__) . "/view/components/nav.php"; ?>

  <div class="general__content">
    <div class="general__top">
      <h1 class="general__title">Clientes</h1>
    </div>

    <form action="cadastro" method="post" class="form__form">
      <div class="form__input-field">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name">
        <div class="bar"></div>
        <span class="form__error"><?php echo isset($result["name"]) ? $result["name"] : ""; ?></span>
      </div>
      
      <div class="form__input-field">
        <label for="value">Preço:</label>
        <input type="text" id="value" name="value">
        <div class="bar"></div>
        <span class="form__error"><?php echo isset($result["value"]) ? $result["value"] : ""; ?></span>
      </div>

      <div class="form__input-field">
        <input type="submit" value="Cadastrar">
      </div>
    </form>
  </div>

  <script type="module" src="../../dist/js/all.js"></script>
</body>

</html>