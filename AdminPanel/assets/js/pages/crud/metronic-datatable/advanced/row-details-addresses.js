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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=addresses.json",
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
          field: "addressId",
          title: "Address ID",
          width: "auto",
        },
        {
          field: "ipaddress",
          title: "IP Address",
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
          title: "City Name",
          width: "auto",
        },
        {
          field: "state",
          title: "State",
          width: "auto",
        },
        {
          field: "postalcode",
          title: "Postalcode",
          width: "auto",
        },
        {
          field: "country",
          title: "Country",
          width: "auto",
        },
        {
          field: "latitude",
          title: "Latitude",
          width: "auto",
        },
        {
          field: "longitude",
          title: "Longitude",
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
							<a href="http://localhost/JomlahBazar/AdminPanel/form_address.php?addressId=' +
              row.addressId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Address.php?addressId=' +
              row.addressId +
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
