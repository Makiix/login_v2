<?php
$salt = bin2hex(random_bytes(8));

if (isset($_POST['user']) && isset($_POST['password'])) {
  $new_user = [
    'user' => hash('sha256', $_POST['user']),
    'password' => hash('sha256', $_POST['password']),
    'salt' => $salt
  ];

  $file_contents = file_get_contents('users.json');
  $user = json_decode($file_contents, true);
  $user[] = $new_user;
  $json_data = json_encode($user, JSON_PRETTY_PRINT);

  file_put_contents('users.json', $json_data);
  header('Location: index.php?msg=success');
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/registro_style.css">
  <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
  <title>Alienados - Registro</title>
</head>

<body>
  <div>
    <form action="registro.php" method="post">
      <label for="usuario">Usuário:</label>
      <input type="text" name="user" id="usuario" required>

      <label for="senha">Senha:</label>
      <input type="password" name="password" id="senha" minlength="6" required>

      <input type="submit" value="Cadastrar" class="botao">

      <p><a href="index.php"> ↞ Voltar</a></p>
    </form>
  </div>
</body>

</html>