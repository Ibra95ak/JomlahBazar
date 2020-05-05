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
              "http://localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=reviews.json",
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
          field: "reviewId",
          title: "Review ID",
          width: "auto",
        },
        {
          field: "proname",
          title: "Product Name",
          width: "auto",
        },
        {
          field: "first_name",
          title: "User Name",
          width: "auto",
        },
        {
          field: "stars",
          title: "Stars",
          width: "auto",
        },
        {
          field: "title",
          title: "Review Title",
          width: "auto",
        },
        {
          field: "description",
          title: "Review description",
          width: "auto",
        },
        {
          field: "posted_date",
          title: "Date Posted",
          width: "auto",
        },
        {
          field: "picname",
          title: "Picture name",
          width: "auto",
        },
        {
          field: "path",
          title: "Picture Path",
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
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_products.php?productId=' +
              row.productId +
              '"><i class="la la-edit"></i> Product</a>\
							        <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_buyers.php?userId=' +
              row.userId +
              '"><i class="la la-leaf"></i> Users</a>\
              <a class="dropdown-item" href="http://localhost/JomlahBazar/AdminPanel/form_buyers.php?buyerId=' +
              row.userId +
              '"><i class="la la-leaf"></i> AAA</a>\
							    </div>\
							</div>\
							<a href="http://localhost/JomlahBazar/AdminPanel/form_reviews.php?reviewId=' +
              row.reviewId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a <a <a href="http://localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Review.php?reviewId=' +
              row.reviewId +
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
