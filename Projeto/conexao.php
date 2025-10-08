<?php

$servidor = "localhost"; 
$usuario_bd = "root";    
$senha_bd = "";          
$nome_banco = "testepi";   
$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $nome_banco);


if (!$conexao) {
   
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}


mysqli_set_charset($conexao, "utf8");


?>