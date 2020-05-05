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
        },
        {
          field: "r",
          title: "Read",
          width: "auto",
        },
        {
          field: "u",
          title: "Update",
          width: "auto",
        },
        {
          field: "d",
          title: "Delete",
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/por_priviledges.php?adminpriviledgeId=' +
              row.priviledgeId +
              '"><i class="la la-edit"></i> Priviledge</a>\
							    </div>\
							</div>\
							<a href="http://localhost/JomlahBazar/AdminPanel/form_adminpriviledges.php?adminpriviledgeId=' +
              row.adminpriviledgeId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Adminpriviledge.php?adminpriviledgeId=' +
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
