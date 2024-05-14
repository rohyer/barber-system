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

  <div class="client__content">
    <div class="client__top">
      <h1 class="client__title">Clientes</h1>
    </div>

    <form action="edita" method="post" class="client__form">
      <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"]; ?>" readonly>
      <div class="client__input-field">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($result[0]) ? $result[0]["name"] : ""; ?>">
        <div class="bar"></div>
        <span class="client__error"><?php echo isset($result["name"]) ? $result["name"] : ""; ?></span>
      </div>

      <div class="client__input-field">
        <label for="sex">Sexo:</label>
        <div class="client__input-field--group">
          <select name="sex" id="sex">
            <option value="M" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "M") ? "selected" : ""; ?>>Masculino</option>
            <option value="F" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "F") ? "selected" : ""; ?>>Feminino</option>
            <option value="Outro" <?php echo (isset($result[0]["sex"]) && $result[0]["sex"] === "Outro") ? "selected" : ""; ?>>Outro</option>
          </select>
          <div class="bar"></div>
        </div>
        <span class="client__error"><?php echo isset($result["sex"]) ? $result["sex"] : ""; ?></span>
      </div>

      <div class="client__input-field">
        <label for="address">Endereço:</label>
        <input type="text" id="address" name="address" value="<?php echo isset($result[0]) ? $result[0]["address"] : ""; ?>">
        <div class="bar"></div>
        <span class="client__error"><?php echo isset($result["address"]) ? $result["address"] : ""; ?></span>
      </div>

      <div class="client__input-field">
        <label for="input-birth">Data de Nascimento:</label>
        <div class="client__input-field--group">

          <input type="date" name="birth" id="input-birth" value="<?php echo isset($result[0]) ? $result[0]["birth"] : ""; ?>">
          <div class="bar"></div>
        </div>
        <span class="client__error"><?php echo isset($result["birth"]) ? $result["birth"] : ""; ?></span>
      </div>

      <div class="client__input-field">
        <label for="input-phone">Telefone:</label>
        <input type="text" maxlength="15" id="input-phone" name="phone" value="<?php echo isset($result[0]) ? $result[0]["phone"] : ""; ?>">
        <div class="bar"></div>
        <span class="client__error"><?php echo isset($result["phone"]) ? $result["phone"] : ""; ?></span>
      </div>

      <div class="client__input-field">
        <input type="submit" value="Cadastrar">
      </div>
    </form>
  </div>

  <script type="module" src="../../dist/js/all.js"></script>
</body>

</html>