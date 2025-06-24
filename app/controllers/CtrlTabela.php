<?php
$conexao = new PDO('mysql:host=localhost;dbname=inails', 'admin', '2279');
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dados = json_decode(file_get_contents("php://input"), true);


$tabela = '';

$query = "SELECT idCliente, nome, email, senha, cpf FROM cliente";
$stmt = $conexao->prepare($query);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row){
    $tabela.='<tr>
                        <td class="idCliente">'.$row["idCliente"].'</td>
                        <td class="nome">'.$row["nome"].'</td>
                        <td class="email">'.$row["email"].'</td>
                        <td class="cpf">'.$row["cpf"].'</td>
                        <td class="senha">'.$row["senha"].'</td>
                        <td>
                           	<div class="d-flex flex-row justify-content-center">
                              	<div class="me-3">
                               		<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modaledituser" id="btneditar">
                                   		<i>Editar</i>
                               	</div>
                               	<div>
                          	 	   <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modaldeluser" id="btnexcluir">
                              	     <i>Excluir</i>
                                </div>
                            </div>
                        </td>
                    </tr>';
}
header('Content-Type: text/html');
echo $tabela;