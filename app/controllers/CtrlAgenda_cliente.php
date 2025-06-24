<?php

//puxando a classe Cliente
use models\Agendacliente;
use core\database\Where;
use models\Procedimento;
use models\Profissional;
use models\Agendaprofissional;

//Recebendo os dados do Front-end em forma de JSON
$dados = json_decode(file_get_contents("php://input"), true);

$agenda = new Agendacliente();

if ($dados["acao"] == "consultarTudo"){
    
    $linhas = $agenda->listAgendamentos();
    
    $resposta=array();
        foreach($linhas as $linha){
            $tabela = [];
            $tabela['idAgendaCliente'] = $linha->getIdAgendaCliente();
            $tabela['idProcedimento'] = $linha->getIdProcedimento();
            $tabela['idRecurso'] = $linha->getIdRecurso();
            $tabela['idProfissional'] = $linha->getIdProfissional();
            $tabela['idCliente'] = $linha->getIdCliente();
            $tabela['data'] = $linha->getData();
            $tabela['hora'] = $linha->getHora();
            $tabela['preco'] = $linha->getPreco();
            $resposta[] = $tabela;
    }
    
}
elseif ($dados["acao"] == "inserir") {
    
    $idAgendaCliente = $dados['idAgendaCliente'];
    $idProcedimento = $dados['idProcedimento'];
    $idRecurso = $dados['idRecurso'];
    $idProfissional = $dados['idProfissional'];
    $idCliente = $dados['idCliente'];
    $data = $dados['data'];
    $hora = $dados['hora'];
    $preco = $dados['preco'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProcedimento) && !empty($idRecurso) &&
        !empty($idProfissional) && !empty($idCliente) && !empty($data) && !empty($hora) && !empty($preco)) {
        
            $agenda->populate($idAgendaCliente, $idProcedimento, $idRecurso, $idProfissional, $idCliente, $data, $hora, $preco);
            
            //print_r($agenda->toArray());
        
        // Executar a consulta
        if ($agenda->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Agendamento adicionado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao adicionar o agendamento!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do agendamento incompletos ou vazios.');
    }
    
}elseif ($dados["acao"] == "atualizar"){
    
    $idAgendaCliente = $dados['idAgendaCliente'];
    $idProcedimento = $dados['idProcedimento'];
    $idRecurso = $dados['idRecurso'];
    $idProfissional = $dados['idProfissional'];
    $idCliente = $dados['idCliente'];
    $data = $dados['data'];
    $hora = $dados['hora'];
    $preco = $dados['preco'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idAgendaCliente) && !empty($idProcedimento) && !empty($idRecurso) &&
        !empty($idProfissional) && !empty($idCliente) && !empty($data) && !empty($hora) && !empty($preco)) {
            
            $agenda->populate($idAgendaCliente, $idProcedimento, $idRecurso,
                $idProfissional, $idCliente, $data, $hora,$preco);
        
        // Executar a consulta
        if ($agenda->save()) {
            // Resposta de sucesso
            $resposta = array('status' => 'success', 'message' => 'Agendamento atualizado com sucesso!');
        } else {
            // Resposta de erro em caso de falha na inserção
            $resposta = array('status' => 'error', 'message' => 'Falha ao atualizar o agendamento!');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
        $resposta = array('status' => 'error', 'message' => 'Dados do agendamento incompletos ou vazios.');
    }
}
elseif ($dados["acao"] == "excluir"){
    
    $idAgendaCliente = $dados['idAgendaCliente'];
    $idProcedimento = $dados['idProcedimento'];
    $idRecurso = $dados['idRecurso'];
    $idProfissional = $dados['idProfissional'];
    $idCliente = $dados['idCliente'];
    $data = $dados['data'];
    $hora = $dados['hora'];
    $preco = $dados['preco'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idAgendaCliente) && !empty($idProcedimento) && !empty($idRecurso) &&
        !empty($idProfissional) && !empty($idCliente) && !empty($data) && !empty($hora) && !empty($preco)) {
            
            $agenda->populate($idAgendaCliente, $idProcedimento, $idRecurso,
                $idProfissional, $idCliente, $data, $hora,$preco);
            
            // Executar a consulta
            if ($agenda->delete()) {
                // Resposta de sucesso
                $resposta = array('status' => 'success', 'message' => 'Agendamento excluido com sucesso!');
            } else {
                // Resposta de erro em caso de falha na inserção
                $resposta = array('status' => 'error', 'message' => 'Falha ao excluir o agendamento!');
            }
        } else {
            // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
            $resposta = array('status' => 'error', 'message' => 'Dados do agendamento incompletos ou vazios.');
        }
}
elseif ($dados["acao"] == "consultarHorarios"){
    
    $idProcedimento = $dados['idProcedimento'];
    $idProfissional = $dados['idProfissional'];
    $data = $dados['data'];
    
    //Verifica se os dados não vieram vazios
    if (!empty($idProcedimento) && !empty($idProfissional) && !empty($data)) {
            
        $procedimento = new Procedimento();
        $where = new Where();
        $where->addCondition('AND', 'idProcedimento', '=', $idProcedimento);
        $linhas = $procedimento->listProcedimentos($where);
        $tempo = $linhas[0]->getTempo();
        
        $agendaProfissional = new AgendaProfissional();
        $where = new Where();
        $where->addCondition('AND', 'idProfissional', '=', $idProfissional);
        $linhas = $agendaProfissional->listAgendaProfissional($where);
        
        $resposta = array();
        foreach($linhas as $linha){
            $horaIni = $linha->getHoraIni();
            $horaFim = $linha->getHoraFim();
            $agendaCliente = new Agendacliente();
            $horarios = $agendaCliente->validHours($horaIni, $horaFim, $tempo, $data);
            $resposta = array_merge($resposta,$horarios);
        }
    }
}
else{
    $resposta = array('status' => 'error', 'message' => 'Ação inválida.');
}

header('Content-Type: application/json');
echo json_encode(['results'=>$resposta]);

?>
