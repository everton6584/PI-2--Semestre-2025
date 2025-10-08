<?php

session_start();
require_once 'conexao.php'; 

$mensagem_status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $usuario_novo = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha_nova = $_POST['password'];
    $senha_confirmar = $_POST['confirm_password'];

    
    if (empty($usuario_novo) || empty($senha_nova) || empty($senha_confirmar)) {
        $mensagem_status = "<h4 class='text-danger'>Preencha todos os campos.</h4>";
    } elseif ($senha_nova !== $senha_confirmar) {
        $mensagem_status = "<h4 class='text-danger'>As senhas não coincidem.</h4>";
    } elseif (strlen($senha_nova) < 6) {
        $mensagem_status = "<h4 class='text-danger'>A senha deve ter pelo menos 6 caracteres.</h4>";
    } else {
        
       
        $sql_check = "SELECT id FROM usuarios WHERE username = '$usuario_novo'";
        $resultado_check = mysqli_query($conexao, $sql_check);
        
        if (mysqli_num_rows($resultado_check) > 0) {
            $mensagem_status = "<h4 class='text-danger'>Usuário '$usuario_novo' já existe.</h4>";
        } else {
            
       
            $hash_senha = password_hash($senha_nova, PASSWORD_DEFAULT);
            
            
            $sql_insert = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
            
            $stmt = mysqli_prepare($conexao, $sql_insert);
            mysqli_stmt_bind_param($stmt, 'ss', $usuario_novo, $hash_senha);

            if (mysqli_stmt_execute($stmt)) {
                
               
                $mensagem_status = "<h4 class='text-success'>Cadastro efetuado com sucesso! Clique em 'Fazer Login' abaixo para entrar.</h4>";
                
              
                header("Refresh: 3; URL=login.php"); 

            } else {
                $mensagem_status = "<h4 class='text-danger'>Erro ao cadastrar: " . mysqli_error($conexao) . "</h4>";
            }

            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conexao);
}


if (isset($conexao) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Novo Usuário</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/Style.css"> 
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg login-container">
        <div class="card-body">
            
            <h2 class="card-title text-center mb-4">Criar Conta</h2> 
            
            <?php if ($mensagem_status): ?>
                <div class="status-message text-center mb-4">
                    <?php echo $mensagem_status; ?>
                </div>
            <?php endif; ?>

            <form action="registrar.php" method="POST">
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Escolha um Usuário" required>
                </div>
                
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Digite sua Senha" required>
                </div>

                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirme a Senha" required>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-2">CADASTRAR</button>
            </form>

            <div class="links text-center mt-3">
                <a href="login.php" class="d-block text-muted">Já tenho uma conta (Fazer Login)</a>
            </div>
        </div>
    </div> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>