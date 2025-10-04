<?php
// CRUCIAL: Inicia a sessão. DEVE ser a primeira linha executável do PHP.
session_start(); 

// Inclui o arquivo de conexão, permitindo usar a variável $conexao
require_once 'conexao.php';

$mensagem_status = "";
$sucesso = false;

// O script só será executado se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Coletar os dados do formulário
    // mysqli_real_escape_string previne ataques de SQL Injection 
    $usuario_digitado = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha_digitada = $_POST['password'];

    // 1. Prepara e executa a consulta para buscar o usuário
    $sql = "SELECT id, username, password FROM usuarios WHERE username = '$usuario_digitado'";
    $resultado = mysqli_query($conexao, $sql);
    
    // 2. Verifica se o usuário foi encontrado
    if (mysqli_num_rows($resultado) == 1) {
        $linha = mysqli_fetch_assoc($resultado);
        $hash_senha_bd = $linha['password']; 
        
        // 3. Verifica a senha digitada com o hash armazenado
        if (password_verify($senha_digitada, $hash_senha_bd)) {
            
            // Autenticação bem-sucedida
            $sucesso = true;
            
            // 1. SALVA OS DADOS NA SESSÃO
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $linha['id']; 
            $_SESSION['username'] = $linha['username']; 

            // 2. Fecha a conexão
            mysqli_close($conexao);
            
            // 3. REDIRECIONA IMEDIATAMENTE e ENCERRA
            // CORREÇÃO: Redireciona para dashboard.php (o novo nome do Painel)
            header("Location: dashboard.php"); 
            exit(); 
            
        } else {
            // Senha incorreta
            $mensagem_status = "<h2 class='text-danger'>Usuário ou senha incorretos!</h2>";
        }
    } else {
        // Usuário não encontrado
        $mensagem_status = "<h2 class='text-danger'>Usuário ou senha incorretos!</h2>";
    }
}
// Se o login falhou ou não houve submissão, fecha a conexão no final
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