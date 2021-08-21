"use strict";
// Class definition
var src=document.getElementById("page_id").src;
var userId = src.split("userId=")[1];
var KTDatatableRecordSelectionDemo = function() {
    // Private functions
console.log(DIR_JSON+'Read.php?userId='+userId+'&jsonname='+DIR_CONT+DIR_USR+'CON_seller_profile.php?action=get-statments');
    var options = {
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: DIR_JSON+'Read.php?userId='+userId+'&jsonname='+DIR_CONT+DIR_USR+'CON_seller_profile.php?action=get-statments',
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
            field: 'statmentId',
            title: '#',
            sortable: false,
            width: 20,
            textAlign: 'center',
        }, {
					field: 'ordernumber',
					title: 'Order Number',
          autoHide: false
				}, {
            field: 'statment_date',
            title: 'Statement Date',
        },{
            field: 'paymentfees',
            title: 'Payment Fees',
        },{
            field: 'total_price',
            title: 'Total Price',
        },{
            field: 'netvalue',
            title: 'Net Value',
            autoHide: false
        }],
    };

    // basic demo
    var localSelectorDemo = function() {

        options.search = {
            input: $('#generalSearch'),
        };

        var datatable = $('#local_record_selection').KTDatatable(options);

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
