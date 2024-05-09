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
  <link rel="stylesheet" href="../dist/css/style.min.css">
</head>
<body>

<?php include dirname(__DIR__) . "/view/components/nav.php"; ?>

<div class="client__content">
  <h1 class="client__title">Clientes</h1>

  <form action="formulario-cliente" method="post" class="client__form">
    <div class="client__input-field">
      <label for="name">Nome:</label>
      <input type="text" id="name" name="name">
      <div class="bar"></div>
      <span><?php echo $result["name"]; ?></span>
    </div>
    
    <div class="client__input-field">
      <label for="sex">Sexo:</label>
      <input type="text" id="sex" name="sex">
      <div class="bar"></div>
      <span><?php echo $result["sex"]; ?></span>
    </div>
    
    <div class="client__input-field">
      <label for="address">Endereço:</label>
      <input type="text" id="address" name="address">
      <div class="bar"></div>
      <span><?php echo $result["address"]; ?></span>
    </div>
    
    <div class="client__input-field">
      <label for="birth">Data de Nascimento:</label>
      <input type="text" id="birth" name="birth">
      <div class="bar"></div>
      <span><?php echo $result["birth"]; ?></span>
    </div>
    
    <div class="client__input-field">
      <label for="phone">Telefone:</label>
      <input type="text" id="phone" name="phone">
      <div class="bar"></div>
      <span><?php echo $result["phone"]; ?></span>
    </div>
    
    <div class="client__input-field">
      <input type="submit" value="Cadastrar">
    </div>
  </form>
</div>

</body>
</html>