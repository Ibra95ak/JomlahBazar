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
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=testimonials.json",
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
          field: "testimonialId",
          title: "Testimonial ID",
          width: "auto",
        },
        {
          field: "picname",
          title: "Picture Name",
          width: "auto",
        },
        {
          field: "path",
          title: "Picture",
          width: "auto",
          template: function (row) {
            return (
             '<div class="kt-widget3__user-img">\
            <img class="kt-widget3__img" src="' +
              row.path +
              '" alt="" style="height: 100px;width: 100px;">\
          </div>'
            );
          },
        },
        {
          field: "name",
          title: "Name",
          width: "auto",
        },
        {
          field: "description",
          title: "Description",
          width: "auto",
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
							<a href="localhost/JomlahBazar/AdminPanel/form_testimonials.php?testimonialId=' +
              row.testimonialId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Testimonial.php?testimonialId=' +
              row.testimonialId +
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
