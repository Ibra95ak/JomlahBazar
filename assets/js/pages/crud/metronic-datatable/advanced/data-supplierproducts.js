"use strict";
// Class definition
var src=document.getElementById("page_id").src;
var userId = src.split("userId=")[1];
var KTDatatableColumnRenderingDemo = function() {
	// Private functions
	// basic demo
	var demo = function() {
		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: DIR_JSON+'Read.php?jsonname='+DIR_CONT+DIR_PRO+'CON_productsuppliers.php?action=getpro&userId='+userId,
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
				delay: 400,
			},

			// columns definition
			columns: [
				{
					field: 'productId',
					title: '#',
					sortable: 'asc',
					type: 'number',
					width: 20
				}, {
					field: 'name',
					title: 'Name',
					width: 200,
					autoHide: false,
				},
				{
					field: 'quantity',
					title: 'Total quantity',
					width: 90
				},
				{
					field: 'boxquantity',
					title: 'Box quantity',
					width: 90
				},
				{
					field: 'is_carton',
					title: 'Sell Per',
					width: 90,
					template: function(row) {
							var status = {
									1: {'title': 'Carton', 'class': 'primary'},
									2: {'title': 'Piece', 'class': 'dark'},
							};
							return '<span class="kt-font-bolder kt-badge kt-badge--' + status[row.is_carton].class + ' kt-badge--inline kt-badge--pill">' + status[row.is_carton].title + '</span>';
					},
				},
				{
					field: 'price1',
					title: 'price1',
					width: 40
				},
				{
					field: 'price2',
					title: 'price2',
					width: 40
				},
				{
					field: 'production_date',
					title: 'Production Date',
					width: 95
				},
				{
					field: 'exp_date',
					title: 'Expiry Date',
					width: 95
				},
				{
					field: 'temperature',
					title: 'Temperature',
					width: 75
				},
				{
					field: 'humidity',
					title: 'Humidity',
					width: 55
				},{
					field: 'Origin',
					title: 'Origin',
					width: 35
				},{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 70,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return '\
							<a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md modal-pro" title="Edit details" data-toggle="modal" data-target="#kt_modal_4" data-id="'+row.productId+'">\
								<i class="la la-edit"></i>\
							</a>\
							<a href='+DIR_CONT+DIR_PRO+'CON_productsuppliers.php?action=delete&productId='+row.productId+'&userId='+row.supplierId+'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
					},
				}],
		});
		datatable.reload();

		$("#kt_wrapper").on('click','.modal-pro', function() {
			var productId = $(this).data("id")
			$("#productId").val(productId);
			var url = DIR_CONT+DIR_PRO+"CON_productsuppliers.php?action=getprices&productId="+productId+"&userId="+userId;
			$.ajax({url: url, success: function(result){
				var product = JSON.parse(result);
				$("#totalquantity").val(product['quantity']);
				$("#boxquantity").val(product['boxquantity']);
				$("#is_carton").val(product['is_carton']);
				$("#range1").val(product['range1']);
				$("#price1").val(product['price1']);
				$("#range2").val(product['range2']);
				$("#price2").val(product['price2']);
				$("#tax").val(product['tax']);
				$("#discount").val(product['discount']);
				$("#sellingprice").val(product['selling_price']);
				$("#calsellingprice").val(product['selling_price']);
				$("#production_date").val(product['production_date']);
				$("#expiry_date").val(product['exp_date']);
				$("#temperature").val(product['temperature']);
				$("#humidity").val(product['humidity']);
				if (product['pro_domestic']==1) $('#is_domestic').prop('checked', false);
				else $('#is_domestic').prop('checked', true);
				if (product['pro_pickable']==1) $('#is_pickable').prop('checked', true);
				else $('#is_pickable').prop('checked', false);
				$("#origin").val(product['Origin']);
		  }});
		});

	};
	// Group buttons change data preview
	$("#btn-dt").click(function(){
		$("#rec-dt").show();
		$("#rec-gd").hide();
	});
	$("#btn-gd").click(function(){
		$("#rec-dt").hide();
		$("#rec-gd").show();
	});
	return {
		// public functions
		init: function() {
			demo();
			//searchGrid();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
$('#page').on('change', function() {
	searchGrid();
});
$('#pg').on('change', function() {
	searchGrid();
});
var searchGrid = function() {
	//var selected_page = $('#page').val().toLowerCase();
	//var selected_pg = $('#pg').val().toLowerCase();
	var url = DIR_CONT+DIR_PRO+"CON_supplierproductsgrid.php?action=getpro&page=1&supplierId="+userId;
	 //if(selected_page) url+="&page="+selected_page;
	 //if(selected_pg) url+="&pg="+selected_pg;
	$.ajax({url: url, success: function(result){
		console.log(url);
		document.getElementById("rec-gd").innerHTML = "";
		$("#rec-gd").html(result);
  }});
};
function page(pg) {
	$('#page').val(pg).trigger('change');
}
function ppg(pg) {
	$('#pg').val(pg).trigger('change');
}
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
						totalquantity: {
                required: true
            },
						boxquantity: {
                required: true
            },
						range1: {
                required: true
            },
						price1: {
                required: true
            },
						tax: {
                required: true
            }
        }
    });

    if (!form.valid()) {
        return;
    }
    $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_PRO+"CON_productsuppliers.php?action=post&userId="+userId,
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
        success: function(data) {
            switch (data['err']) {
                case '0':
								// similate 2s delay
								setTimeout(function() {
										//Simulate an HTTP redirect:
										window.location.replace(
												DIR_VIEW+DIR_PRO+"dt_myproducts.php"
										);
								}, 2000);
                    break;
                case '1':
                    // similate 2s delay
                    setTimeout(function() {
                        btn.removeClass(
                            'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                        ).attr('disabled', false);
                        showErrorMsg(form, 'danger',
                            'Incorrect Product data. Please try again.');
                    }, 2000);
                    break;
                default:
								// similate 2s delay
								setTimeout(function() {
										//Simulate an HTTP redirect:
										window.location.replace(
												DIR_VIEW+DIR_PRO+"dt_myproducts.php"
										);
								}, 2000);
            }
        }
    });
});
function CALsellingprice() {
	/*var tax = $('#tax').val()/100;*/
	var discount = $('#discount').val()/100;
	var sellingprice = 0;
	var price1 = $('#price1').val();
	var price2 = $('#price2').val();
	if (price2!=0) sellingprice = price2;
	else sellingprice = price1;
	/*if(tax!=0) tax = sellingprice*tax;
	else tax=0;*/
	if(discount!=0) discount = sellingprice*discount;
	else discount=0;
	/*sellingprice = parseFloat(sellingprice)+parseFloat(tax.toFixed(2))-parseFloat(discount.toFixed(2));*/
	sellingprice = parseFloat(sellingprice)-parseFloat(discount.toFixed(2));
	$('#sellingprice').val(sellingprice.toFixed(2));
	$('#calsellingprice').val(sellingprice.toFixed(2));
}
