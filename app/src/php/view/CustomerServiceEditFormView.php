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

        <div class="form__input-field--group">
          <input type="date" id="date" name="date" value="<?php echo isset($result[0]) ? $result[0]["date"] : ""; ?>">
          <div class="bar"></div>
          <span class="form__error"><?php echo isset($result["date"]) ? $result["date"] : ""; ?></span>
        </div>
      </div>

      <div class="form__input-field">
        <label for="time">Horário:</label>

        <div class="form__input-field--group">
          <input type="time" id="time" name="time" value="<?php echo isset($result[0]) ? $result[0]["time"] : ""; ?>">
          <div class="bar"></div>
          <span class="form__error"><?php echo isset($result["time"]) ? $result["time"] : ""; ?></span>
        </div>
      </div>

      <div class="form__input-field">
        <label for="client">Cliente:</label>
        <div class="form__input-field--group">
          <select name="client" id="client">
            <option value="<?php echo $result[0]["id_client"] ?>" selected><?php echo $result[0]["client"] ?></option>

            <?php foreach ($dataClient as $client) :
              if ($result[0]["id_client"] === $client["id"]) :
                continue;
              endif;
            ?>

              <option value="<?php echo $client["id"]; ?>"><?php echo $client["name"]; ?></option>
            <?php endforeach; ?>
          </select>
          <div class="bar"></div>
        </div>
        <span class="form__error"><?php echo isset($result["client"]) ? $result["client"] : ""; ?></span>
      </div>

      <div class="form__input-field">
        <label for="employee">Colaborador:</label>
        <div class="form__input-field--group">
          <select name="employee" id="employee">
            <option value="<?php echo $result[0]["id_employee"] ?>" selected><?php echo $result[0]["employee"] ?></option>

            <?php
            foreach ($dataEmployee as  $employee) :
              if ($result[0]["id_employee"] === $employee["id"]) :
                continue;
              endif;
            ?>
              <option value="<?php echo $employee["id"]; ?>"><?php echo $employee["name"]; ?></option>
            <?php endforeach ?>
          </select>
          <div class="bar"></div>
        </div>
        <span class="form__error"><?php echo isset($result["employee"]) ? $result["employee"] : ""; ?></span>
      </div>

      <div class="form__input-field">
        <label for="service">Serviço:</label>
        <div class="form__input-field--group">
          <select name="service" id="service">
            <option value="<?php echo $result[0]["id_service"] ?>" selected><?php echo $result[0]["service"] ?></option>

            <?php
            foreach ($dataService as  $service) :
              if ($result[0]["id_service"] === $service["id"]) :
                continue;
              endif;
            ?>
              <option value="<?php echo $service["id"]; ?>"><?php echo $service["name"]; ?></option>
            <?php endforeach ?>
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