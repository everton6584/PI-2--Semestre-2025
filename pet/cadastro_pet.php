<?php

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $nome = trim($_POST['nome']);
    $cliente_id = (int) $_POST['cliente_id'];
    $especie_id = (int) $_POST['especie_id'];

    $raca_id = isset($_POST['raca_id']) && $_POST['raca_id'] !== '' ? (int) $_POST['raca_id'] : null;
    $peso = isset($_POST['peso']) && $_POST['peso'] !== '' ? (float) $_POST['peso'] : null;
    $cor = trim($_POST['cor']);
    $data_nascimento = $_POST['data_nascimento'];
    $observacoes = trim($_POST['observacoes']);

    $castrado = isset($_POST['castrado']) ? 1 : 0;
    $vacinado = isset($_POST['vacinado']) ? 1 : 0;    
    $ativo = isset($_POST['ativo']) ? 1 : 0; 
    
    $foto = null; 

    $sql = "INSERT INTO pet (
                nome, cliente_id, especie_id, raca_id, data_nascimento, peso, 
                cor, castrado, vacinado, observacoes, foto, ativo, created_at, updated_at
            ) VALUES (
                :nome, :cliente_id, :especie_id, :raca_id, :data_nascimento, :peso, 
                :cor, :castrado, :vacinado, :observacoes, :foto, :ativo, NOW(), NOW()
            )";
            

    try {
        
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':especie_id', $especie_id, PDO::PARAM_INT);
        
        $stmt->bindParam(':raca_id', $raca_id, $raca_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(':peso', $peso, $peso === null ? PDO::PARAM_NULL : PDO::PARAM_STR); 
        
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':castrado', $castrado, PDO::PARAM_INT);
        $stmt->bindParam(':vacinado', $vacinado, PDO::PARAM_INT);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt->bindParam(':observacoes', $observacoes);

        $data_nascimento_param = ($data_nascimento === '') ? null : $data_nascimento;
        $stmt->bindParam(':data_nascimento', $data_nascimento_param, $data_nascimento_param === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->execute();

        
        header("Location: lista_pets.php?status=success&pet_id=" . $conn->lastInsertId());
        exit();

    } catch (PDOException $e) {
        
        echo "<h1>Erro ao cadastrar o Pet!</h1>";
        echo "<p>Detalhes do erro: " . $e->getMessage() . "</p>";
        
    }

} else {
    
    header("Location: cadastro_pet.html"); 
    exit();
}
?>