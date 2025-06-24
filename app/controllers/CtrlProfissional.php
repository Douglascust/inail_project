<?php

//puxando a classe Cliente
use models\Profissional;
use core\database\Where;

//Recebendo os dados do Front-end em forma de JSON
$dados = json_decode(file_get_contents("php://input"), true);

$profissional = new Profissional();

if ($dados["acao"] == "consultarTudo"){
    
    $linhas = $profissional->listProfissional();
    $resposta=array();
    foreach($linhas as $linha){
        $tabela = [];
        $tabela['idProfissional'] = $linha->getIdProfissional();
        $tabela['nome'] = $linha->getNome();
        $tabela['funcao'] = $linha->getFuncao();
        $tabela['rg'] = $linha->getRg();
        $tabela['telefone'] = $linha->getTelefone();
        $tabela['endereco'] = $linha->getEndereco();
        $tabela['cnpj_cpf'] = $linha->getCnpj_cpf();
        $resposta[] = $tabela;
    }
    
}
elseif ($dados["acao"] == "inserir") {
    
    $idProfissional = $dados['idProfissional'];
    $nome = $dados['nome'];
    $funcao = $dados['funcao'];
    $rg = $dados['rg'];
    $telefone = $dados['telefone'];
    $endereco = $dados['endereco'];
    $cnpj_cpf = $dados['cnpj_cpf'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProfissional) && !empty($nome) && !empty($funcao) && !empty($rg) && !empty($telefone) && !empty($endereco) && !empty($cnpj_cpf)) {
        
        $profissional->populate($idProfissional, $nome, $funcao, $rg, $telefone, $endereco, $cnpj_cpf);
        
        // Executar a consulta
        if ($profissional->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Profissional cadastrado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao cadastrar o profissional!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do profissional incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "login") {
    
    $senha = $dados["senha"];
    $cpf = $dados["cpf"];
    
    if (!empty($senha) && !empty($cpf)) {
        
        $where = new Where();
        $where->addCondition('AND', 'cnpj_cpf', '=', $cpf);
        $where->addCondition('AND', 'senha', '=', $senha);
        
        $resultado = $profissional->listProfissional($where);
        
        // Executar a consulta
        if (!empty($resultado)) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Login feito com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao logar o profissional!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do profissional incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "atualizar"){
    
    $idProfissional = $dados['idProfissional'];
    $nome = $dados['nome'];
    $funcao = $dados['funcao'];
    $rg = $dados['rg'];
    $telefone = $dados['telefone'];
    $endereco = $dados['endereco'];
    $cnpj_cpf = $dados['cnpj_cpf'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProfissional) && !empty($nome) && !empty($funcao) && !empty($rg) && !empty($telefone) && !empty($endereco) && !empty($cnpj_cpf)) {
        
        $profissional->populate($idProfissional, $nome, $funcao, $rg, $telefone, $endereco, $cnpj_cpf);
        
        // Executar a consulta
        if ($profissional->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Profissional atualizado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao atualizar o profissional!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do profissional incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "excluir"){
    
    $idProfissional = $dados['idProfissional'];
    $nome = $dados['nome'];
    $funcao = $dados['funcao'];
    $rg = $dados['rg'];
    $telefone = $dados['telefone'];
    $endereco = $dados['endereco'];
    $cnpj_cpf = $dados['cnpj_cpf'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProfissional) && !empty($nome) && !empty($funcao) && !empty($rg) && !empty($telefone) && !empty($endereco) && !empty($cnpj_cpf)) {
        
        $profissional->populate($idProfissional, $nome, $funcao, $rg, $telefone, $endereco, $cnpj_cpf);
        
        // Executar a consulta
        if ($profissional->delete()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Profissional excluido com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao excluir o profissional!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do profissional incompletos ou vazios.');
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
