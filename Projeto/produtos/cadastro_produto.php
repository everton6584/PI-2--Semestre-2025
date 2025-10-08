<?php

include 'conexao.php';
    
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nome                       = $conexao->real_escape_string($_POST['nome']);
        $descricao                  = $conexao->real_escape_string($_POST['descricao'] ?? '');
        $categoria_id               = (int)$_POST['categoria_id'];
        $fornecedor_padrao_id       = (int)$_POST['fornecedor_padrao_id'];
        
        $preco_custo                = number_format((float)str_replace(',', '.', $_POST['preco_custo']), 2, '.', '');
        $preco_venda                = number_format((float)str_replace(',', '.', $_POST['preco_venda']), 2, '.', '');
        $quantidade_estoque         = (int)$_POST['quantidade_estoque'];
        $estoque_minimo             = (int)$_POST['estoque_minimo'];
        $codigo_barras              = $conexao->real_escape_string($_POST['codigo_barras'] ?? '');
        
        $ativo                      = isset($_POST['ativo']) ? 1 : 0; 
        
        $sql = "INSERT INTO produtos (
                    nome, descricao, categoria_id, fornecedor_padrao_id, preco_custo, preco_venda, 
                    quantidade_estoque, estoque_minimo, codigo_barras, ativo, created_at, updated_at
                ) 
                VALUES (
                    '{$nome}', 
                    '{$descricao}', 
                    {$categoria_id}, 
                    {$fornecedor_padrao_id}, 
                    {$preco_custo}, 
                    {$preco_venda}, 
                    {$quantidade_estoque}, 
                    {$estoque_minimo}, 
                    '{$codigo_barras}', 
                    {$ativo},
                    NOW(),
                    NOW()
                )";

        if ($conexao->query($sql) === TRUE) {
            
            echo "✅ Produto '{$nome}' cadastrado com sucesso! ID: " . $conexao->insert_id;
        } else {
            
            echo "❌ Erro ao cadastrar o produto: " . $conexao->error;
        }

    } else {
        
        echo "Acesso inválido. Por favor, utilize o formulário de cadastro.";
    }

    $conexao->close();

?>