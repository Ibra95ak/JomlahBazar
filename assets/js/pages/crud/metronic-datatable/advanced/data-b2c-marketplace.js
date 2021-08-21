$('#filter').on('click', function() {
	searchGrid();
});
$('#page').on('change', function() {
	searchGrid();
});
$('#pg').on('change', function() {
	searchGrid();
});
$('#generalSearch').on('change', function() {
	searchGrid();
});
var searchGrid = function() {
	var selected_sort = $('#order_by').val().toLowerCase();
 	var selected_categoryId = $('#filter_category').val().toLowerCase();
	var selected_brandId = $('#filter_brand').val().toLowerCase();
  var selected_minprc = $('#min_price').val().toLowerCase();
	var selected_maxprc = $('#max_price').val().toLowerCase();
  var selected_mindis = $('#min_discount').val().toLowerCase();
	var selected_maxdis = $('#max_discount').val().toLowerCase();
 	var selected_ranking = $('#filter_ranking').val().toLowerCase();
	var selected_page = $('#page').val().toLowerCase();
	var selected_pg = $('#pg').val().toLowerCase();
	//var generalSearch = $('#generalSearch').val().toLowerCase();
	var url = DIR_CONT+DIR_PRO+"CON_b2c_marketplacegrid.php?action=get";
	if(selected_sort) url+="&order_by="+selected_sort;
	if(selected_categoryId) url+="&categoryId="+selected_categoryId;
	if(selected_brandId) url+="&brandId="+selected_brandId;
	if(selected_minprc) url+="&min_price="+selected_minprc;
	if(selected_maxprc) url+="&max_price="+selected_maxprc;
	if(selected_mindis) url+="&min_discount="+selected_mindis;
	if(selected_maxdis) url+="&max_discount="+selected_maxdis;
	if(selected_ranking) url+="&ranking="+selected_ranking;
	if(selected_page) url+="&page="+selected_page;
	if(selected_pg) url+="&pg="+selected_pg;
	if ($('#featured').is(':checked')) url+="&featured=1";
	if ($('#bestseller').is(':checked')) url+="&bestseller=1";
	//  if(generalSearch) url+="&generalSearch="+generalSearch;
	console.log(url);
	$.ajax({url: url, success: function(result){
		console.log(url);
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
		console.log(categories);
	// 	$('#filter_category').trigger('change');
	//  $.ajax({url: DIR_CONT+DIR_BRND+"CON_brandcategory.php?action=get&categoryId="+selected_categories_vals, success: function(result){
	// 	document.getElementById("rec-brand").innerHTML = "";
	// 	$("#rec-brand").html(result);
  // }});
}
var filterbrand = function(){
	var filter_brand = document.getElementById('filter_brand');
	var selected_brands_vals=[];
		$("input.checkbox_brnd:checked").each(function(){
    	selected_brands_vals.push($(this).attr("data-id"));
		});
		var brands= selected_brands_vals.toString();
		filter_brand.value=brands;
		$('#filter_brand').trigger('change');
}
var filterranking = function(){
	var filter_rankings = document.getElementById('filter_ranking');
	var selected_rankings_vals=[];
		$("input.checkbox_rnk:checked").each(function(){
    	selected_rankings_vals.push($(this).attr("data-id"));
		});
		var rankings= selected_rankings_vals.toString();
		filter_rankings.value=rankings;
		$('#filter_ranking').trigger('change');
}
$('#showmore').on('click', function() {
	$('#showmore').hide();
	$('#morebrands').show();
});
searchGrid();
