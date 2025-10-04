<?php
// Configurações do Banco de Dados
$servidor = "localhost"; // Geralmente é 'localhost' no ambiente de desenvolvimento
$usuario_bd = "root";    // O nome de usuário do seu MySQL/MariaDB (padrão é 'root' no XAMPP/WAMP)
$senha_bd = "";          // A senha do seu MySQL/MariaDB (padrão é vazia no XAMPP/WAMP)
$nome_banco = "testepi";   // O nome do banco de dados que você criou

// 1. Tenta estabelecer a conexão
$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $nome_banco);

// 2. Verifica se houve algum erro na conexão
if (!$conexao) {
    // Se a conexão falhar, exibe uma mensagem de erro e interrompe o script
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Opcional: Define o charset para evitar problemas com acentuação
mysqli_set_charset($conexao, "utf8");

// A variável $conexao agora contém o objeto de conexão, pronto para ser usado.
?>