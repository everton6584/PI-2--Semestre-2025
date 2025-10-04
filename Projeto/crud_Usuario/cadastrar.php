<?php
// Arquivo: cadastrar_primeiro_usuario.php (USE E EXCLUA)

// Inclui o arquivo de conexão
require_once 'conexao.php'; 

// =========================================================
// ⚠️ 1. DEFINA AQUI AS CREDENCIAIS QUE VOCÊ DESEJA CADASTRAR
// =========================================================
$usuario_padrao = "Marcos";
$senha_padrao = "123"; // Mude esta senha!
// =========================================================

// 2. CRIPTOGRAFA A SENHA
$hash_senha = password_hash($senha_padrao, PASSWORD_DEFAULT);

// 3. Prepara a consulta de inserção
$sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";

if ($stmt = mysqli_prepare($conexao, $sql)) {
    
    mysqli_stmt_bind_param($stmt, "ss", $usuario_padrao, $hash_senha);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h1 style='color: green;'>✅ Sucesso! Usuário '$usuario_padrao' cadastrado com sucesso.</h1>";
        echo "Você já pode testar o login no <a href='login.php'>Login</a>. <br> **RECOMENDAÇÃO: Exclua este arquivo agora.**";
    } else {
        echo "<h1 style='color: red;'>❌ ERRO ao cadastrar usuário!</h1>";
        echo "Erro: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<h1 style='color: red;'>❌ ERRO: Não foi possível preparar a instrução SQL.</h1>";
}

// Fecha a conexão
mysqli_close($conexao);
?>