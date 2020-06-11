<?php
include('../AdminPanel/libraries/base.php');
include("header.php");
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-4">
      <div class="table-responsive wishlist-table">
        <table class="table wishlist-table">
          <thead class="title-h">
            <tr>
              <th align="left" valign="top"><input type="checkbox"></th>
              <th colspan="2"  class="product-price">Product Detail</th>
              <th class="product-subtotal text-center unit-price"><p>Unit Price</p></th>
              <th class="text-center product-add-date"><p>Date Added</p></th>
              <th class="text-center add-to-3-th"> <p>Stock Status</p> </th>
              <th class="add-to-cart-th"><p>Add to Cart</p></th>
            </tr>
          </thead>
          <tbody>
<?php
/*Fetch latest products through API*/
$API_wishlist = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Wishlist.php?userId=1");
$wishlist = json_decode($API_wishlist);  
if($wishlist){
    foreach($wishlist as $product){
        echo '<tr>';
        echo '<td align="left"><input  type="checkbox"></td>';
        $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$product->productId);
        $product_img = json_decode($API_product_img);
        foreach($product_img as $img){
            echo '<td class="product-thumbnail"><a href=""><img  width="100" src="../AdminPanel/pics/'.$img[0].'" class="" alt=""></a></td>';
        }
        echo '<td  class="product-name"><p><a href="single_product.php?productId='.$product->productId.'">'.$product->name.'</a></p></td>';
        echo '<td class="text-center unit-price"><p>'.$product->unitprice.'</p></td>';
        echo '<td class="text-center product-add-date"><p>'.$product->created_date.'</p></td>';
        echo '<td class="text-center"><a href="" class="add-to-3"><i class="fa fa-check"></i><span class="hidden-xs">&nbsp; In Stock</span></a></td>';
        echo '<td class="text-center"><a href="#" class="add-to-cart" onclick="addtocart('.$product->productId.')"><i class="fa fa-shopping-cart"></i><span class="hidden-xs">&nbsp; Add To Cart</span></a></td>';
        echo '<td><a href="#" onclick="deletewishlist('.$product->wishlistId.')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        echo '</tr>';
    }
}
?>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php include("footer.php");?>
<script>
function addtocart(productId){
    var userId =1;
  $.ajax({
        type: "GET",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/client/CON_Add_Cart.php?userId="+userId+"&productId="+productId,
        dataType: "json",
        success: function(data) {
            switch(data) {
              case 0:
               alert("Product is added to Cart.");
                break;
              case 1:
                alert("Product already exist.");
                break;
              case 2:
                alert("Error in adding");
                break;
              default:
                alert("Error");
            } 
        }
    });
}
function deletewishlist(wishlistId){
  $.ajax({
        type: "GET",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/client/CON_Delete_Wishlist.php?wishlistId="+wishlistId,
        dataType: "json",
        success: function(data) {
            switch(data) {
              case 0:
               alert("Product is Removed from wishlist.");
                break;
              case 1:
                alert("Error deleting.");
                break;
              default:
                alert("Error");
            }
            location.reload(); 
        }
    });
}
</script>