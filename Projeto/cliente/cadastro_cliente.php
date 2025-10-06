<?php

include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome              = trim($_POST['nome']);
    $cpf               = trim($_POST['cpf']);
    $data_nascimento   = trim($_POST['data_nascimento']);
    $telefone          = trim($_POST['telefone']);
    $email             = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $cep               = trim($_POST['cep']);
    $rua               = trim($_POST['rua']);
    $bairro            = trim($_POST['bairro']);
    $numero            = trim($_POST['numero']);
    $complemento       = trim($_POST['complemento']);
    $observacoes       = trim($_POST['observacoes']);

    $sql = "INSERT INTO clientes (nome, cpf, data_nascimento, telefone, email, cep, rua, bairro, numero, complemento, observacoes, ativo)
            VALUES (:nome, :cpf, :data_nascimento, :telefone, :email, :cep, :rua, :bairro, :numero, :complemento, :observacoes, 1)";
            
    try {
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':observacoes', $observacoes);
        
        $stmt->execute();
        
        echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='cadastro_cliente.html';</script>";
        
    } catch (PDOException $e) {
       
        echo "<script>alert('Erro ao cadastrar cliente: " . $e->getMessage() . "'); window.location.href='cadastro_cliente.html';</script>";
    }
} else {
    
    echo "Método de requisição inválido. Acesse via formulário.";
}


$pdo = null;

?>