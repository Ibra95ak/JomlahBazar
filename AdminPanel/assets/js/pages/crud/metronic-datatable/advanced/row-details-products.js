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
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=products.json",
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
          field: "productId",
          title: "Product ID",
          width: "auto",
        },
        {
          field: "productdetailId",
          title: "ProductDetail ID",
          width: "auto",
        },
        {
          field: "inventoryId",
          title: "Inventory ID",
          width: "auto",
        },
        {
          field: "name",
          title: "Product Name",
          width: "auto",
        },
        {
          field: "quantity",
          title: "Product quantity",
          width: "auto",
        },
        {
          field: "min_order",
          title: "Minimum Order",
          width: "auto",
        },
        {
          field: "unitprice",
          title: "Unit Price",
          width: "auto",
        },
        {
          field: "discount",
          title: "Discount",
          width: "auto",
        },
        {
          field: "description",
          title: "Description",
          width: "auto",
        },
        {
          field: "size",
          title: "Size",
          width: "auto",
        },
        {
          field: "color",
          title: "Color",
          width: "auto",
        },
        {
          field: "weight",
          title: "Weight",
          width: "auto",
        },
        {
          field: "barcode",
          title: "Barcode",
          width: "auto",
        },
        {
          field: "inventorynumber",
          title: "Inventory Number",
          width: "auto",
        },
        {
          field: "brand_name",
          title: "Brand Name",
          width: "auto",
        },
        {
          field: "ranking",
          title: "Ranking",
          width: "auto",
        },
        {
          field: "brandId",
          title: "Brand ID",
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
							<div class="dropdown">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
	                                <i class="la la-ellipsis-h"></i>\
	                            </a>\
							    <div class="dropdown-menu dropdown-menu-right">\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_inventories.php?inventoryId=' +
              row.inventoryId +
              '"><i class="la la-edit"></i> Inventory</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_brands.php?brandId=' +
              row.brandId +
              '"><i class="la la-leaf"></i> Brand</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_productdetails.php?productdetailId=' +
              row.productdetailId +
              '"><i class="la la-print"></i> ProductDetail</a>\
							    </div>\
							</div>\
							<a href="localhost/JomlahBazar/AdminPanel/form_products.php?productId=' +
              row.productId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Product.php?productId=' +
              row.productId +
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
