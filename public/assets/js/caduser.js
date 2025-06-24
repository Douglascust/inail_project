$(document).ready(function () {
	$("input").keypress(function( event ){
		if ( event.keyCode === 13 ){
			event.preventDefault();
				$(this).blur();
		}
	});
    // Máscara p/ o CPF 
    $("#cpf").keypress(function() {
        $(this).mask('000.000.000-00');
    });
    // Função para Validação do CPF
    function validarCpf(cpf){
		let cpfStr = cpf.trim(); 
		if (cpfStr.trim().replace(".","").replace(".","").replace("-", "").match(/^[\d]{11}$/g)){
			cpfStr = cpfStr.replace("-",".").split(".");
			num_igual = 0;
			for (let index = 0; index != cpfStr.length; index++) {
				if (index < 3) {
					if (cpfStr[index][0] == cpfStr[index][1] && cpfStr[index][1] == cpfStr[index][2]) {
						num_igual++;
					}
				}
				else{
					if (cpfStr[index][0] == cpfStr[index][1]) {
						num_igual++;
					}
				}
			}
			if (num_igual == 0) {
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	// Função para Validação do Email
	function validarEmail(email){
		let emailStr = email.trim();
		if (emailStr.includes("@") && emailStr.match(/@/g).length == 1){
			emailStr = emailStr.split("@");
			nome_usuario = emailStr[0].trim(); 
			dominio = emailStr[1].trim();
			placar_erro = 0;
			char_especial = ["!","#","$","%","&","*","+","-","/","=","?","^","_","`","{","|","}","~",".","'"]
			if(0 != nome_usuario.length && nome_usuario.length <= 64){
				for (let char = 0; char != nome_usuario.length; char++) {
					if (char_especial.some(el => nome_usuario.includes(el))) {
						if (nome_usuario[char] == "."){
							if (char == 0 || char == nome_usuario.length-1) {
								placar_erro++;  
							}
						}
						if (nome_usuario[char] == nome_usuario[char-1]) {
							placar_erro++;
						}
					}
					else if (nome_usuario[char] == "" || nome_usuario[char].match(/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)) {
						placar_erro++;
					}	
				}
				if (placar_erro == 0) {
					if (0 != dominio.length && dominio.length <= 253) {
						if (dominio.includes(".") && dominio.match(/./g).length > 0) {
							for (let char = 0; char != dominio.length; char++) {
								if (dominio[char] == ".") {
									if (dominio[char] == dominio[char-1]) {
										placar_erro++;
									}
								}
							}
							dominio = dominio.split(".");
							for (let char = 0; char != dominio.length; char++){
								if ((char%2) == 0) {
									if (0 >= (dominio[char] + dominio[char+1]) || (dominio[char] + dominio[char+1]) > 63) {
										placar_erro++;
									}
								}
								if (placar_erro == 0) {
									for (let index = 0; index != dominio.length; index++) {
										if (dominio[index].match(/^\d+$/g)) {
											placar_erro++;
										}
										for (let char = 0; char != dominio[index].length; char++) {
											if (dominio[index][char] == "-") {
												if (char == 0 || char == (dominio[index].length-1)) {
													placar_erro++;
												}
												if (dominio[index][char] == dominio[index][char-1]) {
													placar_erro++;
												}
											}
											else if (dominio[index][char] == "" || dominio[index][char].match(/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/)) {
												placar_erro++;
											}	
										}
									}
									if (placar_erro == 0) {
										return true;
									}
									else{
										return false;
									}
								}
								else{
									return false;
								}	
							}
						}
						else{
							return false;
						}
					}
					else{
						return false;
					}
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	$("#cadastroForm").submit(function(event){
		event.preventDefault();
		var acao = "inserir";
		var idCliente = 0;
		var nome = $("input[name='nome']").val();
		var cpf = $("input[name='cpf']").val();
		var email = $("input[name='email']").val();
		var senha = $("input[name='senha']").val();
		let newBtn = '<button class="btn-primary btn-block rounded-pill py-3 px-5" type="button" disabled>\
						  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>\
						  <span class="visually-hidden" role="status">Loading...</span>\
						</button>';
		let oldBtn = '<button class="btn btn-primary btn-block py-3 px-5" type="submit" id="insertBtn">Cadastrar</button>';
			$("#insertBtn").html(newBtn);
		if(validarCpf(cpf)){
			$("input[name='cpf']").css("color", "black");		
    		$("div[name='msgCpf']").hide();
    		
    		if(validarEmail(email)){
				$("input[name='email']").css("color", "black");
				$("div[name='msgEmail']").hide();
				setTimeout(function(){ 
					$.ajax({
						url:"ctrlcliente",
						method:"POST",
						dataType:"json",
						contentType:"application/json;charset=UTF-8",
						data: JSON.stringify({
							acao:acao, idCliente:idCliente, nome:nome, cpf:cpf, email:email, senha:senha
						}),
						success: function(data){
				        	if(data.results.status === "success"){
				                    $("#successMessage").html(data.results.message);
									$("#successModal").modal("show");
				                }
				                else{
									$("#errorMessage").html(data.results.message);
									$("#errorModal").modal("show");
				                }
				            },
				            error: function (xhr, status, error){
								$("#errorMessage").html("Aconteceu um erro na sua requisição, tente novamente mais tarde.");
								$("#errorModal").modal("show");
				                console.error("Erro na solicitação AJAX:", status, error);
								console.error("Resposta completa:", xhr.responseText);
				            },
				            complete: function(){
				                $("#insertBtn").html(oldBtn);
				            }
					});
				}, 1000);
			}
			else{
				$("input[name='email']").css("color", "red");
				$("input[name='email']").focus();
				$("div[name='msgEmail']").html("<p>Seu e-mail está incorreto!</p>").css("color", "red");
				$("div[name='msgEmail']").show();
			}
		}
		else{
			$("input[name='cpf']").css("color", "red");
			$("input[name='cpf']").focus();
			$("div[name='msgCpf']").html("<p>Seu CPF está incorreto!</p>").css("color", "red");
			$("div[name='msgCpf']").show();
		}
		
	});
});