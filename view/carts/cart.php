<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
use Anam\Phpcart\Cart;
if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
    $roleId = $usr->roleId;
    $userId = $usr->userId;
    switch ($_SESSION['Login_as']) {
  		case 1:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  		case 2:
  			include('../' . DIR_CON . "header_supplier.php");
  			break;

  		default:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  	}
} else {
    include("../" . DIR_CON . "guestheader.php");
}
$checkout_flag = 0;
if ($userId) {
  $res_cart = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get&userId=' . $userId);/*fetch userId*/
	$cart = json_decode($res_cart->getBody());
  if ($cart!=NULL) {
    $checkout_flag = 1;
  }
}else {
  $cart = new Cart;
  $cartItems = $cart->getItems();
  $sellers = array();
  foreach ($cartItems as $cartItem) {
    array_push($sellers,$cartItem->seller_id);
  }
  $sellers_count=count(array_unique($sellers));
}
?>


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


    <div class="row">
        <div class="col-lg-9">

            <div class="kt-portlet__body">

                <!--begin::Widget -->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <img src="<?php echo DIR_ROOT.DIR_ICON.'shoppingcart.png'?>" class="size-50"/>
                            </span>
                            <h3 class="kt-portlet__head-title kt-font-lg kt-font-bold">
                                Shopping Cart
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                  				<div class="kt-portlet__head-wrapper">
                  					<div class="btn-group btn-group" role="group" aria-label="...">
                  						<button id="btn-dt" type="button" class="btn btn-secondary"><i class="fa fa-list"></i></button>
                  						<button id="btn-gd" type="button" class="btn btn-secondary"><i class="fa fa-th"></i></button>
                  						<button id="btn-map-cart" type="button" class="btn btn-secondary"><i class="fa fa-globe"></i></button>
                  					</div>
                  				</div>
                  			</div>
                    </div>



                    <div class="kt-portlet__body kt-portlet__body--fit">
                      <div id="kt_gmap_3"></div>
                      <div id="rec-dt" style="min-height: 500px;">
                        <?php
                          if ($userId) {
                            if ($cart) {
                              $OFS_value = 0;
                              foreach ($cart as $item) {
                                if ($item->available==2) {
                                  $OFS = '<span class="kt-font-md kt-font-bolder kt-font-danger kt-ml-5">OUT OF STOCK.</span>';
                                  $OFS_value = 1;
                                }else {
                                  $OFS = '';
                                }
                                $totalPrice += ($item->price * $item->quantity);
                                echo '<div class="kt-portlet"><div class="kt-portlet__body"><div class="kt-widget kt-widget--user-profile-3"><div class="kt-widget__top">';
                                echo '<div class="kt-widget__media"><a href="'.DIR_VIEW . DIR_PRO.'productdetails.php?productId='.$item->productId.'"><img src="'.$item->path.'"></a><br><a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$item->sellerId.'">'.$item->companyname.'</a></div>';
                                echo '<div class="kt-widget__content"><div class="kt-widget__head">';
                                echo '<div class="kt-widget__title">'.$item->name.$OFS.'</div>';
                                echo '<div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.($item->price * $item->quantity).'</span></div></div>';
                                echo '<div class="kt-widget__info"><div class="kt-widget__stats d-flex align-items-center flex-fill"><div class="kt-widget__item">
                                <div class="kt-widget__label"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.$item->price.'/pcs </span></div></div>';
                                echo '<div class="kt-widget__item"><div class="kt-widget__label"><input type="number" min="'.$item->range1.'" step="'.$item->range1.'" class="form-control" value="'.$item->quantity.'" onchange="updateQty(this, '.$item->productId.','.$item->range1.','.$item->range2.','.$item->price1.','.$item->price2.')" style="width: 60px;" ></div></div>';
                                echo '<div class="kt-widget__item"><div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">kg '.($item->weight * $item->quantity).'</span></div></div>';
                                echo '<div class="kt-widget__item"><div class="kt-widget__label"><a href="'.DIR_CONT. DIR_CAR.'CON_carts.php?action=delete&productId='.$item->productId.'&userId='.$userId .'" class="kt-mr-10"><button type="button" class="btn btn-sm btn-upper" style="background: #edeff6">Remove item</button></a>';
                                echo '<button type="button" class="btn btn-sm btn-upper" onclick="addToWishList('.$userId .','.$item->sellerId.','.$item->productId.')" style="background: #edeff6">Add to Wishlist</button>';
                                echo '</div>';
                                echo '</div></div></div></div></div></div></div></div>';
                              }
                            }else {
                              echo '<div class="alert alert-secondary" role="alert"><div class="alert-text">Your cart is empty!</div></div>';
                            }
                          }else{
                            $totalPrice = 0;
                            $i = 1;
                            if (is_array($cartItems) || is_object($cartItems)) {
                                if ($cartItems != null) {
                                    foreach ($cartItems as $item) {
                                      $res_product = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_products.php?action=get-suppro&supplierId='.$item->seller_id.'&productId='.$item->id);/*fetch userId*/
                                      $product = json_decode($res_product->getBody());
                                      $totalPrice += ($item->price * $item->quantity);
                                      echo '<div class="kt-portlet"><div class="kt-portlet__body"><div class="kt-widget kt-widget--user-profile-3"><div class="kt-widget__top">';
                                      echo '<div class="kt-widget__media"><img src="'.$item->path.'"></div>';
                                      echo '<div class="kt-widget__content"><div class="kt-widget__head">';
                                      echo '<a href="'.DIR_VIEW . DIR_PRO.'productdetails.php?productId='.$item->id.'" class="kt-widget__title">'.$item->name.'</a>';
                                      echo '<div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.($item->price * $item->quantity).'</span></div></div>';
                                      echo '<div class="kt-widget__info"><div class="kt-widget__stats d-flex align-items-center flex-fill"><div class="kt-widget__item">
                                      <div class="kt-widget__label"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.$item->price.'/pcs </span></div></div>';
                                      echo '<div class="kt-widget__item"><div class="kt-widget__label"><input type="hidden" name="range1" id="range1" value="'.$product->product_pricing->range1.'"><input type="hidden" name="range2" id="range2" value="'.$product->product_pricing->range2.'"><input type="hidden" name="price1" id="price1" value="'.$product->product_pricing->price1.'"><input type="hidden" name="price2" id="price2" value="'.$product->product_pricing->price2.'"><input type="number" min="'.$product->range1.'" class="form-control" value="'.$item->quantity.'" onchange="changeQty(this, '.$item->id.')" style="width: 60px;"></div></div>';
                                      echo '<div class="kt-widget__item"><div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">kg '.($item->weight * $item->quantity).'</span></div></div>';
                                      echo '<div class="kt-widget__item"><div class="kt-widget__label"><a href="'.DIR_CONT. DIR_CAR.'CON_carts.php?action=delete&productId='.$item->productId.'&userId='.$userId .'" class="kt-mr-10"><button type="button" class="btn btn-sm btn-upper" style="background: #edeff6">Remove item</button></a>';
                                      echo '<button type="button" class="btn btn-sm btn-upper" onclick="login()" style="background: #edeff6">Add to Wishlist</button>';
                                      echo '</div>';
                                      echo '</div></div></div></div></div></div></div></div>';
                                    }
                                  }else{
                                    echo '<div class="alert alert-secondary" role="alert"><div class="alert-text">Your cart is empty!</div></div>';
                                  }
                                }
                              }
                         ?>
                         <input type="hidden" name="ofs_value" id="ofs_value" value="<?php echo $OFS_value;?>">
                         </div>
                      <div class="row align-items-center" id="rec-gd" style="display:none;min-height: 500px;">
                        <?php
                          $res_suppliers = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get-suppliers&userId='.$userId);/*fetch userId*/
                          $suppliers = json_decode($res_suppliers->getBody());
                          if($suppliers){
                            foreach ($suppliers as $supplier) {
                              echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid" style="height: 200px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__head-label">';
                              echo '<div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media">';
                              if ($supplier->profile_pic) {
                                echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#kt_modal_1" onclick="showdetails('.$supplier->sellerId.')"><img class="kt-widget__img " src="'.$supplier->profile_pic.'" alt="image"></a>';
                              }else {
                                echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#kt_modal_1" onclick="showdetails('.$supplier->sellerId.')"><img class="kt-widget__img " src="'.DIR_ROOT.DIR_MED.'companies/default.jpg" alt="image"></a>';
                              }
                              echo '<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">'.substr($supplier->companyname,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <div class="row"><div class="col-md-6 kt-p0">';
                              if (strlen($supplier->companyname)>13) {
                                echo '<a href="javascript:void(0)" class="kt-widget__username" data-toggle="modal" data-target="#kt_modal_1" onclick="showdetails('.$supplier->sellerId.')">'.substr($supplier->companyname,0,9).'...</a>';
                              }else {
                                echo '<a href="javascript:void(0)" class="kt-widget__username" data-toggle="modal" data-target="#kt_modal_1" onclick="showdetails('.$supplier->sellerId.')">'.$supplier->companyname.'</a>';
                              }
                              echo '</div><div class="col-md-6"><a href="javascript:void(0)" class="kt-widget__username kt-font-bolder" data-toggle="modal" data-target="#kt_modal_1" onclick="showdetails('.$supplier->sellerId.')">AED '.$supplier->total_seller.'</a></div></div></div>';
                              echo '<div class="kt-widget__item flex-fill"><div class="kt-media-group"><div class="kt-widget__action">';
                              echo '<div class="kt-space-10"></div>';
                              echo '</div></div></div></div></div></div></div></div></div></div>';
                            }
                          }else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
                        ?>
                      </div>
                    </div>
                  </div>
                  <!--End::Portlet-->
                </div>

            <form method="POST" id="cartupdate" action="<?php echo DIR_CONT . DIR_CAR . "cart-update.php?update=1&userId=".$userId; ?>">
                <input type="hidden" name="pid" id="pid">
                <input type="hidden" name="pp" id="pp">
                <input type="hidden" name="pqty" id="pqty">
            </form>

            <form method="POST" id="addtowishlist" action="<?php echo DIR_CONT . DIR_CAR . "CON_functions.php?action=add_to_wishlist"; ?> ">
                <input type="hidden" name="userId" id="userId">
                <input type="hidden" name="sellerId" id="sellerId">
                <input type="hidden" name="productId" id="productId">
            </form>

            <script>
                function changeQty(qty, pid) {
                    $('#pid').val(pid);
                    var range1 = parseInt($('#range1').val());
                    var range2 = parseInt($('#range2').val());
                    var price1 = parseInt($('#price1').val());
                    var price2 = parseInt($('#price2').val());
                    var quantity =qty.value;
                    if (quantity >= range1 && quantity < range2) {
                			$('#pp').val(price1);
                		} else if (quantity >= range2) {
                			$('#pp').val(price2);
                		}
                    if (quantity>=range1) {
                      $('#pqty').val(qty.value);
                      $('#cartupdate').submit();
                    }

                }
                function updateQty(qty, pid ,r1, r2, p1, p2) {
                    $('#pid').val(pid);
                    var range1 = parseInt(r1);
                    var range2 = parseInt(r2);
                    var price1 = parseInt(p1);
                    var price2 = parseInt(p2);
                    var quantity =qty.value;
                    if (quantity >= range1 && quantity < range2) {
                			$('#pp').val(price1);
                		} else if (quantity >= range2) {
                			$('#pp').val(price2);
                		}
                    if (quantity>=range1) {
                      $('#pqty').val(qty.value);
                      $('#cartupdate').submit();
                    }

                }

                currentUrl = window.location.href;
                var split = currentUrl.split('?');
                if(split[1]){
                  var message = split[1].split('=');
                  if (message[1] == 'updated') {
                      new Noty({
                          type: 'success',
                          theme: 'metroui',
                          timeout: 3000,
                          text: 'Product quantity has been updated.',
                      }).show();
                  }
                  if (message[1] == 'addedtocart') {
                      new Noty({
                          type: 'success',
                          theme: 'metroui',
                          timeout: 3000,
                          text: 'Product is ready to buy.',
                      }).show();
                  }
                  if (message[1] == 'addedtowishlist') {
                      new Noty({
                          type: 'success',
                          theme: 'metroui',
                          timeout: 3000,
                          text: 'Product has been added to wishlist.',
                      }).show();
                  }

                  if (message[1] == 'alreadyaddedtowishlist') {
                      new Noty({
                          type: 'error',
                          theme: 'metroui',
                          timeout: 3000,
                          text: 'Product is already into the wishlist.',
                      }).show();
                  }
                }
                function addToWishList(uid, sid, pid) {
                    $('#userId').val(uid);
                    $('#sellerId').val(sid);
                    $('#productId').val(pid);
                    $('#addtowishlist').submit();
                }
            </script>




        </div>

        <div class="col-lg-3">
            <!--begin:: Widgets/Sales States-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-lg kt-font-bold">
                            Order Summary
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget6">
                        <div class="kt-widget6__head">
                            <div class="kt-widget6__item">
                                <span>Subtotal</span>
                                <span class="kt-font-bolder kt-font-black">AED <?php echo $totalPrice ?></span>
                            </div>
                        </div>
                        <i class="fa fa-lock" style="font-size: 2rem; color: black"></i>
                        <span style="padding-left: 10px;"><span>
                                <a data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="We work hard to protect your security and privacy. Our payment security system encrypts your information during transmission. We don’t share your credit card details with third-party sellers, and we don’t sell your information to others.">
                                    Secure transaction
                                </a>
                                <div class="kt-widget6__foot">
                                    <div class="kt-widget6__action kt-align-right">
                                      <div class="row">
                                        <div class="col-md-6 kt-p0 kt-pr5">
                                          <?php if ($userId==0) { ?>
                                              <a href="javascript:void(0)" class="btn btn-buy btn-sm btn-block btn-buy kt-pt10 kt-pb10 height-40" onclick="login(3,0,0,0);">
                                              <img class="btn-img-checkout" src="assets/media/icons/shop.png">
                                              Proceed to CheckOut</a>
                                          <?php
                                            }else {
                                              if ($checkout_flag==1) {
                                                echo '<a href="javascript:void(0);" class="btn btn-sm btn-block btn-buy kt-pt10 kt-pb10 height-40" onclick="checkstock()">
                                                <img class="btn-img-checkout" src="assets/media/icons/shop.png">
                                                Proceed to CheckOut</a>';
                                              }
                                           } ?>
                                        </div>
                                        <div class="col-md-6 kt-p0 kt-pr-5">
                                          <a href="<?php echo DIR_VIEW.DIR_PRO;?>marketplace.php?ftbs=1" class="btn btn-warning btn-sm btn-block kt-pt10 kt-pb10 height-40">
                                          <img src="assets/media/icons/continue_shopping.png" width="24px" style="position: absolute; left: 5px;top:10px;">
                                          Continue Shopping</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Sales States-->
        </div>
    </div>



</div>
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart of Seller</h5>
        <button type="button" class="close kt-font-dark" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" id="cart_supplier">
      </div>
      <div class="modal-footer">
        <input type="hidden" name="sellerId" id="sellerId">
        <button type="button" class="btn btn-warning" id="invoice">Summary</button>
      </div>
    </div>
  </div>
  </div>
  <!--end::Modal-->
<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script>
// Group buttons change data preview
$("#btn-dt").click(function(){
  $("#rec-dt").show();
  $("#rec-gd").hide();
	$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-gd").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").show();
	$("#kt_gmap_3").attr("style", "height: 0px; position: relative; overflow: hidden; display: none;");
});
$("#btn-map-cart").click(function(){
  $("#rec-dt").hide();
  $("#rec-gd").hide();
  $("#kt_gmap_3").attr("style", "height: 500px; position: relative; overflow: hidden;");
	cartmapsellers();
});
var cartmapsellers = function() {
	var map = new GMaps({
		div: '#kt_gmap_3',
		lat: 24.7563957,
		lng: 55.2597173,
	});
	var url = DIR_CONT+DIR_CAR+"CON_carts.php?action=get-loc-buyer&userId="+<?php echo $userId;?>;
	$.get(url, function(data, status) {
		var users = JSON.parse(data);

		users.forEach((item, i) => {
			map.addMarker({
				lat: item[0]['latitude'],
				lng: item[0]['longitude'],
				title: item[0]['companyname'],
				infoWindow: {
					content: '<span style="color:#000">' + item[0]["companyname"] + '</span>'
				}
			});
		});
	});
	map.setZoom(7);
}
function showdetails(sellerId) {
  $.ajax({
    url: DIR_CONT + DIR_CAR + "CON_carts.php",
    type: "get", //send it through get method
    data: {
      action: "get-usercart-seller",
      sellerId: sellerId,
      userId: <?php echo $userId; ?>
    },
    success: function(response) {
      $('#cart_supplier').html(response);
      $('#sellerId').val(sellerId);
    },
    error: function(xhr) {
      console.log("err");
    }
  });
}
$("#invoice").click(function(){
  var sellerId= $('#sellerId').val();
  window.open(DIR_VIEW+DIR_ORD+"seller-proformainvoice.php?sellerId="+sellerId);
});
function checkstock() {
  var stock_flag = $('#ofs_value').val();
  if (stock_flag==1) {
    swal.fire("Please remove out of stock cart items or reduce to available quantity to proceed.", "", "warning");
  }else {
    location.href=DIR_VIEW+DIR_CAR+'checkout.php?return=checkout';
  }
}
</script>
