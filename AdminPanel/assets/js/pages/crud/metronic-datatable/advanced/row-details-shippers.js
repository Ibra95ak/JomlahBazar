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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=shippers.json",
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
          field: "shipperId",
          title: "Shipper ID",
          width: "auto",
        },
        {
          field: "name",
          title: "Shipper Name",
          width: "auto",
        },
        {
          field: "email",
          title: "AAA Email",
          width: 170,
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
          field: "skype",
          title: "Skype",
          width: "auto",
        },
        {
          field: "messenger",
          title: "Messenger",
          width: "auto",
        },
        {
          field: "sms",
          title: "Sms",
          width: "auto",
        },
        {
          field: "active",
          title: "Status",
          autoHide: false,
          // callback function support for column rendering
          template: function (row) {
            var status = {
              0: { title: "Inactive", state: "danger" },
              1: { title: "Active", state: "success" },
            };
            return (
              '<span class="kt-badge kt-badge--' +
              status[row.active].state +
              ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
              status[row.active].state +
              '">' +
              status[row.active].title +
              "</span>"
            );
          },
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_aaa.php?aaaId=' +
              row.aaaId +
              '"><i class="la la-edit"></i> AAA</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_address.php?addressId=' +
              row.addressId +
              '"><i class="la la-leaf"></i> Address</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_reachouts.php?reachoutId=' +
              row.reachoutId +
              '"><i class="la la-print"></i> Reachout</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_shipperdetails.php?shipperdetailId=' +
              row.shipperdetailId +
              '"><i class="la la-leaf"></i> ShipperDetail</a>\
							    </div>\
							</div>\
							<a href="http://localhost/JomlahBazar/AdminPanel/form_shippers.php?shipperId=' +
              row.shipperId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Shipper.php?shipperId=' +
              row.shipperId +
              '"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
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
