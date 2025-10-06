<?php

$servidor = "localhost"; 
$banco = "petepet"; 
$usuario = "root"; 
$senha = "";

try {
    
    $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>