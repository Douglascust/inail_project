<?php
    // controller.php

    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=localhost;dbname=hostdeprojetos_inails', 'root', '');

    // Consulta SQL
    $query = "SELECT * FROM instituicao";

    // Executar a consulta
    $resultado = $conexao->query($query);

    // Converter o resultado em um array associativo
    $instituicoes = $resultado->fetchAll(PDO::FETCH_ASSOC);

    // Verificar a ação a ser realizada (deletar)
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Ler os dados JSON da solicitação
        $dados = json_decode(file_get_contents("php://input"), true);

        // Verificar se o ID da instituiçao foi fornecido
        if (isset($dados['idInstituicao'])) {
            $idInstituicao = $dados['idInstituicao'];

            // Consulta SQL para deletar o registro
            $query = "DELETE FROM instituicao WHERE idInstituicao = :idInstituicao";

            // Preparar e executar a declaração
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':idInstituicao', $idInstituicao, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(array('mensagem' => 'Registro deletado com sucesso.'));
            } else {
                echo json_encode(array('mensagem' => 'Erro ao deletar o registro.'));
            }
        } else {
            echo json_encode(array('mensagem' => 'ID da instituição não fornecido.'));
        }
    } else {
        echo json_encode(array('mensagem' => 'Ação inválida.'));
    }

        // Verifique se os parâmetros foram passados na solicitação POST
    if(isset($_POST['endereco']) && isset($_POST['nome']) && isset($_POST['razao_social']) && isset($_POST['cnpj_cpf']) && isset($_POST['telefone']) && isset($_POST['email']) && isset($_POST['contato'])) {
        // Dados do cliente a serem inseridos
        $endereco = $_POST['endereco'];
        $nome = $_POST['nome'];
        $razao_social = $_POST['razao_social'];
        $cnpj_cpf = $_POST['cnpj_cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $contato = $_POST['contato'];

        // Consulta SQL para inserir institução
        $query = "INSERT INTO instituicao (endereco, nome, razao_social, cnpj_cpf, telefone, email, contato) VALUES (:endereco, :nome, :razao_social, :cnpj_cpf, :telefone, :email, :contato)";

        // Preparar a consulta
        $stmt = $conexao->prepare($query);

        // Vincular os valores dos parâmetros aos valores das variáveis
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':razao_social', $razao_social, PDO::PARAM_STR);
        $stmt->bindParam(':cnpj_cpf', $cnpj_cpf, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':contato', $contato, PDO::PARAM_STR);

        // Executar a consulta
        if ($stmt->execute()) {
            // Resposta de sucesso
            $response = array('status' => 'success', 'message' => 'Instituição inserido com sucesso.');
        } else {
            // Resposta de erro em caso de falha na inserção
            $response = array('status' => 'error', 'message' => 'Falha ao inserir o instituição.');
        }
    } else {
        // Resposta de erro se algum dos parâmetros não foi fornecido
        $response = array('status' => 'error', 'message' => 'Dados da instituição incompletos.');
    }
    
    // Fechar a conexão
    $conexao = null;

    // Enviar a resposta como JSON para o front-end
    header('Content-Type: application/json');
    echo json_encode($instituicoes);
?>