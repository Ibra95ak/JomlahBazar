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
                    url: DIR_JSON+'Read.php?jsonname=orders.json',
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
            field: 'orderId',
            title: '#',
            sortable: false,
            width: 20,
            selector: {
                class: 'kt-checkbox--solid'
            },
            textAlign: 'center',
        }, {
					field: 'ordernumber',
					title: 'Order number',
				}, {
            field: 'fullname',
            title: 'Buyer',
        }, {
            field: 'total_quantity',
            title: 'Quantity',
        },{
            field: 'total_price',
            title: 'Price',
        },{
            field: 'order_date',
            title: 'Date',
        },  {
            field: 'statusId',
            title: 'Status',
	        autoHide: false,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {'title': 'Pending', 'state': 'brand'},
                    2: {'title': 'Opened', 'state': 'success'},
                    3: {'title': 'Shipped', 'state': 'warning'},
                    4: {'title': 'Canceled', 'state': 'dark'},
                    5: {'title': 'Refunded', 'state': 'danger'}
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
                  <a href="'+DIR_VIEW+DIR_ADMN+'details_orders.php?id=' + row.orderId + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                      <i class="flaticon-eye"></i>\
                  </a>\
                  <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
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

        $('#kt_modal_fetch_id').on('show.bs.modal', function(e) {
            var ids = datatable.rows('.kt-datatable__row--active').
            nodes().
            find('.kt-checkbox--single > [type="checkbox"]').
            map(function(i, chk) {
                return $(chk).val();
            });
            var c = document.createDocumentFragment();
            for (var i = 0; i < ids.length; i++) {
                var li = document.createElement('li');
                li.setAttribute('data-id', ids[i]);
                li.innerHTML = 'Selected record ID: ' + ids[i];
                c.appendChild(li);
            }
            $(e.target).find('.kt-datatable_selected_ids').append(c);
        }).on('hide.bs.modal', function(e) {
            $(e.target).find('.kt-datatable_selected_ids').empty();
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
