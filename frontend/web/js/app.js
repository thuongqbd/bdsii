var App = {
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
	},
	changeSearchBox:function(obj){
		//change value for product cate
		$("#product-product_cate").html("");
		$("#product-product_cate").select2({
			data: listCate[$(obj).data('value')],
			"theme":"krajee","placeholder":message.product_cate,"language":curLang,"allowClear": true
		  });
		 $("#product-product_cate").val(null).trigger("change");
		//change value for price
		$("#product-price").html("");
		$("#product-price").select2({
			data: listPriceType[$(obj).data('value')],
			"theme":"krajee","placeholder":message.price,"language":curLang,"allowClear": true
		  });

		$('.product-type-tab').removeClass('active');
		$(obj).addClass('active');
		$('#product_type_hidden').val($(obj).data('value'))
	},
	searchBoxInit:function(){	
		App.changeSearchBox($('.product-type-tab.active'));
		$('.product-type-tab').on('click',function(event){
			console.log(listCate[$(this).data('value')]);
			App.changeSearchBox(this);
			event.preventDefault();	
		})		
	},
}
$(function() {
	App.searchBoxInit();
	if($('#filter-order').length){
		$('#filter-order').on('change',function(){
			$(this).closest('form').submit();
		})
		
	}
})