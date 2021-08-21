"use strict";
// Class definition

var KTDatatableColumnRenderingDemo = function() {
	// Private functions
	return {
		// public functions
		init: function() {
			searchlist();
		},
	};
}();
jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
$('#kt_form_status,#kt_form_type,#kt_form_login,#kt_form_role').selectpicker();
$('#page').on('change', function() {
	var pg = Math.ceil($('#page').val()/5);
	if(pg>=1){
		ppg(pg);
		searchlist();
	}
});
$('#pg').on('change', function() {
	searchlist();
});
var searchlist = function() {
var selected_active = $('#kt_form_status').val();
var selected_login = $('#kt_form_login').val();
var selected_type = $('#kt_form_type').val();
var selected_roleId = $('#kt_form_role').val();
var selected_page = $('#page').val().toLowerCase();
var selected_pg = $('#pg').val().toLowerCase();
var generalSearch = $('#generalSearch').val().toLowerCase();
var url = DIR_CONT+DIR_ADMN+'CON_users.php?action=get';
if(selected_active) url+="&kt_form_status="+selected_active;
if(selected_login) url+="&kt_form_login="+selected_login;
if(selected_type) url+="&kt_form_type="+selected_type;
if(selected_roleId) url+="&kt_form_role="+selected_roleId;
if(selected_page) url+="&page="+selected_page;
if(selected_pg) url+="&pg="+selected_pg;
if(generalSearch) url+="&generalSearch="+generalSearch;
$.ajax({url: url, success: function(result){
	document.getElementById("rec-lt").innerHTML = "";
	$("#rec-lt").html(result);
}});
};
$('#filter').on('click', function() {
searchlist();
});
function page(pg) {
	$('#page').val(pg).trigger('change');
}
function ppg(pg) {
	$('#pg').val(pg).trigger('change');
}
function resetfilter() {
	$('#filter_category').val("");
	$('#filter_brand').val("");
	$('#filter_company').val("");
	$('#filter_role').val("");
}
