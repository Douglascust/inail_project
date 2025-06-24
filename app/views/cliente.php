<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <link href="img/favicon.ico" rel="icon">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="public/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="public/assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="public/assets/css/style.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>
    <body>
        <div class="container">
        <h1 style="text-align: center;" class="mt-4 mb-3">Clientes Cadastrados</h1>
            <div class="row">
                <div class="text-start">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaluser" id="botoncrear">
                    <i class="bi bi-plus-circle-fill"></i>
                </button>
                </div>
            </div>
            <br />
            <div class="table-responsive">
                <table class="dadosuser" class="table table-bordered table-striped ">
                    <table class="table table-hover">
                        <thead>
                            <!-- Dados temporários até as funções de inserir, deletar,
                        editar serem feitos com Ajax-->
                            <tr style="text-align: center;" >
                                <th>idCliente</th>
                                <th>nome</th>
                                <th>email</th>
                                <th>cpf</th>
                                <th>senha</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;" id="tabelaDinamica">    
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="modaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="cadastrarmaniForm" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label for="nome">Nome do cliente</label>
                            <input type="text" name="nome" id="nome" class="form-control">
                            <br />

                            <!--<label for="rg">Rg do cliente</label>
                            <input type="text" name="rg" id="rg" class="form-control">
                            <br />
                            -->
							
                            <!--<label for="telefone">Telefone do cliente</label>
                            <input type="text" name="telefone" id="telefone" class="form-control">
                            <br />
                            --> 

                            <label for="email">Email do cliente</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <div name="msgEmail"></div>
                            <br />

                            <label for="cpf">Cpf do cliente</label>
                            <input type="text" name="cpf" id="cpf" class="form-control">
                            <div name="msgCpf"></div>
                            <br />
                            
                            <label for="senha">Senha do cliente</label>
                            <input type="text" name="senha" id="senha" class="form-control">
                            <br />

                          <!-- <label for="endereco">Endereço do cliente</label>
                            <input type="text" name="endereco" id="endereco" class="form-control">
                            <br />
                          --> 
                        <div class="modal-footer">
                            <input type="hidden" name="iduser" id="iduser">
                            <input type="hidden" name="operation" id="operation">
                            <div id="insertBtn">
                        		<input type="submit" name="action" id="action" class="btn btn-primary" value="Adicionar">
                        	</div>  
                        </div>
                    </div>
                	</div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="modaledituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editarForm" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label for="nome">Nome do cliente</label>
                            <input type="text" name="nome" id="nome" class="form-control">
                            <br />

                            <!--<label for="rg">Rg do cliente</label>
                            <input type="text" name="rg" id="rg" class="form-control">
                            <br />
                            -->
							
                            <!--<label for="telefone">Telefone do cliente</label>
                            <input type="text" name="telefone" id="telefone" class="form-control">
                            <br />
                            --> 

                            <label for="email">Email do cliente</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <div name="msgEmail"></div>
                            <br />

                            <label for="cpf">Cpf do cliente</label>
                            <input type="text" name="cpf" id="cpf" class="form-control">
                            <div name="msgCpf"></div>
                            <br />
                            
                            <label for="senha">Senha do cliente</label>
                            <input type="text" name="senha" id="senha" class="form-control">
                            <br />

                          <!-- <label for="endereco">Endereço do cliente</label>
                            <input type="text" name="endereco" id="endereco" class="form-control">
                            <br />
                          --> 
                        <div class="modal-footer">
                            <input type="hidden" name="iduser" id="iduser">
                            <input type="hidden" name="operation" id="operation">
                            <div id="editBtn">
                        		<input type="submit" name="action" id="action" class="btn btn-primary" value="Editar">
                        	</div>  
                        </div>
                    </div>
                   	</div>
                </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="modaldeluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-center fs-5" id="exampleModalLabel">Você deseja excluir o cliente?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="excluirForm" enctype="multipart/form-data">
                    <div class="modal-content">
                    	<div class="modal-body">
                    		<p>Você tem certeza de que deseja excluir permanentemente esse cliente?</p>
                    	</div>
                    </div>
                    <div class="modal-footer">
               	        <input type="hidden" name="iduser" id="iduser">
                        <input type="hidden" name="operation" id="operation">
                        <div id="deleteBtn">
                        	<input type="submit" name="action" id="action" class="btn btn-danger" value="Excluir">
                        </div>
                    </div>
               	</form>
            </div>
        </div>
       	</div>
        <div id="errorModal" class="modal fade">
    	<div class="modal-dialog modal-confirm modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header bg-danger">
    				<div class="d-flex flex-row justify-content-center ms-4 w-100 text-white">
    					<i class="bi bi-x-circle" style="font-size:80px"></i>
    				</div>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body text-center">
    				<h4>Atenção!</h4>	
    				<p id="errorMessage"></p>
    				<button class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ok</button>
    			</div>
    		</div>
    	</div>
	</div>
	<div id="successModal" class="modal fade">
    	<div class="modal-dialog modal-confirm modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-header bg-success">
    				<div class="d-flex flex-row justify-content-center ms-4 w-100 text-white">
    					<i class="bi bi-check2-circle" style="font-size:80px"></i>
    				</div>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body text-center">
    				<h4>Sucesso!</h4>	
    				<p id="successMessage">Aconteceu um erro na sua requisição, tente novamente mais tarde.</p>
    				<button class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ok</button>
    			</div>
    		</div>
    	</div>
		</div>
        <script src="public/assets/js/cliente.js"></script>
    </body>
</html>