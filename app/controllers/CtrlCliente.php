<?php

//puxando a classe Cliente
use models\Cliente;
use core\database\Where;

//Recebendo os dados do Front-end em forma de JSON
$dados = json_decode(file_get_contents("php://input"), true);

$cliente = new Cliente();

if ($dados["acao"] == "consultarTudo"){
    
    $linhas = $cliente->listClientes();
    $resposta=array();
    foreach($linhas as $linha){
        $tabela = [];
        $tabela['idCliente'] = $linha->getIdCliente();
        $tabela['nome'] = $linha->getNome();
        $tabela['email'] = $linha->getEmail();
        $tabela['cpf'] = $linha->getCpf();
        $tabela['senha'] = $linha->getSenha();
        $resposta[] = $tabela;
    }
        
}
elseif ($dados["acao"] == "inserir") {
    
    $idCliente = $dados["idCliente"];
    $nome = $dados["nome"];
    $email = $dados["email"];
    $senha = $dados["senha"];
    $cpf = $dados["cpf"];
    
    //Verifica se os dados não vieram vazios
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
        
        $cliente->populate($idCliente, $nome, $email, $senha, $cpf);
        
        // Executar a consulta
        if ($cliente->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Cliente cadastrado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao cadastrar o cliente!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do cliente incompletos ou vazios.');
    }  
}
elseif ($dados["acao"] == "login") {
    
    $senha = $dados["senha"];
    $cpf = $dados["cpf"];
    
    if (!empty($senha) && !empty($cpf)) {
        
        $where = new Where();
        $where->addCondition('AND', 'cpf', '=', $cpf);
        $where->addCondition('AND', 'senha', '=', $senha);
                
        $resultado = $cliente->listClientes($where);
        
        // Executar a consulta
        if (!empty($resultado)) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Login feito com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao logar o cliente!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do cliente incompletos ou vazios.');
    }    
}
elseif ($dados["acao"] == "atualizar"){
    
    $idCliente = $dados["idCliente"];
    $nome = $dados["nome"];
    $email = $dados["email"];
    $senha = $dados["senha"];
    $cpf = $dados["cpf"];
    
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
   
        $cliente->populate($idCliente, $nome, $email, $senha, $cpf);
        
        // Executar a consulta
        if ($cliente->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Cliente atualizado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao atualizar o cliente!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do cliente incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "excluir"){
    
    $idCliente = $dados["idCliente"];
    $nome = $dados["nome"];
    $email = $dados["email"];
    $senha = $dados["senha"];
    $cpf = $dados["cpf"];
    
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
        
        $cliente->populate($idCliente, $nome, $email, $senha, $cpf);
        
        if ($cliente->delete()) {
            $resposta = array('status' => 'success', 'message' => 'Cliente excluido com sucesso!');
        } else {
            $resposta = array('status' => 'error', 'message' => 'Falha ao excluir o cliente!');
        }
    } else {
        $resposta = array('status' => 'error', 'message' => 'idCliente incompletos ou vazios.');
    }  
}
else {
    // Resposta de erro se a ação não for "inserir"
    $resposta = array('status' => 'error', 'message' => 'Ação inválida.');
}

// Enviar a resposta como JSON para o front-end
header('Content-Type: application/json');
echo json_encode(['results'=>$resposta]);

?>
