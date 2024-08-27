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
  <script type="module" src="../dist/js/all.js"></script>
</head>

<body>

  <div class="register">
    <div class="register__logo">
      <img src="../assets/barbers-logo.png" alt="Logo">
    </div>
    <div class="register__form">
      <form action="cadastro" method="post">
        <h1>Crie sua conta</h1>
        <p>Se já possui um conta clique <a href="">aqui</a>.</p>
        <label for="nome">Nome</label>
        <input type="text" name="name" required>

        <label for="email">E-mail</label>
        <input type="text" name="email" required>

        <label for="password">Senha</label>
        <input type="password" name="password" required>

        <!-- <label for="state">Estado</label>
        <input type="text" name="state" required>

        <label for="city">Cidade</label>
        <input type="text" name="city" required>

        <label for="sex">Sexo</label>
        <select name="sex" id="sex" required>
          <option value="M">Masculino</option>
          <option value="F">Feminino</option>
        </select>

        <label for="birth">Data de Nascimento</label>
        <input type="date" name="birth" required>

        <label for="phone">Telefone</label>
        <input type="text" name="phone" required> -->

        <button type="submit">Cadastrar</button>

      </form>
    </div>
  </div>


</body>

</html>