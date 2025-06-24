	var responseCliente;
	var responseProcedimento;
	var responseProfissional;

	function getProcedimento(){
		var action = "consultarTudo";
		$.ajax({
			url:"ctrlprocedimento",
			method:"POST",
			dataType:"json",
			contentType:"application/json;charset=UTF-8",
			data: JSON.stringify({
				acao:action
			}),
    		success: function(data){
				localStorage.setItem('responseProcedimento', JSON.stringify(data));
   			}
		});
	}
	function getProfissional(){
		var action = "consultarTudo";
		$.ajax({
			url:"ctrlprofissional",
			method:"POST",
			dataType:"json",
			contentType:"application/json;charset=UTF-8",
			data: JSON.stringify({
				acao:action
			}),
    		success: function(data){
				localStorage.setItem('responseProfissional', JSON.stringify(data));
   			}
		});
	}
	function getCliente(){
		var action = "consultarTudo";
		$.ajax({
			url:"ctrlcliente",
			method:"POST",
			dataType:"json",
			contentType:"application/json;charset=UTF-8",
			data: JSON.stringify({
				acao:action
			}),
    		success: function(data){
				localStorage.setItem('responseCliente', JSON.stringify(data));
   			}
		});
	}
	function optionsClientes(filteredBy = null){
		let clientes;
		if(filteredBy == null){
			for(let i = 0; i < responseCliente.results.length; i++){
				clientes+="<option value="+responseCliente.results[i].idCliente+">"+responseCliente.results[i].nome+"</option>"
			}
		}
		else{
			for(let i = 0; i < responseCliente.results.length; i++){
				if(filteredBy != responseCliente.results[i].idCliente){
					clientes+="<option value="+responseCliente.results[i].idCliente+">"+responseCliente.results[i].nome+"</option>"
				}
			}
		}
		return clientes
	}
	function optionsProcedimentos(filteredBy = false){
		let procedimentos;
		if(filteredBy == null){
			for(let i = 0; i < responseProcedimento.results.length; i++){
				procedimentos+="<option value="+responseProcedimentos.results[i].idProcedimento+">"+responseProcedimentos.results[i].tipoProcedimento+"</option>"
			}
		}
		else{
			for(let i = 0; i < responseProcedimento.results.length; i++){
				if(filteredBy != responseProcedimento.results[i].idProcedimento){
					procedimentos+="<option value="+responseProcedimento.results[i].idProcedimento+">"+responseProcedimento.results[i].tipoProcedimento+"</option>"
				}
			}
		}
		return procedimentos
	}
	function optionsProfissionais(filteredBy = false){
		let profissionais;
		if(filteredBy == null){
			for(let i = 0; i < responseProfissional.results.length; i++){
				profissionais+="<option value="+responseProfissional.results[i].idProfissional+">"+responseProfissional.results[i].funcao+"</option>"
			}
		}
		else{
			for(let i = 0; i < responseProfissional.results.length; i++){
				if(filteredBy != responseProfissional.results[i].idProfissional){
					profissionais+="<option value="+responseProfissional.results[i].idProfissional+">"+responseProfissional.results[i].funcao+"</option>"
				}
			}
		}
		return profissionais;
	}
	function translateId(id, response, type="cliente"){
		if(type=="cliente"){
			for(let i = 0; i < response.results.length; i++){
				if(id == response.results[i].idCliente){
					return response.results[i].nome;
				}
			}
		}
		else if(type=="procedimento"){
			for(let i = 0; i < response.results.length; i++){
				if(id == response.results[i].idProcedimento){
					return response.results[i].tipoProcedimento;
				}
			}
		}
		else if(type=="profissional"){
			for(let i = 0; i < response.results.length; i++){
				if(id == response.results[i].idProfissional){
					return response.results[i].funcao;
				}
			}
		}
		else if(type=="procedimentoPreco"){
			for(let i = 0; i < response.results.length; i++){
				if(id == response.results[i].idProcedimento){
					return response.results[i].preco;
				}
			}
		}		
	}
	function getSelectedBtn() {
	    var opcoes = document.getElementsByName("options-outlined");
	
	    for (var i = 0; i < opcoes.length; i++) {
	      if (opcoes[i].checked) {
			return opcoes[i].value; // ou qualquer outra propriedade que você queira obter
	      }
	    }
	
	    // Se nenhum botão de rádio estiver selecionado
	    return null;
   }
	getCliente();
	responseCliente = JSON.parse(localStorage.getItem('responseCliente'));
	getProcedimento();
	responseProcedimento = JSON.parse(localStorage.getItem('responseProcedimento'));
	getProfissional();
	responseProfissional = JSON.parse(localStorage.getItem('responseProfissional'));

	$("#modalProfissional").html(optionsProfissionais());
	$("#modalProcedimento").html(optionsProcedimentos());
	$("#modalCliente").html(optionsClientes());

   $("#modalProfissional, #modalProcedimento, #modalData").change(function( event ){
			var idProcedimento = $("#modalProcedimento").find(":selected").attr("value");
			$("#modalValor").attr("value", translateId(idProcedimento, responseProcedimento, type="procedimentoPreco"));
			if($("#modalData").val() != ""){
				var action = "consultarHorarios";
				var idProfissional = $("#modalProfissional").find(":selected").attr("value")
				var data = $("#modalData").val();
				var horarios="";
				$.ajax({
		            url: "ctrlagendacliente",
		            method: "POST",
		            dataType: "json",
		            contentType: "application/json;charset=UTF-8",
		            data: JSON.stringify({
		                acao:action, idProfissional:idProfissional, idProcedimento:idProcedimento, data:data
		            }),
		            success: function(data){
		            	for(let i = 0; i < data.results.length; i++){
							horarios += '<input type="radio" class="btn-check" name="options-outlined" id="horario'+(i+1)+'" value='+data.results[i]+' autocomplete="off">\
	                               <label class="btn btn-outline-primary" for="horario'+(i+1)+'">'+data.results[i]+'</label>';	
						}
						$("#modalHorarios").html(horarios);
				}
			});
		}
	});
	
	$("#addOrModifyForm").off("submit").on("submit", function( event  ){
		let oldBtn = '<input type="submit" class="btn btn-sm btn-primary me-2" value="Agendar">';
			$("#agendarBtn").html(oldBtn);
			event.preventDefault();
			var action = "inserir";
			var idAgendaCliente = 0;
			var idRecurso = $("#modalProfissional").find(":selected").attr("value");
			var idProfissional = $("#modalProfissional").find(":selected").attr("value")
			var idCliente = $("#modalCliente").find(":selected").attr("value")
			var idProcedimento = $("#modalProcedimento").find(":selected").attr("value")
			var data = $("#modalData").val();
			var hora = getSelectedBtn()
			var preco = $("#modalValor").val();
			
			//console.log("data="+data+", hora="+hora);
			
			let newBtn = '<button class="btn btn-sm btn-primary" type="button" disabled>\
						  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>\
						  <span class="visually-hidden" role="status">Loading...</span>\
						</button>';
			$("#agendarBtn").html(newBtn);
			setTimeout(function(){ 
                     $.ajax({
			            url: "ctrlagendacliente",
			            method: "POST",
			            dataType: "json",
			            contentType: "application/json;charset=UTF-8",
			            data: JSON.stringify({
			                acao:action, idAgendaCliente:idAgendaCliente, idRecurso:idRecurso, idProfissional:idProfissional, idProcedimento:idProcedimento, idCliente:idCliente, hora:hora, preco:preco, data:data
			            }),
			            success: function(data){
			                if(data.results.status === "success"){
			                    $("#addOrModifyModal").modal("hide");
			                    $("#successMessage").html(data.results.message);
								$("#successModal").modal("show");
			                }
			                else{
								$("#addOrModifyModal").modal("hide");
								$("#errorMessage").html(data.results.message);
								$("#errorModal").modal("show");
			                }
			            },
			            error: function (xhr, status, error){
							$("#addOrModifyModal").modal("hide");
							$("#errorMessage").html("Aconteceu um erro na sua requisição, tente novamente mais tarde.");
							$("#errorModal").modal("show");
			                console.error("Erro na solicitação AJAX:", status, error);
							console.error("Resposta completa:", xhr.responseText);
			            },
			            complete: function(){
			                $("#agendarBtn").html(oldBtn);
			            }
			        });
                }, 1000);	
	});