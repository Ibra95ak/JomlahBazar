"use strict";
// Class definition

var KTDatatableRecordSelectionDemo = function() {
    // Private functions
console.log(DIR_JSON+'Read.php?jsonname='+DIR_CONT+DIR_ADMN+'CON_banktransfers.php?action=get');
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: DIR_JSON+'Read.php?jsonname='+DIR_CONT+DIR_ADMN+'CON_banktransfers.php?action=get',
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // layout definition
        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and
            // vertical when needed.
            footer: false // display/hide footer
        },

        // column sorting
        sortable: true,

        pagination: true,
        // columns definition
        columns: [{
            field: 'paymentId',
            title: '#',
            sortable: false,
            width: 20
        }, {
					field: 'ordernumber',
					title: 'Order Number',
				}, {
            field: 'payment_type',
            title: 'Type',
            template: function(row) {
                var status = {
                    1: {'title': 'COD'},
                    2: {'title': 'Online'},
                    3: {'title': 'Bank Transfer'},
                    4: {'title': 'B2B'}
                };
                return '<span class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill">' + status[row.payment_type].title + '</span>';
            },
        }, {
            field: 'paymentfees',
            title: 'Payment Fees',
        },{
            field: 'shipmentfees',
            title: 'Shipment Fees',
        },{
            field: 'jbfees',
            title: 'JB Fees',
        },{
            field: 'total_price',
            title: 'Total Price',
        },{
            field: 'status',
            title: 'Status',
        },{
            field: 'receipt',
            title: 'Receipt',
            template: function(data) {
						var receipt_img = '';
						if(data.receipt) receipt_img = data.receipt;
						var output = '';
						if (receipt_img!='') {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic kt-modal-thumb" data-toggle="modal" data-target="#kt_modal_thumbnail" data-id="'+DIR_ROOT+DIR_MED+'payments/'+ receipt_img +'">\
									<img src="'+DIR_ROOT+DIR_MED+'payments/'+ receipt_img + '" alt="photo">\
								</div>\
							</div>';
						}
						else {
							output = '<div class="kt-user-card-v2">\
								<div class="kt-user-card-v2__pic">\
									<div class="kt-badge kt-badge--xl kt-badge--dark">NA</div>\
								</div>\
							</div>';
						}
						return output;
					}
        },{
            field: 'payment_date',
            title: 'Date',
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
                  <a href="'+DIR_CONT+DIR_ADMN+'CON_banktransfers.php?action=approve&ordernumber=' + row.ordernumber + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                      <i class="flaticon2-check-mark"></i>\
                  </a>\
                  <a href="'+DIR_CONT+DIR_ADMN+'CON_banktransfers.php?action=decline&ordernumber=' + row.ordernumber + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
                      <i class="flaticon2-delete"></i>\
                  </a>\
              ';
          },
        }],
    };

    // basic demo
    var localSelectorDemo = function() {

        options.search = {
            input: $('#generalSearch'),
        };

        var datatable = $('#local_record_selection').KTDatatable(options);

        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val(), 'status');
        });

        $('#kt_form_status').selectpicker();
        $("#kt_wrapper").on('click','.kt-modal-thumb', function() {
           $('#receipt_thumb').prop("src", $(this).data("id"));
        });
    };
    return {
        // public functions
        init: function() {
            localSelectorDemo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableRecordSelectionDemo.init();
});
