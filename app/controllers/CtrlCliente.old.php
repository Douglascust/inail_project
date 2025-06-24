<?php
// Conexão com o banco de dados
try {
    $conexao = new PDO('mysql:host=localhost;dbname=inails', 'admin', '2279');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dados = json_decode(file_get_contents("php://input"), true);
    
    // Verifique se os parâmetros foram passados na solicitação POST
    if ($dados["acao"] == "inserir") {
        $nome = $dados["nome"];
        $email = $dados["email"];
        $senha = $dados["senha"];
        $cpf = $dados["cpf"];
        
        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
            // Consulta SQL para inserir um novo cliente
            $query = "INSERT INTO cliente (nome, email, senha, cpf) VALUES (:nome, :email, :senha, :cpf)";
            
            // Preparar a consulta
            $stmt = $conexao->prepare($query);
            
            // Vincular os valores dos parâmetros aos valores das variáveis
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cpf', $cpf);
            
            // Executar a consulta
            if ($stmt->execute()) {
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
    // Verificar a ação a ser realizada (deletar)
    }elseif ($dados["acao"] == "login") {
        $senha = $dados["senha"];
        $cpf = $dados["cpf"];
        
        if (!empty($senha) && !empty($cpf)) {
            // Consulta SQL para inserir um novo cliente
            $query = "SELECT * FROM cliente WHERE senha=:senha AND cpf=:cpf";
            
            // Preparar a consulta
            $stmt = $conexao->prepare($query);
            
            // Vincular os valores dos parâmetros aos valores das variáveis
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            
            $loginExiste = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Executar a consulta
            if (!empty($loginExiste)) {
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
        // Verificar a ação a ser realizada (deletar)
    }elseif ($dados["acao"] == "loginmani") {
        $senha = $dados["senha"];
        $cpf = $dados["cpf"];
        
        if (!empty($senha) && !empty($cpf)) {
            // Consulta SQL para inserir um novo cliente
            $query = "SELECT nome, senha, cpf FROM cliente WHERE nome='admin' AND senha=:senha AND cpf=:cpf";
            
            // Preparar a consulta
            $stmt = $conexao->prepare($query); 
            
            // Vincular os valores dos parâmetros aos valores das variáveis
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            
            $loginExiste = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Executar a consulta
            if (!empty($loginExiste)) {
                // Resposta de sucesso
                $resposta = array('status' => 'success', 'message' => 'Login feito com sucesso!');
            } else {
                // Resposta de erro em caso de falha na inserção
                $resposta = array('status' => 'error', 'message' => 'Falha ao logar a manicure!');
            }
        } else {
            // Resposta de erro se algum dos parâmetros não foi fornecido ou está vazio
            $resposta = array('status' => 'error', 'message' => 'Dados da manicure incompletos ou vazios.');
        }
        // Verificar a ação a ser realizada (deletar)
    }elseif ($dados["acao"] == "atualizar"){
        $idCliente = $dados["idCliente"];
        $nome = $dados["nome"];
        $email = $dados["email"];
        $senha = $dados["senha"];
        $cpf = $dados["cpf"];
        
        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($cpf)) {
            // Consulta SQL para inserir um novo cliente
            $query = "UPDATE cliente SET nome=:nome, email=:email, senha=:senha, cpf=:cpf WHERE idCliente=:idCliente";
            
            // Preparar a consulta
            $stmt = $conexao->prepare($query);
            
            // Vincular os valores dos parâmetros aos valores das variáveis
            $stmt->bindParam(':idCliente', $idCliente);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cpf', $cpf);
            
            // Executar a consulta
            if ($stmt->execute()) {
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
    }elseif ($dados["acao"] == "excluir"){
        
        $idCliente = $dados["idCliente"];
        if (!empty($idCliente)) {
            // Consulta SQL para deletar o registro
            $query = "DELETE FROM cliente WHERE idCliente=:idCliente";
            $stmt = $conexao->prepare($query);
            // Preparar e executar a declaração
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
                
            if ($stmt->execute()) {
                $resposta = array('status' => 'success', 'message' => 'Cliente excluido com sucesso!');
            } else {
                $resposta = array('status' => 'error', 'message' => 'Falha ao excluir o cliente!');
            }
       } else {
           $resposta = array('status' => 'error', 'message' => 'idCliente incompletos ou vazios.');
       }
    }elseif ($dados["acao"] == "consultarTudo"){
            
        // Consulta SQL
        $query = "SELECT * FROM cliente";
        // Executar a consulta
        $resultado = $conexao->query($query);    
        // Converter o resultado em um array associativo
        $clientes = $resultado->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Resposta de erro se a ação não for "inserir"
        $resposta = array('status' => 'error', 'message' => 'Ação inválida.');
    }
} catch (PDOException $e) {
    // Tratar erros de conexão com o banco de dados
    $resposta = array('status' => 'error', 'message' => 'Erro de conexão com o banco de dados: ' . $e->getMessage());
}

// Fechar a conexão
$conexao = null;

// Enviar a resposta como JSON para o front-end
header('Content-Type: application/json');
echo json_encode($resposta);
?>
