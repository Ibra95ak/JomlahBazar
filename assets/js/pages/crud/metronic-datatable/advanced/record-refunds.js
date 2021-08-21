"use strict";
// Class definition

var KTDatatableRecordSelectionDemo = function() {
    // Private functions
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: DIR_JSON+'Read.php?jsonname='+DIR_CONT+DIR_ADMN+'CON_refunds.php?action=get',
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
            field: 'refundId',
            title: '#',
            sortable: false,
            width: 20
        }, {
					field: 'ordernumber',
					title: 'Order Number',
				}, {
            field: 'seller',
            title: 'Seller',
        }, {
            field: 'buyer',
            title: 'Buyer',
        },{
            field: 'refund_date',
            title: 'Refund Date',
        },{
            field: 'description',
            title: 'Reason',
        },{
            field: 'quantity_refunded',
            title: 'quantity_refunded',
        },{
            field: 'refund_price',
            title: 'refund_price',
        },{
            field: 'statusId',
            title: 'Status',
	        autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'Pending', 'state': 'brand'},
                    6: {'title': 'Completed', 'state': 'success'},
                    7: {'title': 'Closed', 'state': 'warning'},
                };
                return '<span class="kt-badge kt-badge--' + status[row.statusId].state + ' kt-badge--inline kt-badge--pill">' + status[row.statusId].title + '</span>';
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
                  <a href="'+DIR_CONT+DIR_ADMN+'CON_refunds.php?action=approve&refundId=' + row.refundId + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                      <i class="flaticon2-check-mark"></i>\
                  </a>\
                  <a href="'+DIR_CONT+DIR_ADMN+'CON_refunds.php?action=decline&refundId=' + row.refundId + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
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
            datatable.search($(this).val().toLowerCase(), 'statusId');
        });

        $('#kt_form_status').selectpicker();
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
