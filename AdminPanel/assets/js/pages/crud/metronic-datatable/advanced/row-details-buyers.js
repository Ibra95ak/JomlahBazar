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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=buyers.json",
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
          field: "userId",
          title: "User ID",
          width: "auto",
        },
        {
          field: "first_name",
          title: "FIRST_NAME",
          width: "auto",
        },
        {
          field: "email",
          title: "Email",
          width: "auto",
        },
        {
          field: "address1",
          title: "Address 1",
          width: "auto",
        },
        {
          field: "address2",
          title: "Address 2",
          width: "auto",
        },
        {
          field: "city",
          title: "City",
          width: "auto",
        },
        {
          field: "state",
          title: "State",
          width: "auto",
        },
        {
          field: "country",
          title: "Country",
          width: "auto",
        },
        {
          field: "phone",
          title: "Phone",
          width: "auto",
        },
        {
          field: "whatsapp",
          title: "Whatsapp",
          width: "auto",
        },
        {
          field: "telegram",
          title: "Telegram",
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
          title: "sms",
          width: "auto",
        },
        {
          field: "identityId",
          title: "Identity ID",
          width: "auto",
        },
        {
          field: "blockId",
          title: "Block ID",
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_buyers.php?buyerId=' +
              row.userId +
              '""><i class="la la-edit"></i> AAA</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_address.php?buyerId=' +
              row.userId +
              '""><i class="la la-leaf"></i> Address</a>\
                      <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_reachouts.php?buyerId=' +
              row.userId +
              '""><i class="la la-print"></i> Reachout</a>\
                      <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_wallets.php?buyerId=' +
              row.userId +
              '""><i class="la la-edit"></i> Wallet</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_address.php?userId=' +
              row.userId +
              '""><i class="la la-leaf"></i> Identity</a>\
							</div>\
              <a href="http://localhost/JomlahBazar/AdminPanel/form_buyers.php?userId=' +
              row.userId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Buyer.php?userId=' +
              row.userId +
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
