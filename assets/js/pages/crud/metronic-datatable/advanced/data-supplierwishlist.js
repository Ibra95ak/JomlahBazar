"use strict";
// Class definition
var src=document.getElementById("page_id").src;
var userId = src.split("userId=")[1];
var KTDatatableColumnRenderingDemo = function() {
	// Private functions
console.log(DIR_CONT+DIR_CAR+'CON_wishlist.php?action=get-wishlist');
	// basic demo
	var demo = function() {
		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: DIR_JSON+'Read.php?userId='+userId+'&jsonname='+DIR_CONT+DIR_CAR+'CON_wishlist.php?action=get-wishlist',
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
				delay: 400,
			},

			// columns definition
			columns: [
				{
					field: 'id',
					title: '#',
					sortable: 'asc',
					width: 30,
					type: 'number',
					selector: false,
					textAlign: 'center',
				}, {
					field: 'product_id',
					title: 'Product',
					template: function(data) {
						var product_img = '';
						var product_name = '';
						if(data.name) product_name = data.name;
						if(data.path) product_img = data.path;

						var output = '';
						if (product_img!='') {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<img src="' + product_img + '" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + product_name + '</span>\
								</div>\
							</div>';
						}
						else {
							var stateNo = KTUtil.getRandomInt(0, 7);

							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--dark">' + product_name.substring(0, 1) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + product_name + '</span>\
								</div>\
							</div>';
						}

						return output;
					},
				}, {
					field: 'fullname',
					title: 'Buyer',
				},{
					field: 'selling_price',
					title: 'Price',
				}],

		});

		$('#generalSearch').on('change', function() {
			searchGrid();
			wishmap();
    });
	};
var searchGrid = function() {
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+DIR_CAR+"CON_supplierwishlistgrip.php?action=get-wishlist&userId="+userId;
	if(generalSearch) url+="&generalSearch="+generalSearch;
	$.ajax({url: url, success: function(result){
		document.getElementById("rec-gd").innerHTML = "";
		$("#rec-gd").html(result);
  }});
};
	return {
		// public functions
		init: function() {
			demo();
			wishmap();
			searchGrid();
		},
	};
}();
var wishmap = function() {
	var map = new GMaps({
		div: '#kt_gmap_3',
		lat: 24.7563957,
		lng: 55.2597173,
	});
	var url = DIR_CONT+DIR_CAR+"CON_wishlist.php?action=get-loc&userId="+userId;
	console.log(url);
	$.get(url, function(data, status) {
		var users = JSON.parse(data);
		users.forEach((item, i) => {
			map.addMarker({
				lat: item['latitude'],
				lng: item['longitude'],
				title: item['fullname'],
				infoWindow: {
					content: '<span style="color:#000">' + item["fullname"] + '</span>'
				}
			});
		});
	});
	map.setZoom(7);
}
// Group buttons change data preview
$("#btn-dt").click(function(){
  $("#rec-dt").show();
  $("#rec-gd").hide();
  $("#rec-map").hide();
	$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-gd").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").show();
  $("#rec-map").hide();
	$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-map-wish").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").hide();
  $("#rec-map").show();
  $("#kt_gmap_3").attr("style", "height: 500px; position: relative; overflow: hidden;");
	wishmap();
});
jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
