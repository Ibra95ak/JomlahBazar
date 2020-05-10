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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=reachouts.json",
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
          field: "reachoutId",
          title: "Reachout ID",
          width: "auto",
        },
        {
          field: "first_name",
          title: "User Name",
          width: "auto",
        },
        {
          field: "phone",
          title: "Phone Number",
          width: "auto",
        },
        {
          field: "whatsapp",
          title: "Whatsapp Number",
          width: "auto",
        },
        {
          field: "telegram",
          title: "Telegram Number",
          width: "auto",
        },
        {
          field: "messenger",
          title: "Messenger",
          width: "auto",
        },
        {
          field: "skype",
          title: "Skype",
          width: "auto",
        },
        {
          field: "sms",
          title: "Sms Number",
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
							<a href="http://localhost/JomlahBazar/AdminPanel/form_reachouts.php?reachoutId=' +
              row.reachoutId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Reachout.php?reachoutId=' +
              row.reachoutId +
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
