<!DOCTYPE html>
<html lang="en">

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
                        <a class="text-white pr-3" href="cadastrar">CADASTRAR</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="login">ENTRAR</a>
                        <span class="text-white">|</span>
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
                     <a href="index" class="nav-item nav-link active">Home</a>
                        <a href="email" class="nav-item nav-link">Contato</a>
                    </div>
                    <a href="index" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>NAILS</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="portifolio" class="nav-item nav-link">Portifólio</a>
                        <a href="agendamento" class="nav-item nav-link">Agendamento</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
  
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5">LOGIN</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="contact-form bg-light rounded p-5">
                        <div id="success"></div>
                        <form name="sentMessage" id="loginForm" novalidate="novalidate">
                            <div class="form-row">
                                <div class="col-sm-6 control-group">
                                    <input type="text" class="form-control p-4" id="cpf" name="cpf" class="input" placeholder="Seu CPF" required="required" data-validation-required-message="Please enter your cpf" />
                                    <p class="help-block text-danger"></p>
                                    <div name="msgCpf"></div>
                                </div>
                                <div class="col-sm-6 control-group">
                                    <input type="password" class="form-control p-4" class="input" name="senha" placeholder="Sua Senha " required="required" data-validation-required-message="Please enter your senha" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div>
                            	<div id="loginBtn">
                            		<button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Entrar</button>
                            	</div>
                                

                        <a class="text-pink pr-3" href="loginmani">ACESSO MANICURE</a>
                      
                            </div>
                        </form>
                    </div>
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
    </div>
 
  <!-- rodape -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">i</span>NAILS</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-secondary btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Endereço</h5>
                            <p class="mb-2">Av alguma coisa, Guarulhos, BR</p>
                            <p class="mb-0">55 11 9xxxxx-xxx</p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Horário de Funcionamento (fictício)</h5>
                            <p class="mb-2">Seg – Sáb, 8AM – 5PM</p>
                            <p class="mb-0">Domingo: Fechado</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">&copy;Todos os Direitos Reservados. 
                    </p>
                </div>
            </div>
        </div>
    </div>
        <!-- Conexão JS para o Arquivo login.js -->
        <script src="public/assets/js/login.js"></script>
    </body>
</html>