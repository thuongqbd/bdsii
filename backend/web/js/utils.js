var Utils = {
	ajaxUpdate:function(url,action,id,event){
		event.preventDefault();
		$.ajax({
			type     :'POST',
			cache    : false,
			data: { "ajax": true,"action": action, "id": id },
			url  : url,
			success  : function(response) {
				response = JSON.parse(response);
				if(response.result){
					$('#'+action+'-'+response.id).html("<span class='glyphicon glyphicon-ok text-success'></span>");
				}else{
					$('#'+action+'-'+response.id).html("<span class='glyphicon glyphicon-remove text-danger'></span>");
				}
			}
		});
	},
	changeAddress:function(id,obj,type){
//		type==1 or undefined is add , type==2 is remove
		var city = $('#'+id+'-city option:selected');
		var district = $('#'+id+'-district option:selected');
		var ward = $('#'+id+'-ward option:selected');
		var street = $('#'+id+'-street option:selected');
		var project = $('#'+id+'-project_id option:selected');
		var address = '#'+id+'-address';	
		console.log('city-'+city.text(),'district-'+district.text(),'ward-'+ward.text(),'street-'+street.text(),'project-'+project.text());
		var getAddress = function(){
			if($(obj).attr('id').search('city') != -1 || ($(obj).attr('id').search('district') != -1 && !district.val())){
				console.log('district',$(address).val(),obj);
				$(address).val(city.text());
				GoogleMapWidget.showLocation($(address).val());
			}else if($(obj).attr('id').search('district') != -1){
				console.log('district',$(address).val(),obj);
				$(address).val(district.text() +', '+ city.text());
				GoogleMapWidget.showLocation($(address).val());
			}else if(project.val() && project.text().search('Loading ...') == -1 && district.val() && city.val()){
				$(address).val('Dự án '+project.text() +', '+ district.text() +', '+ city.text());
				console.log($(address).val(),obj);
				if($('#project-lat').length && $('#project-lat').val() && $('#project-lng').length && $('#project-lng').val())
					GoogleMapWidget.showProjectLocation($('#project-lat').val(),$('#project-lng').val(),$(address).val());
				else
					GoogleMapWidget.showLocation($(address).val());
			}else if(street.val() && street.text().search('Loading ...') == -1 && district.val() && city.val()){
				$(address).val(street.text() +', '+ district.text() +', '+ city.text());
				console.log('street',$(address).val(),obj);
				GoogleMapWidget.showLocation($(address).val());
			}else if(ward.val() && ward.text().search('Loading ...') == -1 && district.val() && city.val()){
				$(address).val(ward.text() +', '+ district.text() +', '+ city.text());
				console.log('ward',$(address).val(),obj);
				GoogleMapWidget.showLocation($(address).val());
			}else if(district.val() && district.text().search('Loading ...') == -1 && city.val()){
				$(address).val(district.text() +', '+ city.text());
				console.log('district',$(address).val(),obj);
				GoogleMapWidget.showLocation($(address).val());
			}else{
				$(address).val(city.text());
				console.log('city',$(address).val(),obj);
				GoogleMapWidget.showLocation($(address).val());
			}
		};
		if(typeof type == 'undefined' || type==1){
			if($(address).val().search($(obj).find('option:selected').text()) == -1){
				getAddress();
			}
		}else{
			getAddress ();
		}
	}
}
