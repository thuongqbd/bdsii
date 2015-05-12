$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
	
	//BEGIN product-category-form
	if($('.product-category-form').length){
		
		//get parents cate
		var url = baseUrl + '/product-category/get-parents-list';
		$('input[type="radio"][name="ProductCategory[product_type]"]').change(function(){
			console.log($(this).val());
			$.post(url,{'product_type':$(this).val(),'category_id':$('#productcategory-category_id').val()},function(result){
               
				console.log( $('#productcategory-parent_id').closest('.form-group').removeClass('has-success'));
				 $('#productcategory-parent_id').replaceWith(result)
            });
		})
	}
	//END product-category-form
	
	//BEGIN product-form
	if($('.product-form').length){
		
		//get parents cate
		var url = baseUrl  + '/product/get-categories';
		$('input[type="radio"][name="Product[product_type]"]').change(function(){
			console.log($(this).val());
			$.post(url,{'product_type':$(this).val()},function(result){
               
//				console.log( $('#productcategory-parent_id').closest('.form-group').removeClass('has-success'));
				 $('#product-product_cate').replaceWith(result)
            });
		})
	}
	//END product-form
})