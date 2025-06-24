<?php

//puxando a classe Cliente
use models\Procedimento;

//Recebendo os dados do Front-end em forma de JSON
$dados = json_decode(file_get_contents("php://input"), true);

$procedimento = new Procedimento();

if ($dados["acao"] == "consultarTudo"){
    
    $linhas = $procedimento->listProcedimentos();
    $resposta=array();
    foreach($linhas as $linha){
        $tabela = [];
        $tabela['idProcedimento'] = $linha->getIdProcedimento();
        $tabela['tipoProcedimento'] = $linha->getTipoProcedimento();
        $tabela['tempo'] = $linha->getTempo();
        $tabela['preco'] = $linha->getPreco();
        $resposta[] = $tabela;
    }
}
elseif ($dados["acao"] == "inserir") {
    
    $idProcedimento = $dados["idProcedimento"];
    $tipoProcedimento = $dados["tipoProcedimento"];
    $tempo = $dados["tempo"];
    $preco = $dados["preco"];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProcedimento) && !empty($tipoProcedimento) && !empty($tempo) && !empty($preco)) {
        
        $procedimento->populate($idProcedimento, $tipoProcedimento, $tempo, $preco);
        
        // Executar a consulta
        if ($procedimento->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Procedimento cadastrado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao cadastrar o procedimento!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do procedimento incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "atualizar"){
    
    $idProcedimento = $dados["idProcedimento"];
    $tipoProcedimento = $dados["tipoProcedimento"];
    $tempo = $dados["tempo"];
    $preco = $dados["preco"];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProcedimento) && !empty($tipoProcedimento) && !empty($tempo) && !empty($preco)) {
        
        $procedimento->populate($idProcedimento, $tipoProcedimento, $tempo, $preco);
        
        // Executar a consulta
        if ($procedimento->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Procedimento atualizado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao atualizar o procedimento!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do procedimento incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "excluir"){
    
    $idProcedimento = $dados["idProcedimento"];
    $tipoProcedimento = $dados["tipoProcedimento"];
    $tempo = $dados["tempo"];
    $preco = $dados["preco"];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProcedimento) && !empty($tipoProcedimento) && !empty($tempo) && !empty($preco)) {
        
        $procedimento->populate($idProcedimento, $tipoProcedimento, $tempo, $preco);
        
        // Executar a consulta
        if ($procedimento->delete()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Procedimento excluido com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao excluir o procedimento!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do procedimento incompletos ou vazios.');
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
