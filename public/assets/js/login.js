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
	$("#loginForm").submit(function(){
		event.preventDefault();
		var acao = "login";
		var cpf = $("input[name='cpf']").val();
		var senha = $("input[name='senha']").val();
		let newBtn = '<button class="btn-primary btn-block rounded-pill py-3 px-5" type="button" disabled>\
						  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>\
						  <span class="visually-hidden" role="status">Loading...</span>\
						</button>';
		let oldBtn = '<button class="btn btn-primary btn-block py-3 px-5" type="submit" id="sendMessageButton">Entrar</button>';
			$("#loginBtn").html(newBtn);
		if(validarCpf(cpf)){
			$("input[name='cpf']").css("color", "black");		
    		$("div[name='msgCpf']").hide();
    		setTimeout(function(){ 
	    		$.ajax({
					url:"ctrlcliente",
					method:"POST",
					dataType:"json",
					contentType:"application/json;charset=UTF-8",
					data: JSON.stringify({
						acao:acao, cpf:cpf, senha:senha
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
					     $("#loginBtn").html(oldBtn);
					}
				});
			}, 1000);
		}
		else{
			$("input[name='cpf']").css("color", "red");
			$("div[name='msgCpf']").html("<p>Seu CPF está incorreto!</p>").css("color", "red");
			$("div[name='msgCpf']").show();
		}
		
	});
});