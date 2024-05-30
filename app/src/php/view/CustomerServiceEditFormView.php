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
      <h1 class="general__title">Atendimentos</h1>
    </div>

    <form action="edita?id=<?php echo $id ?>" method="post" class="form__form">
      <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"]; ?>" readonly>
      <div class="form__input-field">
        <label for="date">Data:</label>

        <div class="form__input-fied--group">
          <input type="date" id="date" name="date" value="<?php echo isset($result[0]) ? $result[0]["date"] : ""; ?>">
          <div class="bar"></div>
          <span class="form__error"><?php echo isset($result["date"]) ? $result["date"] : ""; ?></span>
        </div>
      </div>

      <div class="form__input-field">
        <label for="time">Horário:</label>

        <div class="form__input-fied--group">
          <input type="time" id="time" name="time" value="<?php echo isset($result[0]) ? $result[0]["time"] : ""; ?>">
          <div class="bar"></div>
          <span class="form__error"><?php echo isset($result["time"]) ? $result["time"] : ""; ?></span>
        </div>
      </div>

      <div class="form__input-field">
        <label for="client">Cliente:</label>
        <div class="form__input-field--group">
          <select name="client" id="client">
            <option value="<?php echo $client["id"] ?>" selected><?php echo $client["name"] ?></option>
            <!-- <?php foreach ($clientData as $client) : ?>
            <?php endforeach; ?>
            <option value="M" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "M") ? "selected" : ""; ?>>Masculino</option>
            <option value="F" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "F") ? "selected" : ""; ?>>Feminino</option>
            <option value="Outro" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "Outro") ? "selected" : ""; ?>>Outro</option> -->
          </select>
          <div class="bar"></div>
        </div>
        <span class="form__error"><?php echo isset($result["client"]) ? $result["client"] : ""; ?></span>
      </div>

      <div class="form__input-field">
        <input type="submit" value="Cadastrar">
      </div>
    </form>
  </div>

  <script type="module" src="../../dist/js/all.js"></script>
</body>

</html>