<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <table>
    <tr>
      <th>Nome</th>
    </tr>
    <?php
    foreach ($result as $r) {
      echo "<tr><td>" . $r["name"] . "</td></tr>";
    }
    ?>
  </table>
  
</body>
</html>