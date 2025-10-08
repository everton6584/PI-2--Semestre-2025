<?php

$servidor = "localhost"; 
$usuario  = "root";     
$senha    = "";         
$banco    = "petepet"; 

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão com o BD: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");

?>