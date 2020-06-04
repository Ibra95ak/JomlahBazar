<?php
/*Get base class*/
require_once '../../libraries/base.php';
/*Call categories class*/
require_once '../../libraries/Ser_Categories.php';
/*Create categories instant*/
$db1 = new Ser_Categories(); 
/*Call subcategories class*/
require_once '../../libraries/Ser_Subcategories.php';
/*Create subcategories instant*/
$db2 = new Ser_Subcategories(); 
/*Fetch categories */
$categories = $db1->GetCategories();
if($categories){
  foreach($categories as $category){
      echo '<div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3"><ul class="ch-grid"><li><div class="ch-item" style="background: url(assets/images/product/left-img.jpg) no-repeat center top;background-size: 100% 100%;"><div class="ch-info"><div class="img-text">';
      echo '<h3>'.$category['name'].'</h3>';
      /*Fetch subcategories */
      $subcategories = $db2->GetSubcategoryByCategoryId($category['categoryId']);
      if($subcategories){
          foreach($subcategories as $subcategory){
              echo '<p>'.$subcategory[2].'</p>';
          }
      }
    echo ' <a href="#">view more</a>';
    echo '</div></div></div></li></ul></div>';
}  
}
?>