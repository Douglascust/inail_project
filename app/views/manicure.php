<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>iNAILS - iNAILS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="public/assets/img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="public/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="public/assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
   	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="public/assets/css/style.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>

<body>

    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="index">SAIR</a>
                        <span class="text-white"></span>
                      
                        <span class="text-white"></span>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>NAILS</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                     <a href="index" class="nav-item nav-link active"></a>
                        <a href="product" class="nav-item nav-link"></a>
                    </div>
                    <a href="index" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>NAILS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                      
                    </div>
                </div>
            </nav>
        </div>
    </div>
  
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5">PORTAL MANICURE</h1>
                </div>
    	<div class="d-xl-flex flex-row justify-content-center w-100">
      	<div class="rounded-start shadow w-40 p-4" style="background: #e85181;">
      		<div class="mb-2 mw-25">
      			<h1 id="scheduleH1" style="font-size:20px; text-transform: uppercase;" class="w-50  text-white"></h1>
      		</div>
      		<div class="pt-4">
      			<div class="me-2">
      				<div class="d-flex flex-row">
                    	<div class="input-group input-group-sm mt-1">
                          <span class="input-group-text bg-white border border-end-0 " id="searchIcon"><i class="bi bi-search"></i></span>
                          <input type="text" class="form-control form-control-lg border border-start-0 shadow-none" aria-label="Username" aria-describedby="searchIcon" id="searchInput">
                        </div>
                        <button class="btn btn-outline-light btn-sm ms-2" id="addEvent"><i class="bi bi-plus-lg"></i></button>
                    </div>
                	<table class="table table-bordered table-striped mt-1">
                        <table class="table table-hover text-center">
                            <thead id="eventTable">
                                <tr>
                                	<th>Profissional</th>
                                	<th>Procedimento</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Preço</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id="events">
                            </tbody>
                        </table>
                    </table>
                </div>
      		</div>
      	</div>
      	<div>
      		<div class="wrapper rounded-end">
              <header>
                <p class="current-date"></p>
                <div class="icons">
                  <span id="prev" class="material-symbols-rounded">chevron_left</span>
                  <span id="next" class="material-symbols-rounded">chevron_right</span>
                </div>
              </header>
              <div class="calendar">
                <ul class="weeks" style="padding-left: 0px">
                  <li>Dom</li>
                  <li>Seg</li>
                  <li>Ter</li>
                  <li>Qua</li>
                  <li>Qui</li>
                  <li>Sex</li>
                  <li>Sáb</li>
                </ul>
                <ul class="days" style="padding-left: 0px"></ul>
              </div>
            </div>
      	</div>
    </div>
    <div class="modal fade" id="modalSelectedDay" tabindex="-1" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
        	<div class="modal-content">
            	<div class="modal-header" style="background: #e85181;">
                	<h1 class="modal-title text-white fs-5 p-2" id="date" style="text-transform: capitalize;"></h1>
                    <button type="button" class="btn-close btn-close-white shadow-none me-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                    <div class="modal-body mt-1">
                    	<div class="me-2 mb-3 text-center" id="selectedDayEvents">	
                    	</div>
                    	<div class="ms-2 me-3">
                    		<button class="btn btn-outline-primary w-100" id="addEvent">Adicionar novo evento</button>
                    	</div>
                        <div class="modal-footer mt-4">
                        	<button class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="addOrModifyModal" tabindex="-1" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
        	<div class="modal-content">
            	<div class="modal-header" style=" background: #e85181;">
                	<h1 class="modal-title text-white fs-5 p-2" id="titleModal"></h1>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
               		<div class="modal-body mt-1">
               			<div class="me-2 mb-3">
                    		<div class="p-3 pb-4">
                        		<form action="#" class="ms-2" id="addOrModifyForm">
                        			<div class="d-flex flex-row justify-content-between mt-2">
                            			<div class="d-flex flex-column me-2 w-100">
                        					<label for="cars" class="fw-bold">Clientes</label>
                                          	<select class="form-select shadow-none" aria-label="Default select example" id="modalCliente">
                     						</select>
                        				</div>
                        				<div class="d-inline-flex flex-column w-50 ms-2">
                                				<label for="cars" class="fw-bold">Profissional</label>
                                                <select class="form-select shadow-none" aria-label="Default select example" id="modalProfissional">
                                                </select>  
                            			</div>
                            		</div>
                                	<div class="d-flex flex-row justify-content-between mt-2">
                        				<div class="d-inline-flex flex-column w-50">
                            				<label for="cars" class="fw-bold">Procedimentos</label>
                                            <select class="form-select shadow-none" aria-label="Default select example" id="modalProcedimento">
                                            </select>  
                            			</div>
                                    	<div class="d-flex flex-column w-50 ms-2">
                                    		<label for="cars" class="fw-bold">Data</label>
                                       		<input type="date" class="form-control shadow-none" id="modalData">
                                    	</div>
                                	</div>
                                	<div class="d-flex flex-row justify-content-between mt-2">
                        				<div class="d-inline-flex flex-column w-100">
                            				<label for="cars" class="fw-bold">Horários</label>
                        					<div id="modalHorarios">
                        						<p>Aguardando mais informações...</p>
                        					</div> 
                            			</div>
                                    	<div class="d-flex flex-column w-25 ms-2">
                                    		<label for="cars" class="fw-bold">Valor</label>
                                       		<input type="text" class="form-control shadow-none" disabled id="modalValor">
                                       		
                                    	</div>
                                	</div>
                                    <div class="d-flex flex-row justify-content-end mt-5">
                                    	<div id="agendarBtn">
                                    		<input type="submit" class="btn btn-sm btn-primary me-2" value="Agendar">
                                    	</div>
                                    	<input type="submit" class="btn btn-sm btn-secondary" value="Cancelar" data-bs-dismiss="modal" aria-label="Close">
                                    </div>
                        		</form>
                        	</div>
                    	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-center fs-5" id="exampleModalLabel">Você deseja excluir o agendamento?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="deleteAgendamento" enctype="multipart/form-data">
                    <div class="modal-content">
                    	<div class="modal-body">
                    		<p>Você tem certeza de que deseja excluir permanentemente esse agendamento?</p>
                    	</div>
                    </div>
                    <div class="modal-footer" id="deleteBtn">
                    	<input type="submit" class="btn btn-danger" value="Excluir">
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
   	<script src="public/assets/js/manicure.js"></script>
    </body>
</html>