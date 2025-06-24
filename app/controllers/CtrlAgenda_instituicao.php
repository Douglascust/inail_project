<?php
    // controller.php

    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=hostdeprojetos_inails', 'root', '');

    // Consulta SQL
    $query = "SELECT * FROM agenda_instituicao";

    // Executar a consulta
    $resultado = $conexao->query($query);

    // Converter o resultado em um array associativo
    $agenda_instituicoes = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Verificar a ação a ser realizada (deletar)
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Ler os dados JSON da solicitação
        $dados = json_decode(file_get_contents("php://input"), true);

        // Verificar se o ID da agendainstituição foi fornecido
        if (isset($dados['idAgendaInstituicao'])) {
            $idAgendaInstituicao = $dados['idAgendaInstituicao'];

            // Consulta SQL para deletar o registro
            $query = "DELETE FROM agenda_instituicao WHERE idAgendaInstituicao = :idAgendaInstituicao";

            // Preparar e executar a declaração
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':idAgendaInstituicao', $idCliente, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(array('mensagem' => 'Registro deletado com sucesso.'));
            } else {
                echo json_encode(array('mensagem' => 'Erro ao deletar o registro.'));
            }
        } else {
            echo json_encode(array('mensagem' => 'ID da agenda instituição não fornecido.'));
        }
    } else {
        echo json_encode(array('mensagem' => 'Ação inválida.'));
    }

    // Verifique se os parâmetros foram passados na solicitação POST
if(isset($_POST['idInstituicao']) && isset($_POST['dataIni']) && isset($_POST['horaIni']) && isset($_POST['dataFim']) && isset($_POST['horaFim'])) {
    // Dados do cliente a serem inseridos
    $idInstituicao = $_POST['idInstituicao'];
    $dataIni = $_POST['dataIni'];
    $horaIni = $_POST['horaIni'];
    $dataFim = $_POST['dataFim'];
    $horaFim = $_POST['horaFim'];

    // Consulta SQL para inserir um novo Agendainstituição
    $query = "INSERT INTO agenda_instituicao (idInstituicao, dataIni, horaIni, dataFim, horaFim) VALUES (:idInstituicao, :dataIni, :horaIni, :dataFim, :horaFim)";

    // Preparar a consulta
    $stmt = $conexao->prepare($query);

    // Vincular os valores dos parâmetros aos valores das variáveis
    $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_STR);
    $stmt->bindParam(':dataIni', $dataIni, PDO::PARAM_STR);
    $stmt->bindParam(':horaIni', $horaIni, PDO::PARAM_STR);
    $stmt->bindParam(':dataFim', $dataFim, PDO::PARAM_STR);
    $stmt->bindParam(':horaFim', $horaFim, PDO::PARAM_STR);

    // Executar a consulta
    if ($stmt->execute()) {
        // Resposta de sucesso
        $response = array('status' => 'success', 'message' => 'Agenda instituição adicionado com sucesso.');
    } else {
        // Resposta de erro em caso de falha na inserção
        $response = array('status' => 'error', 'message' => 'Falha ao adicionar o agenda instituição.');
    }
} else {
    // Resposta de erro se algum dos parâmetros não foi fornecido
    $response = array('status' => 'error', 'message' => 'Dados da agenda instituição incompletos.');
}
    
    // Fechar a conexão
    $conexao = null;

    // Enviar a resposta como JSON para o front-end
    header('Content-Type: application/json');
    echo json_encode($agenda_instituicoes);
?>