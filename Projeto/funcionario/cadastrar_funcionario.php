<?php

require_once 'conexao.php';

if (isset($_POST['cadastrar'])) {

    $usuario_id  = filter_input(INPUT_POST, 'usuario_id');
    $nome        = filter_input(INPUT_POST, 'nome');
    $cpf         = filter_input(INPUT_POST, 'cpf');
    $telefone    = filter_input(INPUT_POST, 'telefone');
    $cep         = filter_input(INPUT_POST, 'cep');
    $rua         = filter_input(INPUT_POST, 'rua');
    $bairro      = filter_input(INPUT_POST, 'bairro');
    $numero      = filter_input(INPUT_POST, 'numero');
    $complemento = filter_input(INPUT_POST, 'complemento');
    $observacoes = filter_input(INPUT_POST, 'observacoes');
    
    if ($usuario_id === false || $usuario_id === null) {
        die("ID do Usuário inválido.");
    }

    $sql = "INSERT INTO funcionarios (usuario_id, nome, cpf, telefone, cep, rua, bairro, numero, complemento, observacoes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    
    if ($stmt === false) {
        die("Erro ao preparar a declaração: " . $conexao->error);
    }

    $stmt->bind_param("isssssssss", 
        $usuario_id, 
        $nome, 
        $cpf, 
        $telefone, 
        $cep, 
        $rua, 
        $bairro, 
        $numero, 
        $complemento, 
        $observacoes
    );

    
    if ($stmt->execute()) {
        
        echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location.href='cadastro_funcionario.html';</script>";
    } else {
        
        echo "<script>alert('ERRO: Não foi possível cadastrar o funcionário. Detalhes: " . $stmt->error . "'); window.location.href='cadastro_funcionario.html';</script>";
    }
    
    $stmt->close();
    $conexao->close();
    
} else {
    
    header("Location: cadastro_funcionario.html");
    exit();
}
?>
