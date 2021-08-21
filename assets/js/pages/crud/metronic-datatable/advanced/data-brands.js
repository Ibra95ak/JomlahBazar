"use strict";
// Class definition

var KTDatatableColumnRenderingDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: DIR_JSON+'Read.php?jsonname=brands.json',
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
					field: 'brandId',
					title: '#',
					sortable: 'asc',
					width: 30,
					type: 'number',
					selector: false,
					textAlign: 'center',
				}, {
					field: 'brand_name',
					title: 'Brand Name',
					template: function(data) {
						var output = '';
						if (data.path) {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<img src="' + data.path + '" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.brand_name + '</span>\
								</div>\
							</div>';
						}
						else {
							var stateNo = KTUtil.getRandomInt(0, 7);
							var states = [
								'success',
								'brand',
								'danger',
								'success',
								'warning',
								'dark',
								'primary',
								'info'];
							var state = states[stateNo];

							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.brand_name.substring(0, 1) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.brand_name + '</span>\
								</div>\
							</div>';
						}

						return output;
					},
				},{
            field: 'active',
            title: 'Status',
	        autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'active', 'state': 'primary'},
										2: {'title': 'inactive', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.active].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.active].state + '">' + status[row.active].title + '</span>';
            },
        }],

		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'active');
			searchGrid();
    });

		$('#generalSearch').on('change', function() {
			searchGrid();
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};
	// Group buttons change data preview
	$("#btn-dt").click(function(){
	  $("#rec-dt").show();
	  $("#rec-gd").hide();
	});
	$("#btn-gd").click(function(){
	  $("#rec-dt").hide();
	  $("#rec-gd").show();
	});
var searchGrid = function() {
	var selected_status = $('#kt_form_status').val().toLowerCase();
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+DIR_BRND+"CON_brandsgrid.php?action=get";
	if(selected_status) url+="&active="+selected_status;
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
			searchGrid();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
