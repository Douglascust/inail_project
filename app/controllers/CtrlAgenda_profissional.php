<?php
    // controller.php

    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=hostdeprojetos_inails', 'root', '');

    // Consulta SQL
    $query = "SELECT * FROM agenda_profissional";

    // Executar a consulta
    $resultado = $conexao->query($query);

    // Converter o resultado em um array associativo
    $agenda_profissionais = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Verificar a ação a ser realizada (deletar)
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Ler os dados JSON da solicitação
        $dados = json_decode(file_get_contents("php://input"), true);

        // Verificar se o ID da agendainstituição foi fornecido
        if (isset($dados['idAgendaProfissional'])) {
            $idAgendaProfissional = $dados['idAgendaProfissional'];

            // Consulta SQL para deletar o registro
            $query = "DELETE FROM agenda_profissional WHERE idAgendaProfissional = :idAgendaProfissional";

            // Preparar e executar a declaração
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':idAgendaProfissional', $idAgendaProfissional, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(array('mensagem' => 'Registro deletado com sucesso.'));
            } else {
                echo json_encode(array('mensagem' => 'Erro ao deletar o registro.'));
            }
        } else {
            echo json_encode(array('mensagem' => 'ID da agenda cliente não fornecido.'));
        }
    } else {
        echo json_encode(array('mensagem' => 'Ação inválida.'));
    }

    // Verifique se os parâmetros foram passados na solicitação POST
if(isset($_POST['idInstituicao']) && isset($_POST['idProfissional']) && isset($_POST['dataIni']) && isset($_POST['horaIni']) && isset($_POST['dataFim']) && isset($_POST['horaFim']) && isset($_POST['obs'])) {
    // Dados do agendaprofissional a serem inseridos
    $idInstituicao = $_POST['idInstituicao'];
    $idProfissional = $_POST['idProfissional'];
    $dataIni = $_POST['dataIni'];
    $horaIni = $_POST['horaIni'];
    $dataFim = $_POST['dataFim'];
    $horaFim = $_POST['horaFim'];
    $obs = $_POST['obs'];

    // Consulta SQL para inserir um novo agendainstituição
    $query = "INSERT INTO agenda_instituicao (idInstituicao, idProfissional, dataIni, horaIni, dataFim, horaFim, obs) VALUES (:idInstituicao, :idProfissional, :dataIni, :horaIni, :dataFim, :horaFim, :obs)";

    // Preparar a consulta
    $stmt = $conexao->prepare($query);

    // Vincular os valores dos parâmetros aos valores das variáveis
    $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_STR);
    $stmt->bindParam(':idProfissional', $idProfissional, PDO::PARAM_STR);
    $stmt->bindParam(':dataIni', $dataIni, PDO::PARAM_STR);
    $stmt->bindParam(':horaIni', $horaIni, PDO::PARAM_STR);
    $stmt->bindParam(':dataFim', $dataFim, PDO::PARAM_STR);
    $stmt->bindParam(':horaFim', $horaFim, PDO::PARAM_STR);
    $stmt->bindParam(':obs', $obs, PDO::PARAM_STR);

    // Executar a consulta
    if ($stmt->execute()) {
        // Resposta de sucesso
        $response = array('status' => 'success', 'message' => 'Agenda profissional adicionado com sucesso.');
    } else {
        // Resposta de erro em caso de falha na inserção
        $response = array('status' => 'error', 'message' => 'Falha ao adicionar a agenda profissional.');
    }
} else {
    // Resposta de erro se algum dos parâmetros não foi fornecido
    $response = array('status' => 'error', 'message' => 'Dados da agenda profissional incompletos.');
}
    
    // Fechar a conexão
    $conexao = null;

    // Enviar a resposta como JSON para o front-end
    header('Content-Type: application/json');
    echo json_encode($agenda_profissionais);
?>