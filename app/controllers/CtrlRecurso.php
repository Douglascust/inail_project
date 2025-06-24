<?php
    // controller.php

    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=hostdeprojetos_inails', 'root', '');

    // Consulta SQL
    $query = "SELECT * FROM recurso";

    // Executar a consulta
    $resultado = $conexao->query($query);

    // Converter o resultado em um array associativo
    $recursos = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Verificar a ação a ser realizada (deletar)
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Ler os dados JSON da solicitação
        $dados = json_decode(file_get_contents("php://input"), true);

        // Verificar se o ID do recurso foi fornecido
        if (isset($dados['idRecurso'])) {
            $idRecurso = $dados['idRecurso'];

            // Consulta SQL para deletar o registro
            $query = "DELETE FROM recurso WHERE idRecurso = :idRecurso";

            // Preparar e executar a declaração
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':idRecurso', $idRecurso, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(array('mensagem' => 'Registro deletado com sucesso.'));
            } else {
                echo json_encode(array('mensagem' => 'Erro ao deletar o registro.'));
            }
        } else {
            echo json_encode(array('mensagem' => 'ID do recurso não fornecido.'));
        }
    } else {
        echo json_encode(array('mensagem' => 'Ação inválida.'));
    }

        // Verifique se os parâmetros foram passados na solicitação POST
    if(isset($_POST['tipo']) && isset($_POST['descricao']) && isset($_POST['dependecia_recurso'])) {
        // Dados do cliente a serem inseridos
        $tipo = $_POST['tipo'];
        $descricao = $_POST['descricao'];
        $dependencia_recurso = $_POST['dependencia_recurso'];

        // Consulta SQL para inserir um novo recurso
        $query = "INSERT INTO recurso (tipo, descricao, dependencia_recurso) VALUES (:tipo, :descricao, :dependencia_recurso)";

        // Preparar a consulta
        $stmt = $conexao->prepare($query);

        // Vincular os valores dos parâmetros aos valores das variáveis
        $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':dependencia', $dependencia_recurso, PDO::PARAM_STR);

        // Executar a consulta
        if ($stmt->execute()) {
            // Resposta de sucesso
            $response = array('status' => 'success', 'message' => 'Recurso adicionado com sucesso.');
        } else {
            // Resposta de erro em caso de falha na inserção
            $response = array('status' => 'error', 'message' => 'Falha ao adicionar o recurso.');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido
        $response = array('status' => 'error', 'message' => 'Dados do recurso incompletos.');
    }
    
    // Fechar a conexão
    $conexao = null;

    // Enviar a resposta como JSON para o front-end
    header('Content-Type: application/json');
    echo json_encode($recursos);
?>