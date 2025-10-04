<?php

session_start(); 

require_once 'conexao.php';

$mensagem_status = "";
$sucesso = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 
    $usuario_digitado = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha_digitada = $_POST['password'];


    $sql = "SELECT id, username, password FROM usuarios WHERE username = '$usuario_digitado'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
        $hash_senha_bd = $linha['password']; 
        
        
        if (password_verify($senha_digitada, $hash_senha_bd)) {
      
            $sucesso = true;
            
            
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $linha['id']; 
            $_SESSION['username'] = $linha['username']; 

            
            mysqli_close($conexao);
            
            
            header("Location: dashboard.php"); 
            exit(); 
            
        } else {
        
            $mensagem_status = "<h2 class='text-danger'>Usuário ou senha incorretos!</h2>";
        }
    } else {
       
        $mensagem_status = "<h2 class='text-danger'>Usuário ou senha incorretos!</h2>";
    }
}

if (isset($conexao) && !$sucesso) {
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/Style.css"> 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg login-container">
        <div class="card-body">
            
            <?php if ($mensagem_status): ?>
                <div class="status-message text-center mb-4">
                    <?php echo $mensagem_status; ?>
                </div>
                
                <?php if (!$sucesso): ?>
                    <div class="text-center mt-3">
                        <a href="login.php" class="btn btn-secondary w-100">Tentar Novamente</a>
                    </div>
                <?php endif; ?>
                
            <?php endif; ?>

            <?php if (!$mensagem_status): ?>
                <h2 class="card-title text-center mb-4">User Login</h2> 

                <form action="login.php" method="POST">
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Digite seu usuário" required>
                    </div>
                    
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-2 login-btn">LOGIN</button>
                </form>

                <div class="links text-center mt-3">
                    <a href="#" class="d-block text-muted">Esqueci a Senha</a>
                    <a href="#" class="d-block text-muted">Criar uma nova conta</a>
                </div>
            <?php endif; ?>
        </div>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>