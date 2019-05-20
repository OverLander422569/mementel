
var categories = [];
$.ajax({
	url:'categorie-controller.php?query=get',
	type: 'POST',
	dataType:'json', 
	success: function (result){
		console.log(result);
		categories=result;
		$.each(categories, function(key, value){
			
			$('#select-filtre').append($('<option>',{
				value:value.ID,
				text: value.intitule})
			);
			$('#select-filtre').selectpicker('refresh');
			});
		}
});

var contacts = [];
$.ajax({
	url:'contact-controller.php?query=get',
	type: 'POST',
	dataType:'json', 
	success: function (result){
		console.log(result);
		contacts=result;
	}
});


	var processEditButtonCategorie = function () {
		if($("#table-categorie>tbody>tr.active th").text()==""){
			$("#modifier-categorie").prop("disabled",true);
			$("#supprimer-categorie").prop("disabled",true);
		}
		else{
			$("#modifier-categorie").prop("disabled",false);
			$("#supprimer-categorie").prop("disabled",false);
		}
	};
	
	var processEditButtonContact = function () {
		if($("#table-contact>tbody>tr.active th").text()==""){
			$("#modifier-contact").prop("disabled",true);
			$("#supprimer-contact").prop("disabled",true);
		}
		else{
			$("#modifier-contact").prop("disabled",false);
			$("#supprimer-contact").prop("disabled",false);
		}
	};
	

	
	$('#table-categorie').on('click', '.clickable-row', function(e){
		$(this).addClass('active').siblings().removeClass('active');
		$('input[name="categorie-id"]').val($("#table-categorie>tbody>tr.active th").text());
		processEditButtonCategorie();
	});
	$('#ajouter-categorie').on('click', function(e){
		$('input[name="categorie-id-modifier"]').val("");
		$('#intitule').val("");
	});
	$('#modifier-categorie').on('click', function(e){
		
		$.each(categories, function(key, value){
			if($("#table-categorie>tbody>tr.active th").text()==value.ID){
				$('#intitule').val(value.intitule);
				$('input[name="categorie-id-modifier"]').val($("#table-categorie>tbody>tr.active th").text());
			}
		});
		
	});
	
	$('#table-contact').on('click', '.clickable-row', function(e){
		$(this).addClass('active').siblings().removeClass('active');
		$('input[name="contact-id"]').val($("#table-contact>tbody>tr.active th").text());
		processEditButtonContact();
	});
	$('#ajouter-contact').on('click', function(e){
		$('input[name="contact-id-modifier"]').val("");
		
		$('#nom').val("");
		$('#prenom').val("");
		$('#pseudo').val("");
		$('#dateDeNaissance').val("");
		$('#chemin_photo').val("");
		$('#estProfessionnel').prop('checked',false);
		$('input[name="contact-id-modifier"]').val("");
	});	
	$('#modifier-contact').on('click', function(e){
		
		$.each(contacts, function(key, value){
			if($("#table-contact>tbody>tr.active th").text()==value.ID){
				$('#nom').val(value.nom);
				$('#prenom').val(value.prenom);
				$('#pseudo').val(value.pseudo);
				$('#dateDeNaissance').val(value.dateNaissance);
				$('#chemin_photo').val(value.chemin_photo);
				$('#estProfessionnel').prop('checked',value.estProfessionnel==1);
				$('input[name="contact-id-modifier"]').val($("#table-contact>tbody>tr.active th").text());
			}
		});
		
	});
	
	processEditButtonCategorie(); 
	processEditButtonContact ();
