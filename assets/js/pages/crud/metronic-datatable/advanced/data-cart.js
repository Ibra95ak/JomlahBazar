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
						url: DIR_CONT+DIR_CAR+'CON_cartsuser.php?action=get',
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
					field: 'cartId',
					title: '#',
					sortable: 'asc',
					width: 30,
					type: 'number',
					selector: false,
					textAlign: 'center',
				},{
					field: 'name',
					title: 'Product Name',
					template: function(data) {
						var output = '';
						if (data.path) {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<img src="DIR_MED+DIR_BRND+' + data.path + '" alt="photo">\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.name + '</span>\
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
									<div class="kt-badge kt-badge--xl kt-badge--' + state + '">' + data.name.substring(0, 1) + '</div>\
								</div>\
								<div class="kt-user-card-v2__details">\
									<span class="kt-user-card-v2__name">' + data.name + '</span>\
								</div>\
							</div>';
						}

						return output;
					},
				},{
					field: 'quantity',
					title: 'QUantity',
				},{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 220,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return '\
							<a href="dashboard_user.php"><button type="button" class="btn btn-primary btn-sm" aria-haspopup="true">Request for Qoutation</button>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
					},
				}
			],

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

var searchGrid = function() {
	var selected_status = $('#kt_form_status').val().toLowerCase();
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+"CON_brandsgrid.php?action=get";
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
