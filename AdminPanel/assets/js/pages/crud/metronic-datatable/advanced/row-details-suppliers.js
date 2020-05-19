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
              "localhost/JomlahBazar/AdminPanel/controllers/json/Read.php?jsonname=suppliers.json",
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
          field: "supplierId",
          title: "Supplier ID",
        },
        {
          field: "email",
          title: "AAA Email",
          width: 170,
        },
        {
          field: "name",
          title: "SubscriptionPlan Name",
          width: "auto",
        },
        {
          field: "type",
          title: "Discount Type",
          width: "auto",
        },
        {
          field: "registered_name",
          title: "Registered-Supplier Name",
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
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_aaa.php?aaaId=' +
              row.aaaId +
              '"><i class="la la-edit"></i> AAA</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_stores.php?storeId=' +
              row.storeId +
              '"><i class="la la-edit"></i> Stores</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_brands.php?brandId=' +
              row.brandId +
              '"><i class="la la-edit"></i> Brands</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_subscriptionplans.php?subscriptionplanId=' +
              row.subscriptionplanId +
              '"><i class="la la-leaf"></i> Subcscription-Plan</a>\
							        <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/form_registeredsuppliers.php?registeredsupplierId=' +
              row.registeredsupplierId +
              '"><i class="la la-print"></i> Registered Supplier</a>\
              <a class="dropdown-item" href="localhost/JomlahBazar/AdminPanel/por_products.php?supplierId=' +
              row.supplierId +
              '"><i class="la la-edit"></i> Products</a>\
							    </div>\
							</div>\
							<a href="localhost/JomlahBazar/AdminPanel/form_suppliers.php?supplierId=' +
              row.supplierId +
              '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="localhost/JomlahBazar/AdminPanel/controllers/delete/delete_Supplier.php?supplierId=' +
              row.supplierId +
              '"  class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
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
