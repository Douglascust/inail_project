<?php
    // controller.php

    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=hostdeprojetos_inails', 'root', '');

    // Consulta SQL
    $query = "SELECT * FROM agenda_recurso";

    // Executar a consulta
    $resultado = $conexao->query($query);

    // Converter o resultado em um array associativo
    $agenda_recursos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Verificar a ação a ser realizada (deletar)
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Ler os dados JSON da solicitação
        $dados = json_decode(file_get_contents("php://input"), true);

        // Verificar se o ID da agendarecurso foi fornecido
        if (isset($dados['idAgendaRecurso'])) {
            $idAgendaRecurso = $dados['idAgendaRecurso'];

            // Consulta SQL para deletar o registro
            $query = "DELETE FROM agenda_recurso WHERE idAgendaRecurso = :idAgendaRecurso";

            // Preparar e executar a declaração
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':idAgendaRecurso', $idAgendaRecurso, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(array('mensagem' => 'Registro deletado com sucesso.'));
            } else {
                echo json_encode(array('mensagem' => 'Erro ao deletar o registro.'));
            }
        } else {
            echo json_encode(array('mensagem' => 'ID do cliente não fornecido.'));
        }
    } else {
        echo json_encode(array('mensagem' => 'Ação inválida.'));
    }

    // Verifique se os parâmetros foram passados na solicitação POST
if(isset($_POST['idInstituicao']) && isset($_POST['idRecurso']) && isset($_POST['data']) && isset($_POST['hora']) && isset($_POST['tempo'])) {
    // Dados do agendarecurso a serem inseridos
    $idInstituicao = $_POST['idInstituicao'];
    $idRecurso = $_POST['idRecurso'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $tempo = $_POST['tempo'];

    // Consulta SQL para inserir um novo agendarecurso
    $query = "INSERT INTO agenda_recurso (idInstituicao, idRecurso, data, hora, tempo) VALUES (:idInstituicao, :idRecurso, :data, :hora, :tempo)";

    // Preparar a consulta
    $stmt = $conexao->prepare($query);

    // Vincular os valores dos parâmetros aos valores das variáveis
    $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_STR);
    $stmt->bindParam(':idRecurso', $idRecurso, PDO::PARAM_STR);
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
    $stmt->bindParam(':tempo', $tempo, PDO::PARAM_STR);

    // Executar a consulta
    if ($stmt->execute()) {
        // Resposta de sucesso
        $response = array('status' => 'success', 'message' => 'Agenda recurso adicionado com sucesso.');
    } else {
        // Resposta de erro em caso de falha na inserção
        $response = array('status' => 'error', 'message' => 'Falha ao adicionar a agenda recurso');
    }
} else {
    // Resposta de erro se algum dos parâmetros não foi fornecido
    $response = array('status' => 'error', 'message' => 'Dados da agenda recurso incompletos.');
}
    
    // Fechar a conexão
    $conexao = null;

    // Enviar a resposta como JSON para o front-end
    header('Content-Type: application/json');
    echo json_encode($agenda_recursos);
?>