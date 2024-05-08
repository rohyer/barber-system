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
    <h1 class="client__title">Clientes</h1>
  
    <div class="client__data">
      <div class="client__options" style="display: none">
        <span class="client__categories" data-state="true">Ativos</span>
        <span class="client__categories" data-state="false">Desativos</span>
      </div>

      <table class="client__table">
        <tr>
          <th>Nome</th>
          <th>Último Atendimento</th>
          <th>Idade</th>
          <th>Sexo</th>
        </tr>
        <?php
        foreach ($result as $r) {
          $date = new DateTime($r["birth"]);
          $now = new DateTime();
          $age = $now->diff($date);

          echo "<tr>";
          echo "<td>" . $r["name"] . "</td>";
          echo "<td>" . "</td>";
          echo "<td>" . $age->y . "</td>";
          echo "<td>" . $r["sex"] . "</td>";
          echo "<td><i class='fa-solid fa-trash'></i></td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>

  </div>
  
</body>
</html>