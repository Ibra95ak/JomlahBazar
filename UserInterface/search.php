<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
require_once '../AdminPanel/libraries/Ser_Categories.php';
$db = new Ser_Categories();  
$categories = $db->GetCategories();
require_once '../AdminPanel/libraries/Ser_Brands.php';
$db1 = new Ser_Brands();  
require_once '../AdminPanel/libraries/Ser_Products.php';
$db2 = new Ser_Products();  
require_once '../AdminPanel/libraries/Ser_Suppliers.php';
$db3 = new Ser_Suppliers(); 
require_once '../AdminPanel/libraries/Ser_Pictures.php';
$db4 = new Ser_Pictures();
require_once '../AdminPanel/libraries/Ser_Buyers.php';
$db5 = new Ser_Buyers();
if(isset($_GET['search_category'])) $search_category=$_GET['search_category'];
else $search_category='';
if(isset($_GET['search'])) $search=$_GET['search'];
else $search='';

?>
<!-- Bread Crumbs and Filters and products -->
<div class="container container-fluid">
    <!-- Bread Crumbs -->
    <nav aria-label="breadcrumb" class="bread-boder">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="breadcrumb-item">Products</li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-select2">
                            <select>
                                <option>Default Sorting</option>
                                <option value="A-Z">A to Z</option>
                                <option value="Z-A">Z to A</option>
                                <option value="High to low price">High to low price</option>
                                <option value="Low to high price">Low to high</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-select2">
                            <select>
                                <option value="A-Z">Show 10</option>
                                <option value="Z-A">Show 20</option>
                                <option value="High to low price">Show 30</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </nav>
    <!-- Bread Crumbs -->

    <div class="row">
        <!-- Filters -->
        <?php include('filters.php');?>
        <!-- Filters -->

        <!-- Products Grid -->
        <div class="col-lg-10 col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="clearfix"></div>
                    <div class="row">
                        <?php
if($search!=NULL) $products = $db2->SearchProducts($search);
else $products = $db2->GetProducts();
if($products){
  foreach($products as $product){
    $product_pic = $db2->GetProductPicture($product['productId']);
    echo '<div class="col-lg-3 col-md-4 col-sm-6 product-card-col">';
    echo '<div class="product product-card">';
    echo '<a class="product-img" href="single_product.php?productId='.$product['productId'].'"><img src="../AdminPanel/pics/'.$product_pic['path'].'" alt=""></a>';
    echo '<h2><a><span class="product-title">'.$product['name'].'</span></a></h2>';
    echo '<div class="row m-0 list-n">';
    echo '<div class="col-lg-12 p-0">';
    echo '<div class="single-product-price">';
    echo '<span class="a-price" data-a-size="l" data-a-color="base"><span class="price-dollar">$</span><span class="price-digit">'.$product['unitprice'].'</span><span class="price-fraction"></span></span>';
    echo '</div></div></div></div></div>';
}  
}
?>
                        <div class="clearfix"></div>
                        <div class="col text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-template d-flex justify-content-center float-none">
                                    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                                    <li class="page-item"><a href="#" class="page-link active">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>

                        <!--Three-images-->
<div id="bestsellers">
    <div class="container">
        <h2 class="wow fadeInDown">Brands</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
<?php
if($search!=NULL) $brands = $db1->SearchBrand($search);
else $brands = $db1->Getbrands();
if($brands){
  foreach($brands as $brand){
    $brand_pic = $db4->GetPictureById($brand['brandId']);  
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="brand-details?brandId='.$brand['brandId'].'"><img src="../AdminPanel/pics/'.$brand_pic['path'].'" alt="" /></a>';
    echo '<h5 class="product-type">'.$brand['brand_name'].'</h5>';
    echo '<h3 class="product-name">'.$brand['name'].'</h3>';
    echo '</div></div>';
}  
}
?>
        </div>
    </div>
</div>
                        <!--Three-images-->

<div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-12">
              <div class="clearfix"></div>

              <div class="row">
<?php                  
$suppliers = $db3->Getsuppliers(); 
if($suppliers){
  foreach($suppliers as $supplier){
      echo '<div class="col-lg-12 col-md-12"><div class="supplier-card"><div class="row flex-lg-row flex-md-row flex-sm-row flex-column"><div class="col-lg-4 col-md-4 col-sm-4 col-12"><a class="product-img" href="supplier_detail.php?supplierId='.$supplier['supplierId'].'"><img src="assets/images/product-img/product-img-1.jpg"alt=""/></a></div>';
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-12 supplier-card-details"><h5 class="supplier-card-title text-left">'.$supplier['name'].'</h5>';
      echo '<div class="row m-0"><div class="col-lg-12 p-0">';
      echo '<h5 class="product-price">'.$supplier['email'].'</h5>';
      echo '<span class="">'.$supplier['type'].'</span>';
      echo '</div></div><div class=""><button title="Contact Supplier" class="add-to-compare contact-supplier-btn" onclick="supdetails('.$supplier['supplierId'].')"><i class="fa fa-contact" aria-hidden="true"></i>Contact Supplier</button></div></div></div></div></div>';
  }
}
      
?>
                <div class="clearfix"></div>
                <div class="col text-center">
                  <nav aria-label="Page navigation example">
                    <ul
                      class="pagination pagination-template d-flex justify-content-center float-none"
                    >
                      <li class="page-item">
                        <a href="#" class="page-link">
                          <i class="fa fa-angle-left"></i
                        ></a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link active">1</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">2</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">3</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">
                          <i class="fa fa-angle-right"></i
                        ></a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>

<div id="bestsellers">
    <div class="container">
        <h2 class="wow fadeInDown">Buyers</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
<?php
$buyers = $db5->Getbuyers();
if($buyers){
  foreach($buyers as $buyer){
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="buyer-details?userId='.$buyer['userId'].'"><img src="../AdminPanel/pics/products/product.jpg" alt="" /></a>';
    echo '<h5 class="product-type">'.$buyer['first_name'].'</h5>';
    echo '<h3 class="product-name">'.$buyer['email'].'</h3>';
    echo '<h3 class="product-name">'.$buyer['whatsapp'].'</h3>';
    echo '</div></div>';
}  
}
?>
        </div>
    </div>
</div>

                        <!-- Advertisement -->
                        <div id="deal-of-the-week">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-1">
                                        <div class="carousel slide carousel-fade pointer-event" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <figure class="imghvr-push-right">
                                                        <a href="shop.html"><img src="assets/images/page-img/sale.jpg" class="img-fluid" alt="" width="100%" title=""></a>
                                                        <figcaption>
                                                            <h3>Sale off Up to 30%</h3>
                                                            <p>
                                                                Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry Lorem Ipsum is simply dummy text of
                                                                the...
                                                            </p>
                                                        </figcaption>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Advertisement -->




                        <div class="clearfix"></div>
                    </div>

                </div>


            </div>
        </div>


    </div>
</div>
<div class="clearfix"></div>

<script>
function supdetails(subid){
    window.location.href="supplier_detail.php?supplierId="+subid;
}
</script>
<?php include("footer.php");?>