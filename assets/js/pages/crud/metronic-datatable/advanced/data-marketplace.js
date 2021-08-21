$(document).ready(function(){
  demosloc();
});
var ftbs = getUrlParameter("ftbs");
$('#filter').on('click', function() {
	var searchby = $("#search-dropdown").text();
	switch (searchby) {
		case "Products":
			searchGridpro();
			break;
		case "Suppliers":
			searchGridsup();
			break;
		default:
			searchGridpro();
	}
	demosloc();
});
$('#page').on('change', function() {
	var pg = Math.ceil($('#page').val()/5);
	if(pg>=1){
		ppg(pg);
		searchGridpro();
		KTUtil.scrollTop();
	}
});
$('#pg').on('change', function() {
	searchGridpro();
	KTUtil.scrollTop();
});
$('#order_by').on('change', function() {
	$('#filter_order').val(this.value);
	$('#filter').click();
});
var searchGridpro = function() {
	var selected_sort = $('#filter_order').val().toLowerCase();
	var selected_categoryId = $('#filter_category').val().toLowerCase();
	var selected_brandId = $('#filter_brand').val().toLowerCase();
	var selected_usercompanyId = $('#filter_supplier').val().toLowerCase();
	var selected_demandId = $('#filter_demand').val().toLowerCase();
	var selected_eventId = $('#filter_event').val().toLowerCase();
  var selected_minprc = $('#min_price').val().toLowerCase();
	var selected_maxprc = $('#max_price').val().toLowerCase();
 	var selected_ranking = $('#filter_ranking').val().toLowerCase();
	var selected_fragrancefor = $('#filter_fragrancefor').val().toLowerCase();
 	var selected_arabicscents = $('#filter_arabicscents').val().toLowerCase();
 	var selected_luxuryperfume = $('#filter_luxuryperfume').val().toLowerCase();
 	var selected_tester = $('#filter_tester').val().toLowerCase();
 	var selected_giftset = $('#filter_giftset').val().toLowerCase();
	var selected_page = $('#page').val().toLowerCase();
	var selected_pg = $('#pg').val().toLowerCase();
	var generalSearch = $('#generalSearch').val().toLowerCase();
	var url = DIR_CONT+DIR_PRO+"CON_marketplacegrid.php?action=get";
	if(selected_sort) url+="&order_by="+selected_sort;
	if(selected_categoryId) url+="&categoryId="+selected_categoryId;
	if(selected_brandId) url+="&brandId="+selected_brandId;
	if(selected_usercompanyId) url+="&usercompanyId="+selected_usercompanyId;
	if(selected_demandId) url+="&demandId="+selected_demandId;
	if(selected_eventId) url+="&eventId="+selected_eventId;
	if(selected_minprc) url+="&min_price="+selected_minprc;
	if(selected_maxprc) url+="&max_price="+selected_maxprc;
	if(selected_ranking) url+="&ranking="+selected_ranking;
	if(selected_fragrancefor) url+="&fragrancefor="+selected_fragrancefor;
	if(selected_arabicscents) url+="&arabicscents="+selected_arabicscents;
	if(selected_luxuryperfume) url+="&luxuryperfume="+selected_luxuryperfume;
	if(selected_tester) url+="&tester="+selected_tester;
	if(selected_giftset) url+="&giftset="+selected_giftset;
	 if(selected_page) url+="&page="+selected_page;
	 if(selected_pg) url+="&pg="+selected_pg;
	 if ($('#featured').is(':checked')) url+="&featured=1";
	 if ($('#bestseller').is(':checked')) url+="&bestseller=1";
	 if ($('#discount').is(':checked')) url+="&discount=1";
	 if ($('#gift').is(':checked')) url+="&gift=1";
	 if ($('#eid').is(':checked')) url+="&eid=1";
	 if(generalSearch) url+="&generalSearch="+encodeURI(generalSearch);
	$.ajax({url: url,beforeSend: function() {$("#wait").css("display", "block");}, success: function(result){
		document.getElementById("rec-gd").innerHTML = "";
		$("#rec-gd").html(result);
		$("#wait").css("display", "none");
  }});
	if (ftbs==1) {
		$("#featured").prop("checked",false);
		$("#bestseller").prop("checked",false);
	}
};
var searchGridsup = function() {
	var selected_sort = $('#filter_order').val().toLowerCase();
	var selected_roleId = $('#filter_role').val().toLowerCase();
	var selected_categoryId = $('#filter_category').val().toLowerCase();
	var selected_brandId = $('#filter_brand').val().toLowerCase();
	var selected_usercompanyId = $('#filter_supplier').val().toLowerCase();
	var selected_demandId = $('#filter_demand').val().toLowerCase();
	var selected_eventId = $('#filter_event').val().toLowerCase();
  var selected_minprc = $('#min_price').val().toLowerCase();
	var selected_maxprc = $('#max_price').val().toLowerCase();
 	var selected_ranking = $('#filter_ranking').val().toLowerCase();
	var selected_page = $('#page').val().toLowerCase();
	var selected_pg = $('#pg').val().toLowerCase();
	var generalSearch = $('#generalSearch').val().toLowerCase();
	var url = DIR_CONT+DIR_PRO+"CON_marketplacesupgrid.php?action=get";
	if(selected_sort) url+="&order_by="+selected_sort;
	if(selected_roleId) url+="&roleId="+selected_roleId;
	if(selected_categoryId) url+="&categoryId="+selected_categoryId;
	if(selected_brandId) url+="&brandId="+selected_brandId;
	if(selected_usercompanyId) url+="&usercompanyId="+selected_usercompanyId;
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
	 if ($('#gift').is(':checked')) url+="&gift=1";
	 if(generalSearch) url+="&generalSearch="+generalSearch;
	$.ajax({url: url, success: function(result){
		document.getElementById("rec-gd").innerHTML = "";
		$("#rec-gd").html(result);
  }});
};
var demosloc = function() {
	var map = new GMaps({
		div: '#kt_gmap_sloc',
		lat: 24.7563957,
		lng: 55.2597173,
	});
  var selected_sort = $('#filter_order').val().toLowerCase();
	var selected_categoryId = $('#filter_category').val().toLowerCase();
	var selected_brandId = $('#filter_brand').val().toLowerCase();
	var selected_usercompanyId = $('#filter_supplier').val().toLowerCase();
	var selected_demandId = $('#filter_demand').val().toLowerCase();
	var selected_eventId = $('#filter_event').val().toLowerCase();
  var selected_minprc = $('#min_price').val().toLowerCase();
	var selected_maxprc = $('#max_price').val().toLowerCase();
 	var selected_ranking = $('#filter_ranking').val().toLowerCase();
 	var selected_fragrancefor = $('#filter_fragrancefor').val().toLowerCase();
 	var selected_arabicscents = $('#filter_arabicscents').val().toLowerCase();
 	var selected_luxuryperfume = $('#filter_luxuryperfume').val().toLowerCase();
 	var selected_tester = $('#filter_tester').val().toLowerCase();
 	var selected_giftset = $('#filter_giftset').val().toLowerCase();
	var selected_page = $('#page').val().toLowerCase();
	var selected_pg = $('#pg').val().toLowerCase();
	var generalSearch = $('#generalSearch').val().toLowerCase();
  var url = DIR_CONT+DIR_PRO+"CON_marketplacesup.php?";
  if(selected_sort) url+="&order_by="+selected_sort;
	if(selected_categoryId) url+="&categoryId="+selected_categoryId;
	if(selected_brandId) url+="&brandId="+selected_brandId;
	if(selected_usercompanyId) url+="&usercompanyId="+selected_usercompanyId;
	if(selected_demandId) url+="&demandId="+selected_demandId;
	if(selected_eventId) url+="&eventId="+selected_eventId;
	if(selected_minprc) url+="&min_price="+selected_minprc;
	if(selected_maxprc) url+="&max_price="+selected_maxprc;
	if(selected_ranking) url+="&ranking="+selected_ranking;
	if(selected_fragrancefor) url+="&fragrancefor="+selected_fragrancefor;
	if(selected_arabicscents) url+="&arabicscents="+selected_arabicscents;
	if(selected_luxuryperfume) url+="&luxuryperfume="+selected_luxuryperfume;
	if(selected_tester) url+="&tester="+selected_tester;
	if(selected_giftset) url+="&giftset="+selected_giftset;
	 if(selected_page) url+="&page="+selected_page;
	 if(selected_pg) url+="&pg="+selected_pg;
	 if ($('#featured').is(':checked')) url+="&featured=1";
	 if ($('#bestseller').is(':checked')) url+="&bestseller=1";
	 if ($('#discount').is(':checked')) url+="&discount=1";
	 if(generalSearch) url+="&generalSearch="+generalSearch;
  $.get(url, function(data, status) {
    var users = JSON.parse(data);
    var users_map =users['products'];
    users_map.forEach((item, i) => {
      map.addMarker({
        icon: DIR_ICON+"map-marker-4.png",
        lat: item.latitude,
        lng: item.longitude,
        title: item.companyname,
        infoWindow: {
          content: '<span style="color:#000">' + item.companyname + '</span>'
        }
      });
    });
  });
	map.setZoom(7);
}
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
var filtersupplier = function(){
	var filter_supplier = document.getElementById('filter_supplier');
	var selected_supplier_vals=[];
		$("input.checkbox_sup:checked").each(function(){
    	selected_supplier_vals.push($(this).attr("data-id"));
		});
		var supplier= selected_supplier_vals.toString();
		filter_supplier.value=supplier;
		//$('#filter_supplier').trigger('change');
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
$('#showmoresuppliers').on('click', function() {
	$('#showmoresuppliers').hide();
	$('#moresuppliers').show();
});
$('#reset_search').on('click', function() {
	document.getElementById("form_filter").reset();
	$('#header_search_text').val('');
	$('#filter').click();
});
$("#kt_wrapper").on('click','.checkbox_mcat', function() {
	var mcatId = $(this).data("id");
	var checkedStatus = this.checked;
	var cat = ".mcat-"+mcatId;
	$(cat).prop('checked', checkedStatus);
	if (mcatId==2) {
		if (checkedStatus) {
			$('#filter_fragrancefor').val("1");
			$('#filter_arabicscents').val("1");
			$('#filter_luxuryperfume').val("1");
			$('#filter_tester').val("1");
			$('#filter_giftset').val("1");
		}else {
			$('#filter_fragrancefor').val("");
			$('#filter_arabicscents').val("");
			$('#filter_luxuryperfume').val("");
			$('#filter_tester').val("");
			$('#filter_giftset').val("");
		}
	}
	filtercategory();
});
function resetfilter() {
	$('#filter_category').val("");
	$('#filter_brand').val("");
	$('#filter_supplier').val("");
	$('#filter_ranking').val("");
	$('#filter_category').val("");
	$('#filter_fragrancefor').val("");
	$('#filter_arabicscents').val("");
	$('#filter_luxuryperfume').val("");
	$('#filter_tester').val("");
	$('#filter_giftset').val("");
}
function clearfilter_categories(){
	$('#filter_category').val("");
	$('#filter_fragrancefor').val("");
	$('#filter_arabicscents').val("");
	$('#filter_luxuryperfume').val("");
	$('#filter_tester').val("");
	$('#filter_giftset').val("");
	$('.checkbox_mcat').prop('checked', false);
	$('.checkbox_cat').prop('checked', false);
}
function clearfilter_brands(){
	$('#filter_brand').val("");
	$('.checkbox_brnd').prop('checked', false);
}
function clearfilter_prices(){
	$('#min_price').val("");
	$('#max_price').val("");
}
function clearfilter_discount(){
	$('#min_discount').val("");
	$('#max_discount').val("");
}
function clearfilter_reviews(){
	$('#filter_ranking').val("");
	$('.checkbox_rnk').prop('checked', false);
}
function clearfilter_suppliers(){
	$('#filter_supplier').val("");
	$('.checkbox_sup').prop('checked', false);
}
function setff(vl,WM){
  if (vl.checked) $('#filter_fragrancefor').val(WM);
  else $('#filter_fragrancefor').val("");
}
function setas(vl){
	if (vl.checked) $('#filter_arabicscents').val(1);
  else $('#filter_arabicscents').val("");
}
function setlx(vl){
	if (vl.checked) $('#filter_luxuryperfume').val(1);
  else $('#filter_luxuryperfume').val("");
}
function setts(vl){
	if (vl.checked) $('#filter_tester').val(1);
  else $('#filter_tester').val("");
}
function setgt(vl){
	if (vl.checked) $('#filter_giftset').val(1);
  else $('#filter_giftset').val("");
}
