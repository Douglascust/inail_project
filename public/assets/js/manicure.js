$(document).ready(function () {
 
	var responseAgendamento;
	var responseCliente;
	var responseProcedimento;
	var responseProfissional;

	function getAgendamento(){
		var action = "consultarTudo";
		$.ajax({
			url:"ctrlagendacliente",
			method:"POST",
			dataType:"json",
			contentType:"application/json;charset=UTF-8",
			data: JSON.stringify({
				acao:action
			}),
    		success: function(data){
				localStorage.setItem('responseAgendamento', JSON.stringify(data));
   			}
		});
	}
	
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
				procedimentos+="<option value="+responseProcedimento.results[i].idProcedimento+">"+responseProcedimento.results[i].tipoProcedimento+"</option>"
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

	function formatDate(date, format){
		if(format == "SQL"){
			date = date.split("/");	
			date = date[2]+"-"+date[1]+"-"+date[0];
		}
		else{
			date = date.split("-");	
			date = date[2]+"/"+date[1]+"/"+date[0];
		}
		return date;	
	}
	
	function verifyDateInResponse(date, responses){
		for(let i = 0; i < responses.results.length; i++){
			let responseDate = responses.results[i].data;
			if(isDay == false){
				responseDate = responseDate.split("-")[1];
				if(responseDate == dayOrMonth){
					return true;
				}
			}else{
				responseDate = responseDate.split("-")[2];
				if(responseDate == dayOrMonth){
					return true;
				}
			}
		}
		return false; 
	}
	
	function getDayName(date){
		var dayName = new Date(date);
		return dayName.toLocaleDateString("pt-BR", { weekday: "long" });
	}
	
	function showCalendarEvents(response){
		var icon = '<p class="evento" style="margin: -13px -13px; font-weight:bold; font-size: 20px;pointer-events: none;">·</p>';
		let currentMonth = $(".current-date").text().split(", ")[0];
		currentMonth = months.indexOf(currentMonth)+1;
		//console.log("currentMonth: "+currentMonth+", dayOrMonthInResponse: "+dayOrMonthInResponse(currentMonth, response));
		if(dayOrMonthInResponse(currentMonth, response)){
			for(let i = 0; i < response.results.length; i++){
				let date = response.results[i].data;
				date = date.split("-");
				let currentDate = months[date[1]-1]+", "+date[0];
				console.log("currentDate: "+$(".current-date").text()+", dataDate: "+currentDate+", currentDate==dataDate?")
				console.log($(".current-date").text() == currentDate)
				if($(".current-date").text() == currentDate){
					date[2] = date[2].startsWith("0",0) ? date[2].slice(1) : date[2];
					if($("li:contains("+date[2]+"):first").attr("class") != "active"){
						$("li:contains("+date[2]+"):first").css("color", "#e83e8c");
					}
					$("li:contains("+date[2]+"):first").html(date[2]+icon);
				}	
			}
		}
	}
	
	function getSelectedBtn() {
	    var opcoes = document.getElementsByName("options-outlined");
	    for (var i = 0; i < opcoes.length; i++) {
	      if (opcoes[i].checked) {
			return opcoes[i].value;
	      }
	    }
	    return null;
   }
	
	function showEvents(response, specificDay){
		let events = '';
		if(specificDay == null){
			let currentMonth = $(".current-date").text().split(", ")[0];
			$("#scheduleH1").html("Agendamentos para "+currentMonth);
			currentMonth = months.indexOf(currentMonth)+1;
			
			if(dayOrMonthInResponse(currentMonth, response)){
				for(let i = 0; i < response.results.length; i++){
					let date = response.results[i].data;
					date = date.split("-");
					let currentDate = months[date[1]-1]+", "+date[0];
					if($(".current-date").text() == currentDate){
						events += '<tr> \
								<td class="idProfissional'+(i+1)+'" value='+response.results[i].idProfissional+'>'+translateId(response.results[i].idProfissional, responseProfissional, type="profissional")+'</td> \
		                        <td class="idProcedimento'+(i+1)+'" value='+response.results[i].idProcedimento+'>'+translateId(response.results[i].idProcedimento, responseProcedimento, type="procedimento")+'</td> \
		                        <td class="idCliente'+(i+1)+'" value='+response.results[i].idCliente+'>'+translateId(response.results[i].idCliente, responseCliente)+'</td> \
		                        <td class="data'+(i+1)+'">'+formatDate(response.results[i].data)+'</td> \
								<td class="hora'+(i+1)+'">'+response.results[i].hora+'</td> \
		                        <td class="preco'+(i+1)+'">'+response.results[i].preco+'</td> \
		                        <td class="idAgendaCliente'+(i+1)+'" hidden>'+response.results[i].idAgendaCliente+'</td> \
		                        <td class="idRecurso'+(i+1)+'" hidden>'+response.results[i].idRecurso+'</td> \
		                        <td> \
		                           	<div class="d-flex flex-row justify-content-center"> \
		                              	<div class="me-2"> \
		                               		<button class="btn btn-outline-primary btn-sm" id="editEvent" value='+(i+1)+' name="table"><i class="bi bi-pencil-square"></i></button> \
		                               	</div> \
		                               	<div> \
		                          	 	   <button class="btn btn-outline-danger btn-sm" id="delEvent" value='+(i+1)+' name="table"><i class="bi bi-trash3"></i></button> \
		                                </div> \
		                            </div> \
		                        </td> \
		                    </tr>';
						$("#events").html(events);
						$("#eventTable").show();
					}	
				}
			}
			else{
				$("#events").html('<p class="text-white">Sem agendamentos no sistema.</p>');
				$("#eventTable").hide();
			}
		}
		else{
			if(dayOrMonthInResponse(specificDay, response, isDay=true)){
				for(let i = 0; i < response.results.length; i++){
					let date = response.results[i].data;
					date = date.split("-")[2];
					if($("#date").text().search(date) == 0){
						events += "<div class='border border-primary rounded mb-2'> \
                    			<div class='d-flex flex-column align-items-start pt-2 ms-3 me-3 border-bottom'> \
                    				<div class='d-flex flex-row justify-content-between w-100'> \
                    					<div class='mt-2'>\
                    						<h5 class='text-primary'><a style='font-weight:bold' class='idCliente"+(i+1)+"' value="+response.results[i].idCliente+">"+translateId(response.results[i].idCliente, responseCliente)+"</a></h5> \
                    					</div>\
                    					<div class='mb-2'> \
                    						<button class='btn btn-outline-primary btn-sm ' id='editEvent' value="+(i+1)+" name='modal'><i class='bi bi-pencil-square'></i></button> \
                    						<button class='btn btn-outline-danger btn-sm' id='delEvent' value="+(i+1)+" name='modal'><i class='bi bi-trash3'></i></button> \
                    					</div> \
                    				</div> \
                        		</div> \
                        		<div class='d-flex flex-row pt-2 ms-3 me-3' style='font-size:15px'> \
                        			<div class='d-flex flex-column align-items-start w-100'> \
                        				<p>Procedimento:<a style='font-weight:bold' class='idProcedimento"+(i+1)+"' value="+response.results[i].idProcedimento+">"+translateId(response.results[i].idProcedimento, responseProcedimento, type="procedimento")+"</a></p> \
                        				<p>Horário:<a style='font-weight:bold'class='hora"+(i+1)+"'>"+response.results[i].hora+"</a></p> \
                        				<a style='font-weight:bold'class='data"+(i+1)+"' hidden>"+response.results[i].data+"</a>\
                        				<a style='font-weight:bold'class='idAgendaCliente"+(i+1)+"' hidden>"+response.results[i].idAgendaCliente+"</a>\
                        				<a style='font-weight:bold'class='idRecurso"+(i+1)+"' hidden>"+response.results[i].idRecurso+"</a>\
                        			</div> \
                        			<div class='d-flex flex-column align-items-start w-25'> \
                        				<p>Preço:<a style='font-weight:bold' class='preco"+(i+1)+"'>"+response.results[i].preco+"</a></p> \
                        				<p>Profissional:<a style='font-weight:bold' class='idProfissional"+(i+1)+"' value="+response.results[i].idProfissional+">"+translateId(response.results[i].idProfissional, responseProfissional, type="profissional")+"</a></p> \
                        			</div> \
                        		</div> \
                    		</div>";
						$("#selectedDayEvents").html(events);
					}	
				}
			}
			else{
				$("#selectedDayEvents").html('<p>Sem agendamentos no sistema.</p>');
			}
		}
	}

	const daysTag = document.querySelector(".days"),
    currentDate = document.querySelector(".current-date"),
    prevNextIcon = document.querySelectorAll(".icons span");
    
    let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();
    const months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho","Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    const renderCalendar = () => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); 
        let liTag = "";
    
       	for (let i = firstDayofMonth; i > 0; i--) {
            liTag += `<li class="inactive"></li>`;
        }
        for (let i = 1; i <= lastDateofMonth; i++) {
            let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                         && currYear === new Date().getFullYear() ? "active" : "";
            liTag += `<li class="${isToday}">${i}</li>`;
        }
        for (let i = lastDayofMonth; i < 6; i++) {
            liTag += `<li class="inactive"></li>`
        }
        currentDate.innerText = `${months[currMonth]}, ${currYear}`;
        daysTag.innerHTML = liTag;
    }
    renderCalendar();
    
    daysTag.addEventListener("click", function ( event ) {
		let day = event.target.textContent.replace("·", "");
		day = day.length == 1 ? "0"+day : day;
        if (event.target.tagName === "LI") {
            let currentDate = $(".current-date").text().split(", ");
            let year = currentDate[1];
            let month = currentDate[0];
            let numMonth = months.indexOf(currentDate[0]) + 1;
            let date = numMonth + "/" + day + "/" + year;
            let dayName = getDayName(date);
            $("#date").html(day + " de " + month + "</br>" + dayName);
			getAgendamento();
			responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
			showEvents(responseAgendamento, day)

            $("#modalSelectedDay").modal("show");	
        }
    });
    
    
    prevNextIcon.forEach(icon => { // getting prev and next icons
        icon.addEventListener("click", () => { // adding click event on both icons
            // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
    
            if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
                // creating a new date of current year & month and pass it as date value
                date = new Date(currYear, currMonth, new Date().getDate());
                currYear = date.getFullYear(); // updating current year with new date year
                currMonth = date.getMonth(); // updating current month with new date month
            } else {
                date = new Date(); // pass the current date as date value
            }
            renderCalendar(); // calling renderCalendar function
        });
    });

	getCliente();
	responseCliente = JSON.parse(localStorage.getItem('responseCliente'));
	getProcedimento();
	responseProcedimento = JSON.parse(localStorage.getItem('responseProcedimento'));
	getProfissional();
	responseProfissional = JSON.parse(localStorage.getItem('responseProfissional'));

    getAgendamento();
	responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
	showEvents(responseAgendamento);
	showCalendarEvents(responseAgendamento);
	
	$("span").click(function( event ){
		getAgendamento();
		responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
		showEvents(responseAgendamento);
		showCalendarEvents(responseAgendamento);
	});
	
	$(document).on("click","#addEvent",function( event ){
		$("#titleModal").html("Novo agendamento");
		$("#modalProfissional").html(optionsProfissionais());
		$("#modalProcedimento").html(optionsProcedimentos());
		$("#modalCliente").html(optionsClientes());
		let oldBtn = '<input type="submit" class="btn btn-sm btn-primary me-2" value="Agendar">';
			$("#agendarBtn").html(oldBtn);
		$("#addOrModifyModal").modal("show");
		
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
			event.preventDefault();
			var action = "inserir";
			var idAgendaCliente = 0;
			var idRecurso = 1;
			var idProfissional = $("#modalProfissional").find(":selected").attr("value")
			var idCliente = $("#modalCliente").find(":selected").attr("value")
			var idProcedimento = $("#modalProcedimento").find(":selected").attr("value")
			var data = $("#modalData").val();
			var hora = getSelectedBtn()
			var preco = $("#modalValor").val();
			
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
								getAgendamento();
								setTimeout(function () {
								  responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
								  showEvents(responseAgendamento);
								  showCalendarEvents(responseAgendamento);
								}, 1000); 
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
			//console.log(idProfissional+"\n"+idCliente+"\n"+idProcedimento+"\n"+data+"\n"+hora+"\n"+valor)
			
		});
	});
	$(document).on("click", "#editEvent",function( event ){
		var indexBtn = $(this).attr("value");
		if($(this).attr("name") == "modal"){
			var row = $(this).closest("div #selectedDayEvents");
			var data = row.find(".data"+indexBtn).text(); 	
		}
		else{
			var row = $(this).closest("tr");
			var data = formatDate(row.find(".data"+indexBtn).text(), "SQL"); 
		}
		var idAgendaCliente = row.find(".idAgendaCliente"+indexBtn).text();
		var idRecurso = 1;
        var idProfissional = row.find(".idProfissional"+indexBtn).text();
		var idProcedimento = row.find(".idProcedimento"+indexBtn).text();
        var idCliente = row.find(".idCliente"+indexBtn).text();
        var hora = row.find(".hora"+indexBtn).text();
        var preco = row.find(".preco"+indexBtn).text();
        $("#modalProfissional").html("<option value='"+row.find(".idProfissional"+indexBtn).attr("value")+"'>"+idProfissional+"</option>"+optionsProfissionais(row.find(".idProfissional"+indexBtn).attr("value")));
        $("#modalProcedimento").html("<option value='"+row.find(".idProcedimento"+indexBtn).attr("value")+"'>"+idProcedimento+"</option>"+optionsProcedimentos(row.find(".idProcedimento"+indexBtn).attr("value")));
        $("#modalCliente").html("<option value='"+row.find(".idCliente"+indexBtn).attr("value")+"'>"+idCliente+"</option>"+optionsClientes(row.find(".idCliente"+indexBtn).attr("value")));
        $("#modalData").val(data);
        $("#modalHora").html("<input type='radio' class='btn-check' name='ptions-outlined' id='btn1' autocomplete='off'>\
                              <label class='btn btn-outline-primary' for='btn1'>"+hora+"</label>");
        $("#modalValor").val(preco);
		$("#titleModal").html("Atualizar agendamento");
		let oldBtn = '<input type="submit" class="btn btn-sm btn-primary me-2" value="Atualizar">';
			$("#agendarBtn").html(oldBtn);
		$("#addOrModifyModal").modal("show");
		$("#modalProfissional, #modalProcedimento, #modalData").change(function( event ){
			var idProcedimento = $("#modalProcedimento").find(":selected").attr("value");
			$("#modalValor").attr("value", translateId(idProcedimento, responseProcedimento, type="procedimentoPreco"));
			if($("#modalData").val() != ""){
				var action = "consultarHorarios";
				idProfissional = $("#modalProfissional").find(":selected").attr("value")
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
			$("#addOrModifyForm").off("submit").on("submit", function( event  ){
				action = "atualizar";
				idCliente = $("#modalCliente").find(":selected").attr("value");
				hora = getSelectedBtn();
		        event.preventDefault();
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
									getAgendamento();
									setTimeout(function () {
									  responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
									  showEvents(responseAgendamento);
									  showCalendarEvents(responseAgendamento);
									}, 1000); 
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
		});
	});
	$(document).on("click", "#delEvent",function( event ){
		$("#deleteModal").modal("show");
		var indexBtn = $(this).attr("value");
		if($(this).attr("name") == "modal"){
			var row = $(this).closest("div #selectedDayEvents");
			var data = row.find(".data"+indexBtn).text();
			alert(data) 	
		}
		else{
			var row = $(this).closest("tr");
			var data = formatDate(row.find(".data").text(), "SQL"); 
		}
		$("#deleteAgendamento").off("submit").on("submit", function(event){
	        event.preventDefault();
	        var action = "excluir";
	        var idAgendaCliente = row.find(".idAgendaCliente"+indexBtn).text();
	        var idRecurso = row.find(".idRecurso"+indexBtn).text();
			var idProfissional = row.find(".idProfissional"+indexBtn).text();
			var idProcedimento = row.find(".idProcedimento"+indexBtn).text();
	        var idCliente = row.find(".idCliente"+indexBtn).attr("value");
	        var hora = row.find(".hora"+indexBtn).text();
	        var preco = row.find(".preco"+indexBtn).text();
		        
			let newBtn = '<button class="btn btn-danger" type="button" disabled>\
						  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>\
						  <span class="visually-hidden" role="status">Loading...</span>\
						</button>';
			let oldBtn = '<input type="submit" class="btn btn-danger" value="Excluir">';
			$("#deleteBtn").html(newBtn);
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
								getAgendamento();
								setTimeout(function () {
									renderCalendar();
									responseAgendamento = JSON.parse(localStorage.getItem('responseAgendamento'));
								  	showEvents(responseAgendamento);
								  	showCalendarEvents(responseAgendamento);
								
								}, 1000); 
			                    $("#deleteModal").modal("hide");
			                    $("#successMessage").html(data.results.message);
								$("#successModal").modal("show");
			                }
			                else{
								$("#deleteModal").modal("hide");
								$("#errorMessage").html(data.results.message);
								$("#errorModal").modal("show");
			                }
			            },
			            error: function (xhr, status, error){
							$("#deleteModal").modal("hide");
							$("#errorMessage").html("Aconteceu um erro na sua requisição, tente novamente mais tarde.");
							$("#errorModal").modal("show");
			                console.error("Erro na solicitação AJAX:", status, error);
							console.error("Resposta completa:", xhr.responseText);
			            },
			            complete: function(){
			                $("#deleteBtn").html(oldBtn);
			            }
			        });
                }, 1000);
	    }); 
	});
	$("#searchInput").on("keyup", function(){
		var value = $(this).val().toLowerCase();
		$("#events tr").filter(function(){
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
	});  		
});