var src=document.getElementById("page_id").src;
var userId = src.split("userId=")[1];
$('#filter').on('click', function() {
searchGrid();
});
$('#page').on('change', function() {
	var pg = Math.ceil($('#page').val()/5);
	if(pg>=1){
		ppg(pg);
		searchGrid();
	}
});
$('#pg').on('change', function() {
	searchGrid();
});
var searchGrid = function() {
	var selected_sort = $('#order_by').val().toLowerCase();
	var selected_categoryId = $('#filter_category').val().toLowerCase();
	var selected_brandId = $('#filter_brand').val().toLowerCase();
	var selected_supplierId = $('#filter_supplier').val().toLowerCase();
	var selected_demandId = $('#filter_demand').val().toLowerCase();
	var selected_eventId = $('#filter_event').val().toLowerCase();
  var selected_minprc = $('#min_price').val().toLowerCase();
	var selected_maxprc = $('#max_price').val().toLowerCase();
 	var selected_ranking = $('#filter_ranking').val().toLowerCase();
	var selected_page = $('#page').val().toLowerCase();
	var selected_pg = $('#pg').val().toLowerCase();
	var generalSearch = $('#generalSearch').val().toLowerCase();
	var url = DIR_CONT+DIR_PRO+"CON_supplierproductsgrid.php?action=getpro&supplierId="+userId;
	 if(selected_page) url+="&page="+selected_page;
	 if(selected_pg) url+="&pg="+selected_pg;
	 if(selected_sort) url+="&order_by="+selected_sort;
 	if(selected_categoryId) url+="&categoryId="+selected_categoryId;
 	if(selected_brandId) url+="&brandId="+selected_brandId;
 	if(selected_supplierId) url+="&supplierId="+selected_supplierId;
 	if(selected_demandId) url+="&demandId="+selected_demandId;
 	if(selected_eventId) url+="&eventId="+selected_eventId;
 	if(selected_minprc) url+="&min_price="+selected_minprc;
 	if(selected_maxprc) url+="&max_price="+selected_maxprc;
 	if(selected_ranking) url+="&ranking="+selected_ranking;
 	 if(selected_page) url+="&page="+selected_page;
 	 if(selected_pg) url+="&pg="+selected_pg;
 	 if ($('#featured').is(':checked')) url+="&featured=1";
 	 if ($('#bestseller').is(':checked')) url+="&bestseller=1";
	 if ($('#discount').is(':checked')) url+="&discount=1";
	 if(generalSearch) url+="&generalSearch="+generalSearch;
	$.ajax({url: url, success: function(result){
		document.getElementById("rec-gd").innerHTML = "";
		$("#rec-gd").html(result);
  }});
};
function page(pg) {
	$('#page').val(pg).trigger('change');
}
function ppg(pg) {
	$('#pg').val(pg).trigger('change');
}
var filtercategory = function(){
	var filter_category = document.getElementById('filter_category');
	var selected_categories_vals=[];
		$("input.checkbox_cat:checked").each(function(){
    	selected_categories_vals.push($(this).attr("data-id"));
		});
		var categories= selected_categories_vals.toString();
		filter_category.value=categories;
		//$('#filter_category').trigger('change');
	 $.ajax({url: DIR_CONT+DIR_BRND+"CON_brandcategory.php?action=get&categoryId="+selected_categories_vals, success: function(result){
		document.getElementById("rec-brand").innerHTML = "";
		$("#rec-brand").html(result);
  }});
}
var filterbrand = function(){
	var filter_brand = document.getElementById('filter_brand');
	var selected_brands_vals=[];
		$("input.checkbox_brnd:checked").each(function(){
    	selected_brands_vals.push($(this).attr("data-id"));
		});
		var brands= selected_brands_vals.toString();
		filter_brand.value=brands;
		//$('#filter_brand').trigger('change');
}
var filterranking = function(){
	var filter_rankings = document.getElementById('filter_ranking');
	var selected_rankings_vals=[];
		$("input.checkbox_rnk:checked").each(function(){
    	selected_rankings_vals.push($(this).attr("data-id"));
		});
		var rankings= selected_rankings_vals.toString();
		filter_rankings.value=rankings;
		//$('#filter_ranking').trigger('change');
}
var filterprice = function(fp){
	var min_price;
	var max_price;
	switch (fp) {
		case 1:
			min_price = 0;
			max_price = 25;
			break;
		case 2:
			min_price = 50;
			max_price = 150;
			break;
		case 3:
			min_price = 150;
			max_price = 350;
			break;
		case 4:
			min_price = 350;
			max_price = 700;
			break;
		case 5:
			min_price = 700;
			max_price = null;
			break;
		default:
		min_price = null;
		max_price = null;
	}
	$('#min_price').val(min_price);
	$('#max_price').val(max_price);
	$('#filter').click();
}
$('#showmore').on('click', function() {
	$('#showmore').hide();
	$('#morebrands').show();
});
$("#kt_wrapper").on('click','.checkbox_mcat', function() {
	var mcatId = $(this).data("id");
	var checkedStatus = this.checked;
	var cat = ".mcat-"+mcatId;
	$(cat).prop('checked', checkedStatus);
	filtercategory();
});
searchGrid();
