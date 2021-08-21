"use strict";
// Class definition

var KTDatatableColumnRenderingDemo = function() {
	// Private functions
	return {
		// public functions
		init: function() {
			inimap();
			searchGrid();
			searchlist();
		},
	};
}();
jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});

$("#kt_wrapper").on('click','.verify-link', function() {
	var userId = $(this).data("id");
	$(this).toggleClass("btn-label-info");
	$(this).toggleClass("btn-label-success");
	$.ajax({
			type: "GET",
			url: DIR_CONT+DIR_USR+"CON_users.php?action=verify&verifieduserId="+userId,
			dataType: "json",
			success: function(data) {
				// console.log(data['verified']);
			}
	});
});
$('#page').on('change', function() {
	var pg = Math.ceil($('#page').val()/5);
	if(pg>=1){
		ppg(pg);
		searchlist();
		searchGrid();
	}
});
$('#pg').on('change', function() {
	searchlist();
	searchGrid();
});

var searchGrid = function() {
var selected_sort = $('#order_by').val().toLowerCase();
var selected_categoryId = $('#filter_category').val().toLowerCase();
var selected_brandId = $('#filter_brand').val().toLowerCase();
var selected_roleId = $('#filter_role').val().toLowerCase();
var selected_page = $('#page').val().toLowerCase();
var selected_pg = $('#pg').val().toLowerCase();
var generalSearch = $('#generalSearch').val().toLowerCase();
var url = DIR_CONT+DIR_USR+"CON_usersgrid.php?action=get";
if(selected_sort) url+="&order_by="+selected_sort;
if(selected_categoryId) url+="&categoryId="+selected_categoryId;
if(selected_brandId) url+="&brandId="+selected_brandId;
if(selected_roleId) url+="&roleId="+selected_roleId;
if(selected_page) url+="&page="+selected_page;
if(selected_pg) url+="&pg="+selected_pg;
if(generalSearch) url+="&generalSearch="+generalSearch;
$.ajax({url: url, success: function(result){
	document.getElementById("rec-gd").innerHTML = "";
	$("#rec-gd").html(result);
}});
};
var searchlist = function() {
var selected_sort = $('#order_by').val().toLowerCase();
var selected_categoryId = $('#filter_category').val().toLowerCase();
var selected_brandId = $('#filter_brand').val().toLowerCase();
var selected_roleId = $('#filter_role').val().toLowerCase();
var selected_page = $('#page').val().toLowerCase();
var selected_pg = $('#pg').val().toLowerCase();
var generalSearch = $('#generalSearch').val().toLowerCase();
var url = DIR_CONT+DIR_USR+"CON_userslist.php?action=get";
if(selected_sort) url+="&order_by="+selected_sort;
if(selected_categoryId) url+="&categoryId="+selected_categoryId;
if(selected_brandId) url+="&brandId="+selected_brandId;
if(selected_roleId) url+="&roleId="+selected_roleId;
if(selected_page) url+="&page="+selected_page;
if(selected_pg) url+="&pg="+selected_pg;
if(generalSearch) url+="&generalSearch="+generalSearch;
$.ajax({url: url, success: function(result){
	document.getElementById("rec-lt").innerHTML = "";
	$("#rec-lt").html(result);
}});
};
var inimap = function() {
	var map = new GMaps({
		div: '#kt_gmap_3',
		lat: 0,
		lng: 0,
	});
	var selected_brand = $('#filter_brand').val().toLowerCase();
	var selected_cat = $('#filter_category').val().toLowerCase();
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+DIR_USR+"CON_users.php?action=get";
	if(selected_brand) url+="&query[brandId]="+selected_brand;
	if(selected_cat) url+="&query[categoryId]="+selected_cat;
	if(generalSearch) url+="&query[generalSearch]="+generalSearch;
	$.get(url, function(data, status) {
		var users = JSON.parse(data);
		users.forEach((item, i) => {
			map.addMarker({
				lat: item.latitude,
				lng: item.longitude,
				title: item.companyname,
				icon: DIR_ROOT+DIR_ICON+"marker-orange.png",
				infoWindow: {
					content: '<span style="color:#000">' + item.companyname + '</span>'
				}
			});
		});
	});
	map.setZoom(2);
}
var myloc = function() {
	var map = new GMaps({
		div: '#kt_gmap_3',
		lat: 0,
		lng: 0,
	});
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			map.setCenter(pos);
			map.setZoom(13);
			map.addMarker({
				position: pos,
				map: map,
				draggable:true,
				icon: DIR_ROOT+DIR_ICON+"marker.png"
		});
		});
	}
	var selected_brand = $('#filter_brand').val().toLowerCase();
	var selected_cat = $('#filter_category').val().toLowerCase();
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+DIR_USR+"CON_users.php?action=get";
	if(selected_brand) url+="&query[brandId]="+selected_brand;
	if(selected_cat) url+="&query[categoryId]="+selected_cat;
	if(generalSearch) url+="&query[generalSearch]="+generalSearch;
	$.get(url, function(data, status) {
		var users = JSON.parse(data);
		users.forEach((item, i) => {
			map.addMarker({
				lat: item.latitude,
				lng: item.longitude,
				title: item.fullname,
				icon: DIR_ROOT+DIR_ICON+"marker-orange.png",
				infoWindow: {
					content: '<span style="color:#000">' + item.fullname + '</span>'
				}
			});
		});
	});
}
$('#filter').on('click', function() {
searchGrid();
searchlist();
inimap();
});
// Group buttons change data preview
$("#btn-dt").click(function(){
$("#rec-lt").show();
$("#rec-gd").hide();
$("#map_type").hide();
$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-gd").click(function(){
$("#rec-lt").hide();
$("#rec-gd").show();
$("#map_type").hide();
$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-map").click(function(){
$("#rec-lt").hide();
$("#rec-gd").hide();
$("#map_type").show();
$("#kt_gmap_3").attr("style", "height: 500px; position: relative; overflow: hidden;");
inimap();
});
$("#kt_wrapper").on('click','.contacts-link', function() {
var userId = $(this).data("id");
var div_name = "#contacts"+userId;
$(div_name).toggle();
});
$("#kt_wrapper").on('click','.contacts-link-grid', function() {
var userId = $(this).data("id");
var div_name = "#contactsgrid"+userId;
$(div_name).toggle();
});
$('#showmorebrands').on('click', function() {
$('#showmorebrands').hide();
$('#morebrands').show();
});
$('#showmorecompanies').on('click', function() {
$('#showmorecompanies').hide();
$('#morecompanies').show();
});
$('#myloc').on('click', function() {
myloc();
});
$('#worldloc').on('click', function() {
inimap();
});
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
var filtercompany = function(){
var filter_company = document.getElementById('filter_company');
var selected_companies_vals=[];
	$("input.checkbox_cmp:checked").each(function(){
		selected_companies_vals.push($(this).attr("data-id"));
	});
	var companies= selected_companies_vals.toString();
	filter_company.value=companies;
	//$('#filter_brand').trigger('change');
}
var filterrole = function(){
var filter_role = document.getElementById('filter_role');
var selected_roles_vals=[];
	$("input.checkbox_rl:checked").each(function(){
		selected_roles_vals.push($(this).attr("data-id"));
	});
	var roles= selected_roles_vals.toString();
	filter_role.value=roles;
	//$('#filter_brand').trigger('change');
}
$("#kt_wrapper").on('click','.checkbox_mcat', function() {
var mcatId = $(this).data("id");
var checkedStatus = this.checked;
var cat = ".mcat-"+mcatId;
$(cat).prop('checked', checkedStatus);
filtercategory();
});
function resetfilter() {
	$('#filter_category').val("");
	$('#filter_brand').val("");
	$('#filter_company').val("");
	$('#filter_role').val("");
}
