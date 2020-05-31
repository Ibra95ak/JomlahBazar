<?php
require_once '../AdminPanel/libraries/Ser_Categories.php';
$db = new Ser_Categories();  
$categories = $db->GetCategories();

require_once '../AdminPanel/libraries/Ser_Brands.php';
$db1 = new Ser_Brands();  
$brands = $db1->Getbrands();
?>
<div class="col-lg-2 col-md-12">
    <div class="inner-left-menu">
        <h3>Categories</h3>
        <div class="list-css">
            <ul>
                <?php
if($categories){
    foreach($categories as $category){
        echo '<li><a href="">'.$category['name'].'</a></li>';
    }
}                        
?>
            </ul>
        </div>
        <h3>Filter By Price</h3>
        <div class="price-range-block">
            <div id="slider-range" class="price-filter-range"></div>
            <div class="row">
                <div class="col-9 p-0">
                    <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
                    <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field" />
                </div>
                <div class="col-3 p-0">
                    <button type="button" class="btn btn-filter">Filter</button>
                </div>
            </div>
            <br>
        </div>
        <h3>Popular Picks</h3>
        <div class="list-css">
            <ul>
                <li>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-1">
                        <label class="custom-control-label" for="defaultUnchecked-1">Top Sales</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-2">
                        <label class="custom-control-label" for="defaultUnchecked-2">New Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-3">
                        <label class="custom-control-label" for="defaultUnchecked-3">Featured Products</label>
                    </div>
                </li>
                <li>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-4">
                        <label class="custom-control-label" for="defaultUnchecked-4">Bestsellers</label>
                    </div>
                </li>
            </ul>
        </div>
        <h3>brand</h3>
        <div class="tag_bottom">
            <?php
if($brands){
    foreach($brands as $brand){
        echo '<a class="tag-btn" href="">'.$brand['brand_name'].'</a>';
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
        <h3>Discout</h3>
        <div class="list-css">
            <ul>
                <li>
                    <!-- Default unchecked -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultUnchecked-1">
                        <label class="custom-control-label" for="defaultUnchecked-1">Discount</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>