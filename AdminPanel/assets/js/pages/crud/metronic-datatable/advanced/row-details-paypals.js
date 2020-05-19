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
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=paypals.json",
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
          field: "paypalId",
          title: "Paypal ID",
          width: "auto",
        },
        {
          field: "walletId",
          title: "Wallet ID",
          width: "auto",
        },
        {
          field: "email",
          title: "Email",
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
							<a href="localhost/JomlahBazar/AdminPanel/form_paypals.php?paypalId=' +
              row.paypalId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
							<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Paypal.php?paypalId=' +
              row.paypalId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						'
            );
          },
        },
      ],
    });

    $("#kt_form_status").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "Status");
    });

    $("#kt_form_type").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "Type");
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
