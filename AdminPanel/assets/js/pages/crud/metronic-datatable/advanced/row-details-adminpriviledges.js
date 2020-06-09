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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=adminpriviledges.json",
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
          field: "adminpriviledgeId",
          title: "AdminPriviledge ID",
          width: "auto",
        },
        {
          field: "username",
          title: "Username",
          width: "auto",
        },
        {
          field: "name",
          title: "Name",
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/por_priviledges.php?adminpriviledgeId=' +
              row.adminpriviledgeId +
              '"><i class="la la-edit"></i> Priviledge</a>\
							    </div>\
							</div>\
							<a href="http://localhost/JomlahBazar/AdminPanel/form_adminpriviledges.php?adminpriviledgeId=' +
              row.adminpriviledgeId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Adminpriviledge.php?adminpriviledgeId=' +
              row.adminpriviledgeId +
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
