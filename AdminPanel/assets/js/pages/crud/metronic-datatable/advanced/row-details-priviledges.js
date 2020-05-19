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
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=priviledges.json",
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
          field: "priviledgeId",
          title: "Priviledge ID",
          width: "auto",
        },
        {
          field: "name",
          title: "Priviledge Name",
          width: "auto",
        },
        {
          field: "c",
          title: "Create",
          width: "auto",
          // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Granted", state: "success" },
              2: { title: "Denied", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--inline kt-badge--'+status[row.c].state+'">'+status[row.c].title+'</span>'
            );
          },
        },
        {
          field: "r",
          title: "Read",
          width: "auto",
            // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Granted", state: "success" },
              2: { title: "Denied", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--inline kt-badge--'+status[row.r].state+'">'+status[row.r].title+'</span>'
            );
          },
        },
        {
          field: "u",
          title: "Update",
          width: "auto",
            // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Granted", state: "success" },
              2: { title: "Denied", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--inline kt-badge--'+status[row.u].state+'">'+status[row.u].title+'</span>'
            );
          },
        },
        {
          field: "d",
          title: "Delete",
          width: "auto",
          // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Granted", state: "success" },
              2: { title: "Denied", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--inline kt-badge--'+status[row.d].state+'">'+status[row.d].title+'</span>'
            );
          },
        },
        {
          field: "extra",
          title: "Extra",
          width: "auto",
            // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Granted", state: "success" },
              2: { title: "Denied", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--inline kt-badge--'+status[row.extra].state+'">'+status[row.extra].title+'</span>'
            );
          },
        },
        {
          field: "active",
          title: "Status",
          autoHide: false,
          // callback function support for column rendering
          template: function (row) {
            var status = {
              1: { title: "Active", state: "success" },
              2: { title: "Inactive", state: "danger" },
            };
            return (
              '<span class="kt-badge kt-badge--' +
              status[row.active].state +
              ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
              status[row.active].state +
              '">' +
              status[row.active].title +
              '</span>'
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
							<a href="localhost/JomlahBazar/AdminPanel/form_priviledges.php?priviledgeId=' +
              row.priviledgeId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Priviledge.php?priviledgeId=' +
              row.priviledgeId +
              '"class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						'
            );
          },
        },
      ],
    });

    $("#kt_form_status").on("change", function () {
      datatable.search($(this).val().toLowerCase(), "active");
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
