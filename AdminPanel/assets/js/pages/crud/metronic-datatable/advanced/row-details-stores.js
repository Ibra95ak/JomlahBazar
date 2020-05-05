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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=stores.json",
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
          field: "storeId",
          title: "Store ID",
          width: "auto",
        },
        {
          field: "supplierId",
          title: "Supplier ID",
          width: "auto",
        },
        {
          field: "addressId",
          title: "Address ID",
          width: "auto",
        },
        {
          field: "reachoutId",
          title: "Reachout ID",
          width: "auto",
        },
        {
          field: "name",
          title: "Store Name",
          width: "auto",
        },
        {
          field: "description",
          title: "Store description",
          width: "auto",
        },
        {
          field: "Theme",
          title: "Theme",
          width: "auto",
        },
        {
          field: "blockId",
          title: "Block ID",
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_suppliers.php?supplierId=' +
              row.supplierId +
              '"><i class="la la-edit"></i> Supplier</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_addresss.php?addressId=' +
              row.addressId +
              '"><i class="la la-leaf"></i> Address</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_reachouts.php?reachoutId=' +
              row.reachoutId +
              '"><i class="la la-print"></i> Reachout</a>\
							    </div>\
							</div>\
							<a href="http://localhost/JomlahBazar/AdminPanel/form_stores.php?storeId=' +
              row.storeId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a <a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Store.php?storeId=' +
              row.storeId +
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
