<?php

?>
<div class="col-lg-2 col-md-12" style="overflow-x: hidden;overflow-y: auto;max-height: 530px;">
    <div class="inner-left-menu">
        <div class="list-css">
            <ul>
                <li>
                    <div class="custom-select2">
                        <select>
                            <option>Default Sorting</option>
                            <option value="A-Z">A to Z</option>
                            <option value="Z-A">Z to A</option>
                            <option value="High to low price">High to low price</option>
                            <option value="Low to high price">Low to high</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="custom-select2">
                        <select>
                            <option value="A-Z">Show 10</option>
                            <option value="Z-A">Show 20</option>
                            <option value="High to low price">Show 30</option>
                        </select>
                    </div>
                </li>
            </ul>
        </div>
        <h3>Categories</h3>
        <div class="list-css">
            <ul class="list-unstyled components">
                <?php
$API_productscategories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Filter_Categories.php?search=".urlencode($search));
$productscategories = json_decode($API_productscategories); 
if($productscategories){
    $count=0;
    foreach($productscategories as $category){
        $count++;
        echo '<li class="active"><a href="#homeSubmenu'.$count.'" data-toggle="collapse" aria-expanded="false" class="collapsed">'.$category->name.'<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
        echo '<ul class="list-unstyled collapse" id="homeSubmenu'.$count.'" style="">';
        $API_productssubcategories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_FeaturedSubCategories.php?categoryId=".$category->categoryId);
      $productssubcategories = json_decode($API_productssubcategories); 
      if($productssubcategories){
          foreach($productssubcategories as $productssubcategory){
              echo '<li><a href="product-search.php?search_by=2&search_category='.$category->categoryId.'&search_subcategory='.$productssubcategory[0].'&search=">'.$productssubcategory[2].'</a></li>';
          }
      }
        echo '</ul></li>';
    }
}                        
?>
            </ul>
        </div>
        <h3>Filter By Price</h3>
        <div class="price-range-block">
            <div class="row">
                <div class="col-12 p-0">
                    <input type="number" id="min_price" name="min_price" class="price-range-field" placeholder="MIN" />
                    <input type="number" id="max_price" name="max_price" class="price-range-field" placeholder="MAX" />
                </div>
            </div>
        </div>
        <h3>Popular Picks</h3>
        <div class="list-css">
            <ul>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="latest_products" name="latest_products">
                        <label class="custom-control-label" for="latest_products">New Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="featured_products" name="featured_products">
                        <label class="custom-control-label" for="featured_products">Featured Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="bestseller_products" name="bestseller_products">
                        <label class="custom-control-label" for="bestseller_products">Best seller</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="discount_products" name="discount_products">
                        <label class="custom-control-label" for="discount_products">Discount</label>
                    </div>
                </li>
            </ul>
        </div>
        <h3>brand</h3>
        <div class="tag_bottom">
            <?php
require_once '../AdminPanel/libraries/Ser_Brands.php';
$db1 = new Ser_Brands();  
$brands = $db1->Getbrands(); 
if($brands){
    foreach($brands as $brand){
        echo '<a class="tag-btn" href="brand-search.php?search_category=0&search='.$brand['brand_name'].'">'.$brand['brand_name'].'</a>';
    }
}                        
?>
        </div>
        <h3>registered suppliers</h3>
        <div class="list-css">
            <ul>
                <li><a href="">reg sup1</a></li>
                <li><a href="">reg sup2</a></li>
            </ul>
        </div>
        <h3>store</h3>
        <div class="list-css">
            <ul>
                <li><a href="">store1</a></li>
                <li><a href="">store2</a></li>
            </ul>
        </div>
        <h3>reviews</h3>
        <div class="list-css">
            <ul>
                <li><a href="">1 star</a></li>
                <li><a href="">2 stars</a></li>
            </ul>
        </div>
        <h3>location</h3>
        <div class="list-css">
            <ul>
                <li><a href="">location1</a></li>
                <li><a href="">location2</a></li>
            </ul>
        </div>
    </div>
    <div class="sticky" id="filter">Filter</div>
</div>
<script>
    document.getElementById("filter").onclick = function() {
        var filter = "";
        var min_price = document.getElementById("min_price").value;
        var max_price = document.getElementById("max_price").value;
        var latest_products = document.getElementById("latest_products");
        var featured_products = document.getElementById("featured_products");
        var bestseller_products = document.getElementById("bestseller_products");
        var discount_products = document.getElementById("discount_products");
        if ((min_price >= max_price) && (min_price != null) && (max_price != null)) alert("fix prices");
        else {
            if (min_price) filter += "&min_price=" + min_price;
            else filter += "&min_price=0";
            if (max_price) filter += "&max_price=" + max_price;
            else filter += "&max_price=0";
        }
        if (latest_products.checked) filter+="&lp=1";
        if (featured_products.checked) filter+="&fp=1";
        if (bestseller_products.checked) filter+="&bp=1";
        if (discount_products.checked) filter+="&dp=1";
location.href= window.location+filter;
    };
</script>