"use strict";
// Class definition

var KTDatatableAutoColumnHideDemo = (function () {
  // Private functions

  // basic demo
  var demo = function () {
    var datatable = $(".kt-datatable").KTDatatable({
      // datasource definition
      data: {
        type: "remote",
        source: {
          read: {
            url:
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=registeredsuppliers.json",
          },
        },
        pageSize: 10,
        saveState: false,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
      },

      layout: {
        scroll: true,
        height: 550,
      },

      // column sorting
      sortable: true,

      pagination: true,

      search: {
        input: $("#generalSearch"),
      },

      // columns definition
      columns: [
        {
          field: "registeredsupplierId",
          title: "Registered-Supplier ID",
          width: "auto",
        },
        {
          field: "registered_name",
          title: "Registered Name",
          width: "auto",
        },
        {
          field: "creditcardId",
          title: "CreditCard ID",
          width: "auto",
        },
        {
          field: "Actions",
          title: "Actions",
          sortable: false,
          width: 110,
          overflow: "visible",
          autoHide: false,
          template: function (row) {
            return (
              '\
							<div class="dropdown">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
	                                <i class="la la-ellipsis-h"></i>\
	                            </a>\
							    <div class="dropdown-menu dropdown-menu-right">\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_creditcards.php?creditcardId=' +
              row.creditcardId +
              '"><i class="la la-leaf"></i> Credit Card</a>\
							    </div>\
							</div>\
							<a href="localhost/JomlahBazar/AdminPanel/form_registeredsuppliers.php?registeredsupplierId=' +
              row.registeredsupplierId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a <a <a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Registeredsupplier.php?registeredsupplierId=' +
              row.registeredsupplierId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						'
            );
          },
        },
      ],
    });

    $("#kt_form_status,#kt_form_type").selectpicker();
  };

  return {
    // public functions
    init: function () {
      demo();
    },
  };
})();

jQuery(document).ready(function () {
  KTDatatableAutoColumnHideDemo.init();
});
