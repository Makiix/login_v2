<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index_style.css">
  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
  <title>Alienados - Login</title>
</head>

<body>
  <div>
    <img src="./imagens/logo.png" alt="logomarca" title="logomarca" width="180px" height="180px">

    <form action="index.php" method="post">
      <label for="user">Usuário:</label>
      <input type="text" name="user" id="user" required>

      <label for="password">Senha:</label>
      <input type="password" name="password" id="senha" required>

      <input type="submit" value="Entrar" class="botao">

      <p><a href="registro.php">Cadastre-se</a></p>
    </form>
  </div>
</body>

</html>

<?php
if (isset($_COOKIE['login'])) {
  header('Location: dashboard.html');
  exit;
}
if (isset($_GET['erro'])) { ?>
<script>
alert("Usuário ou senha incorreto.")
</script><?php } ?>

<?php
if (isset($_POST['user']) && isset($_POST['password'])) {
  $user = hash('sha256', $_POST['user']);
  $password = hash('sha256', $salt . $_POST['password']);
  $users = file_get_contents('users.json');
  $usuarios = json_decode($users, true);

  foreach ($usuarios as $usuario) {
    if ($usuario['user'] == $user && $usuario['password'] == $password) {
      session_start();
      $_SESSION['user'] = $user;

      setcookie('login', 'true', time() + 60);

      header('Location: dashboard.html');
      exit;
    }
  }
  header('Location: index.php?erro=1');
  exit;
}
?>