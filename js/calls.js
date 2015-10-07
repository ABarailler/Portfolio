$( document ).ready(function() {
	
	// scroll en haut de la page
	$(".navbar-header a").on('click', function(){
    	$('body,html').animate({scrollTop: 0}, 1000);
		return false;
    });
	
	// scroll sur la position dans la page
	$(".navbar-right li a").on('click', function(value){
		var link = value['currentTarget']['href'];
		var parts = link.split('#', 2);
		parts[1] = "#"+parts[1];
		$('html, body').animate({scrollTop:$(parts[1]).position().top-89}, 1000);
		return false;
	});

   	$('body').scrollspy({offset: 100},{target: '#menu'});
	
   	// Action quand click sur submit
	$("#submitForm").on("click", function (){
		var test = true;
		var displayErrors = [];
		for (key in tabErrors){
			if (tabErrors[key] != 1){
				if (tabErrors[key] != 0)
					displayErrors.push(tabErrors[key]);
				else{
					var name = key.replace("input", "");
					if (name == "Name"){
						name = "Nom";
					}else{
						if(name == "Subject"){
							name = "Objet";
						}
					}
					displayErrors.push(name+" requis...");
				}
				test = false;
			}
		}
		if (test){
			$('.bg-success').remove();
			$('.bg-danger').remove();
			$("#info-contact").append('<div class="bg-success col-sm-offset-2 col-sm-8 text-left">Message envoyé...</div>');
			ajoutSucessErreur(tabErrors);
			console.log(tabContent);
		}else{
			console.log(displayErrors);
			var listErrors = '<div class="bg-danger col-sm-offset-2 col-sm-8 text-left"><ul>';
			for ( key in displayErrors){
				listErrors = listErrors + '<li>' + displayErrors[key] + '</li>';
			}
			$('.bg-success').remove();
			$('.bg-danger').remove();
			$("#info-contact").append(listErrors);
			ajoutSucessErreur(tabErrors);
		}
		return false;
	});
});

///////////////////// Initialisation variables /////////////////////
var tabErrors = {
		 "inputName": "0",
		 "inputEmail": "0",
		 "inputSubject": "0",
		 "inputMessage": "0",
	};

var tabContent = {
		 "inputName": "",
		 "inputEmail": "",
		 "inputSubject": "",
		 "inputMessage": "",
	};

///////////////////// Verification /////////////////////
function verifName(champ){
	if (champ.value){
		var regex = /^[A-Za-z éàîïûüëêèÂÉÈÊÎÏÛÜ]+$/ ;
		if((champ.value.length < 3) || !regex.test(champ.value)){
			ajoutError($(champ).prop('id'));
			tabErrors['inputName'] = "Nom non valide !";
		}
		else{
			ajoutSuccess($(champ).prop('id'));
			tabContent['inputName'] = champ.value;
			tabErrors['inputName'] = 1;
		}
	}else{
		clearSucessError($(champ).prop('id'));
		tabErrors['inputName'] = 0;
	}
	
}
function verifEmail(champ){
	if (champ.value){
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		if(!regex.test(champ.value)){
			ajoutError($(champ).prop('id'));
			tabErrors['inputEmail'] = "Le format email est non valide ! ( exemple@gmail.com ) ";
		}
		else{
			ajoutSuccess($(champ).prop('id'));
			tabContent['inputEmail'] = champ.value;
			tabErrors['inputEmail'] = 1;
		}
	}else{
		clearSucessError($(champ).prop('id'));
		tabErrors['inputEmail'] = 0;
	}
}
function verifSubject(champ){
	if (champ.value){
		var regex = /^[A-Za-z éàîïûüëêèÂÉÈÊÎÏÛÜ]+$/ ;
		if((champ.value.length < 3) || !regex.test(champ.value)){
			ajoutError($(champ).prop('id'));
			tabErrors['inputSubject'] = "Objet non valide !";
		}
		else{
			ajoutSuccess($(champ).prop('id'));
			tabContent['inputSubject'] = champ.value;
			tabErrors['inputSubject'] = 1;
		}
	}else{
		clearSucessError($(champ).prop('id'));
		tabErrors['inputSubject'] = 0;
	}
}
function verifMessage(champ){
	if (champ.value){
		if((champ.value.length < 15)){
			ajoutError($(champ).prop('id'));
			tabErrors['inputMessage'] = "Message non valide ! Il doit avoir un minimum de 15 caractéres.";
		}
		else{
			ajoutSuccess($(champ).prop('id'));
			tabContent['inputMessage'] = champ.value;
			tabErrors['inputMessage'] = 1;
		}
	}else{
		clearSucessError($(champ).prop('id'));
		tabErrors['inputMessage'] = 0;
	}
}
///////////////////// ajout affichage /////////////////////
function ajoutSuccess(nameInput){
	var zoneForm = nameInput.replace("input", "form");
	var zoneAppend = nameInput.replace("input", "content");
	zoneForm = "#" + zoneForm;
	zoneAppend = "#" + zoneAppend;
	
	$(zoneForm).removeClass("has-error");
	$(zoneAppend+' .glyphicon').remove();
	$(zoneAppend+' .sr-only').remove();
	
	$(zoneForm).addClass("has-success");
	$(zoneAppend).append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>'
	+'<span class="sr-only">(success)</span>');
}
function ajoutError(nameInput){
	var zoneForm = nameInput.replace("input", "form");
	var zoneAppend = nameInput.replace("input", "content");
	zoneForm = "#" + zoneForm;
	zoneAppend = "#" + zoneAppend;
	
	$(zoneForm).removeClass("has-success");
	$(zoneAppend+' .glyphicon').remove();
	$(zoneAppend+' .sr-only').remove();
	
	$(zoneForm).addClass("has-error");
	$(zoneAppend).append('<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>'
	+'<span id="inputError2Status" class="sr-only">(error)</span>');
}

 function ajoutSucessErreur(tabResult){
	for (key in tabResult) {
		if ( tabResult[key] == 1){
			ajoutSuccess(key);
		}else{
			ajoutError(key);
		}
	}
}
function clearSucessError(nameInput){
	var zoneForm = nameInput.replace("input", "form");
	var zoneAppend = nameInput.replace("input", "content");
	zoneForm = "#" + zoneForm;
	zoneAppend = "#" + zoneAppend;
	$(zoneForm).removeClass("has-error").removeClass("has-success");
	$(zoneAppend+' .glyphicon').remove();
	$(zoneAppend+' .sr-only').remove();
}

///////////////////// Envoi de l'email /////////////////////
function sendMail(){
	//TODO
}
	
