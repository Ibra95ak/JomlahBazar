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
						url: DIR_JSON+'Read.php?jsonname=products.json',
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
					sortable: 'asc',
					width: 30,
					type: 'number',
					selector: {
							class: 'kt-checkbox--solid'
					},
					textAlign: 'center',
				}, {
					field: 'product_name',
					title: 'Name',
				},
				 {
					field: 'brand_name',
					title: 'Brand',
				},{
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
 					field: 'min_price',
 					title: 'Min price',
 				},{
					field: 'moq',
					title: 'MOQ',
				},{
					field: 'total_quantity',
					title: 'Quantity',
				},{
            field: 'ranking',
            title: 'Rating',
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
                return '<span class="kt-badge kt-badge--' + status[row.ranking].state + ' kt-badge--inline kt-badge--pill">' + status[row.ranking].title + '</span>';
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
                return '<span class="kt-badge kt-badge--' + status[row.active].state + ' kt-badge--inline kt-badge--pill">' + status[row.active].title + '</span>';
            },
        },
				{
            field: 'bestseller',
            title: 'Bestseller',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'YES', 'state': 'primary'},
										2: {'title': 'NO', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.bestseller].state + ' kt-badge--inline kt-badge--pill">' + status[row.bestseller].title + '</span>';
            },
        },
				{
            field: 'featured',
            title: 'Featured',
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'YES', 'state': 'primary'},
										2: {'title': 'NO', 'state': 'danger'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.featured].state + ' kt-badge--inline kt-badge--pill">' + status[row.featured].title + '</span>';
            },
        },{
            field: 'Actions',
            title: 'Actions',
            sortable: false,
            width: 110,
            overflow: 'visible',
            textAlign: 'left',
	        autoHide: false,
					template: function(row) {
						return '\
									<a href="'+DIR_VIEW+DIR_ADMN+'details_products.php?productId=' + row.productId + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
											<i class="flaticon-eye"></i>\
									</a>\
									<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
											<i class="flaticon2-delete"></i>\
									</a>\
							';
					},
        }],
		});


    $('#kt_form_cats').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'categoryId');
    });
    $('#kt_form_brnds').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'brandId');
    });
    $('#kt_form_rnk').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'ranking');
    });
    $('#kt_form_brands').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'bestseller');
    });
    $('#kt_form_ft').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'featured');
    });
    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'active');
    });
    $('#kt_form_status,#kt_form_type,#kt_form_cats,#kt_form_brnds,#kt_form_rnk,#kt_form_brands,#kt_form_ft').selectpicker();

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
	};
	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
