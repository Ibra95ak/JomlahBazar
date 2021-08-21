"use strict";
// Class definition
var src=document.getElementById("page_id").src;
var userId = src.split("userId=")[1];
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
						url: DIR_JSON+'Read.php?jsonname='+DIR_CONT+DIR_PRO+'CON_products.php?action=get',
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
					field: 'productId',
					title: '#',
					width: 30,
					type: 'number',
					selector: {
							class: 'kt-checkbox--solid'
					},
					textAlign: 'center',
				}, {
					field: 'product_name',
					title: 'Name',
					autoHide: false
				},
				 {
					field: 'brand_name',
					title: 'Brand',
				},
				{
					field: 'category_name',
					title: 'Category',
				},
				{
					field: 'description',
					title: 'Description',
					// callback function support for column rendering
					template: function(row) {
						var description=row.description;
						return description.substring(0, 50)+"...";
					},
				 },{
            field: 'ranking',
            title: 'Rank',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    0: {'title': '0 Star', 'state': 'danger'},
                    1: {'title': '1 Star', 'state': 'danger'},
										2: {'title': '2 Star', 'state': 'secondary'},
										3: {'title': '3 Star', 'state': 'primary'},
										4: {'title': '4 Star', 'state': 'warning'},
										5: {'title': '5 Star', 'state': 'success'},
                };
								var rank = Math.floor(row.ranking);
                return '<span class="kt-badge kt-badge--' + status[rank].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[rank].state + '">' + status[rank].title + '</span>';
            },
        },{
            field: 'active',
            title: 'Status',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'active', 'state': 'primary'},
										2: {'title': 'inactive', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.active].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.active].state + '">' + status[row.active].title + '</span>';
            },
        },
				{
            field: 'bestseller',
            title: 'Bestseller',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'active', 'state': 'primary'},
										2: {'title': 'inactive', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.bestseller].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.bestseller].state + '">' + status[row.bestseller].title + '</span>';
            },
        },
				{
            field: 'featured',
            title: 'Featured',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'active', 'state': 'primary'},
										2: {'title': 'inactive', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.featured].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.featured].state + '">' + status[row.featured].title + '</span>';
            },
        },{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return '\
							<button type="button" class="btn btn-bold btn-label-warning btn-sm modal-pro" data-toggle="modal" data-target="#kt_modal_4" data-id="'+row.productId+'">Sell product</button>\
						';
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

		datatable.on(
				'kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated',
				function(e) {
						var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes();
						var count = checkedNodes.length;
						$('#kt_datatable_selected_number').html(count);
						if (count > 0) {
								$('#kt_datatable_group_action_form').collapse('show');
						} else {
								$('#kt_datatable_group_action_form').collapse('hide');
						}
				});

		$('#kt_modal_fetch_id').on('click', function(e) {
				var ids = datatable.rows('.kt-datatable__row--active').
				nodes().
				find('.kt-checkbox--single > [type="checkbox"]').
				map(function(i, chk) {
						return $(chk).val();
				});
				var pid= '';
				var c = document.createDocumentFragment();
				for (var i = 0; i < ids.length; i++) {
						if(i==0) pid +=ids[i];
						else pid += ',' + ids[i];
				}
				$.ajax({
        type:"POST",
        url:DIR_CONT+DIR_PRO+"CON_productsuppliers.php?action=post-list&userId="+userId,
        data:{ 'ids' : pid},    // multiple data sent using ajax
        success: function (data) {
					var data = JSON.parse(data);
					switch (data['err']) {
							case '0':
									// similate 2s delay
									setTimeout(function() {
											//Simulate an HTTP redirect:
											window.location.replace(
													DIR_VIEW+DIR_PRO+"dt_myproducts.php"
											);
									}, 2000);
									break;
							case '1':
									// similate 2s delay
									setTimeout(function() {
											showErrorMsg(form, 'danger',
													'Incorrect Product data. Please try again.');
									}, 2000);
									break;
							default:
							// similate 2s delay
							setTimeout(function() {
									//Simulate an HTTP redirect:
									window.location.replace(
											DIR_VIEW+DIR_PRO+"dt_myproducts.php"
									);
							}, 2000);
					}
        }
      });
		});
		$("#kt_wrapper").on('click','.modal-pro', function() {
			$("#productId").val($(this).data("id"));
		});
	};
var searchGrid = function() {
	var selected_status = $('#kt_form_status').val().toLowerCase();
	var generalSearch = $('#generalSearch').val();
	var url = DIR_CONT+DIR_PRO+"CON_productsgrid.php?action=get";
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
var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

	for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
	}
};
