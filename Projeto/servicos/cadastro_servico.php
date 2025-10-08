<?php 

    include 'conexao.php';
    
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $conexao->real_escape_string($_POST['nome']);
        $descricao = $conexao->real_escape_string($_POST['descricao']);
        
        $preco_formatado = str_replace(',', '.', $_POST['preco']);
        $preco = filter_var($preco_formatado, FILTER_VALIDATE_FLOAT);
        
        $duracao_media = filter_var($_POST['duracao_media'], FILTER_VALIDATE_INT);
        
        $ativo = isset($_POST['ativo']) ? 1 : 0; 

        if (
            !$nome || 
            !$descricao || 
            $preco === false || 
            $duracao_media === false || 
            $duracao_media < 1
        ) {
            
            echo "Erro: Dados do formulário inválidos ou incompletos. Verifique todos os campos.";
            exit;
        }
        
        $sql = "INSERT INTO servicos (nome, descricao, preco, duracao_media, ativo, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
         
        $stmt = $conexao->prepare($sql);
        
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conexao->error);
        }
        
        $stmt->bind_param("ssddi", $nome, $descricao, $preco, $duracao_media, $ativo);
        
        if ($stmt->execute()) {
            echo "Serviço cadastrado com sucesso! ID: " . $conexao->insert_id;
            
        } else {
            echo "Erro ao cadastrar o serviço: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        
        echo "Acesso inválido. Por favor, utilize o formulário de cadastro.";
    }

    $conexao->close();
?>