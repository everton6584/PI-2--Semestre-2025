<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Logo">
        <h2>Login</h2>
        <form action="login.php" method="post">
          <input type="text" name="username" placeholder="Usuário" required>
          <input type="password" name="password" placeholder="Senha" required>
          <input type="submit" value="Entrar">
        </form>
        <div class="links">
          <a href="#">Cadastrar</a>
          <a href="#">Esqueceu a senha?</a>
        </div>
      </div>   
</body>
</html>

