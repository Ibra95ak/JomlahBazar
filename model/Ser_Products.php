<?php
class Ser_Products {
    private $conn;
    /*constructor*/
    function __construct() {
        require_once 'DB_Connect.php';
        /*connecting to database*/
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
    /*destructor*/
    function __destruct() {

    }
    /**
     * storing new product
     * parameters {maincategoryId, brandId, categoryId, subcategoryId, name, description, barcode, asin, countryoforigin, weight, width, length, height, palette, carton, pack, piece}
     * returns boolean
     */
    public function addProduct($maincategoryId, $brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin, $countryoforigin, $weight, $width, $length, $height, $palette, $carton, $pack, $piece) {
      $stmt = $this->conn->prepare("CALL sp_AddProduct(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("iiiisssssddddiiii",$maincategoryId, $brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin, $countryoforigin, $weight, $width, $length, $height, $palette, $carton, $pack, $piece);
      if ($stmt->execute()) {
          $result = $stmt->get_result()->fetch_assoc();
          $stmt->close();
          return $result;
      } else {
          return null;
      }
    }
    /**
     * storing new supplier product
     * parameters productId, supplierId, boxquantity , sellingprice, is_carton, range1, price1, range2, price2, tax, production_date, expiry_date, temperature, humidity, origin, quantity, is_domestic, is_pickable
     * returns boolean
     */
    public function AddSupplierProduct($productId, $supplierId, $boxquantity , $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $quantity, $is_domestic, $is_pickable) {
      $stmt = $this->conn->prepare("CALL sp_AddSupplierProduct(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("iiidiididddssddsiii",$productId, $supplierId, $boxquantity , $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $quantity, $is_domestic, $is_pickable);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    /**
     * storing new product details
     * parameters productId, size, ingredients, highlights, packageinformation, manufacturer
     * returns boolean
     */
    public function AddProductdetailsFood($productId, $size, $ingredients, $highlights, $packageinformation, $manufacturer) {
      $stmt = $this->conn->prepare("CALL sp_AddProductdetailsFood(?,?,?,?,?,?)");
      $stmt->bind_param("isssss",$productId, $size, $ingredients, $highlights, $packageinformation, $manufacturer);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    public function AddProductdetailsPerfume($productId, $size, $fragrancefor, $scenttype, $topnotes, $arabicscents, $luxuryperfume, $giftset, $tester) {
      $stmt = $this->conn->prepare("CALL sp_AddProductdetailsPerfume(?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("isissiiii",$productId, $size, $fragrancefor, $scenttype, $topnotes, $arabicscents, $luxuryperfume, $giftset, $tester);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    public function AddProductdetailsCosmetics($productId, $size, $color, $ingredients, $shadename, $highlights) {
      $stmt = $this->conn->prepare("CALL sp_AddProductdetailsCosmetics(?,?,?,?,?,?)");
      $stmt->bind_param("isssss",$productId, $size, $color, $ingredients, $shadename, $highlights);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    public function AddProductdetailsCare($productId, $size, $ingredients, $highlights, $formen_women, $count, $hair_skintypes) {
      $stmt = $this->conn->prepare("CALL sp_AddProductdetailsCare(?,?,?,?,?,?,?)");
      $stmt->bind_param("isssiss",$productId, $size, $ingredients, $highlights, $formen_women, $count, $hair_skintypes);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    /**
     * storing uploaded product list
     * parameters userId, path
     * returns boolean
     */
    public function AddProductList($userId, $path) {
      $stmt = $this->conn->prepare("CALL sp_AddProductList (?,?)");
      $stmt->bind_param("is",$userId, $path);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    /**
     * storing new product featured picture
     * parameters  productId, path, featured
     * returns boolean
     */
    public function AddProductPic($productId, $path, $featured) {
      $stmt = $this->conn->prepare("CALL sp_AddProductPic(?,?,?)");
      $stmt->bind_param("isi",$productId, $path, $featured);
      $result = $stmt->execute();
          $stmt->close();
          // check for successful store
          if ($result) return true;
          else return false;
    }
    /**
     * edit product
     * parameters productId, categoryId, subcategoryId, name, quantity, unitprice, discount, brandId, active
     * returns boolean
     */
    public function editProduct($productId, $brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin, $ranking, $blockId, $active, $bestseller, $featured) {
      $stmt = $this->conn->prepare("CALL sp_EditProduct(?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("iiiissssiiiii", $productId, $brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin, $ranking, $blockId, $active, $bestseller, $featured);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * edit product min_price
     * parameters productId, min_price
     * returns boolean
     */
    public function editProductminprice($productId, $min_price) {
      $stmt = $this->conn->prepare("CALL sp_editProductminprice(?,?)");
      $stmt->bind_param("id", $productId, $min_price);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * edit product quantity
     * parameters productId, quantity
     * returns boolean
     */
    public function editProductQuantity($productId, $quantity) {
      $stmt = $this->conn->prepare("CALL sp_editProductQuantity(?,?)");
      $stmt->bind_param("ii", $productId, $quantity);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * edit product moq
     * parameters productId, moq
     * returns boolean
     */
    public function editProductMOQ($productId, $moq) {
      $stmt = $this->conn->prepare("CALL sp_editProductMOQ(?,?)");
      $stmt->bind_param("ii", $productId, $moq);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    public function editProductDiscount($productId, $discount) {
      $stmt = $this->conn->prepare("CALL sp_editProductDiscount(?,?)");
      $stmt->bind_param("id", $productId, $discount);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * edit supplier product
     * parameters {supplierproductId, boxquantity , range1, price1, range2, price2, quantity, $tax, production_date, expiry_date, temperature, humidity, is_domestic, is_pickable)}
     * returns boolean
     */
    public function EditSupplierProduct($supplierproductId, $boxquantity, $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $quantity, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $is_domestic, $is_pickable){
      $stmt = $this->conn->prepare("CALL sp_EditSupplierProduct(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("iidiidididdssddsii", $supplierproductId, $boxquantity, $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $quantity, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $is_domestic, $is_pickable);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetAllProductIds() {
      $stmt = $this->conn->prepare("CALL sp_GetAllProductIds()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * Check if supplier product already exist
     * Parameters {productId, userId}
     * returns json/null
     */
    public function IsExistSupplierProduct($productId, $userId)
    {
        $stmt = $this->conn->prepare("CALL sp_IsExistSupplierProduct(?,?)");
        $stmt->bind_param("ii", $productId, $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function IsPickableSupplierProduct($productId, $userId)
    {
        $stmt = $this->conn->prepare("CALL sp_IsPickableSupplierProduct(?,?)");
        $stmt->bind_param("ii", $productId, $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetCheapestSupplier($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetCheapestSupplier(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get product minimum price
     * returns json/null
     */
    public function Getproductminprice($productId) {
      $stmt = $this->conn->prepare("CALL sp_Getproductminprice(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    public function GetProductRange1($supplierId,$productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductRange1(?,?)");
      $stmt->bind_param("ii",$supplierId,$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    public function GetCheapestSupplierPrice1($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetCheapestSupplierPrice1(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetProductTotalQty($productId) {
      $stmt = $this->conn->prepare("CALL sp_ProductTotalQty(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetLowestMOQ($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetLowestMOQ(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    public function GetHighestDiscount($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetHighestDiscount(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get supplier product prices
     * returns json/null
     */
    public function GetSupplierProductPrice($productId, $supplierId) {
      $stmt = $this->conn->prepare("CALL sp_GetSupplierProductPrice(?,?)");
      $stmt->bind_param("ii",$productId, $supplierId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get active products
     * returns json/null
     */
    public function GetActiveProducts($query) {
      $stmt = $this->conn->prepare("CALL sp_GetActiveProducts(?)");
      $stmt->bind_param("s",$query);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get active products
     * returns json/null
     */
    public function getActiveProductNames() {
      $stmt = $this->conn->prepare("CALL sp_getActiveProductNames()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * get all products
     * returns json/null
     */
    public function GetAllProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetAllProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * count products
     * returns json/Null
     */
    public function countProducts($query) {
      $stmt = $this->conn->prepare("CALL sp_GetActiveProductscount(?)");
      $stmt->bind_param("s",$query);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * count products
     * returns json/Null
     */
    public function countSupplierProducts($query) {
      $stmt = $this->conn->prepare("CALL sp_countSupplierProducts(?)");
      $stmt->bind_param("s",$query);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * count products
     * returns json/Null
     */
    public function countProductsBySupplierId($userId) {
      $stmt = $this->conn->prepare("CALL sp_countProductsBySupplierId(?)");
      $stmt->bind_param("i",$userId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get all products by supplier
     * parameters supplierId
     * returns json/Null
     */
    public function GetSupplierProducts($query) {
      $stmt = $this->conn->prepare("CALL sp_GetSupplierProducts(?)");
      $stmt->bind_param("s",$query);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get all products by supplier
     * parameters supplierId
     * returns json/Null
     */
    public function GetProductsBySupplierId($userId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductsBySupplierId(?)");
      $stmt->bind_param("i",$userId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get product by id
     * params productId
     * returns json/null
     */
    public function GetproductById($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductById(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json array*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * delete product by id
     * params productId
     * returns boolean
     */
    public function DeleteProductById($productId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteProductbyId(?)");
      $stmt->bind_param("i",$productId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * delete product by id
     * params productId
     * returns boolean
     */
    public function DeleteSupplierProductById($productId,$userId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteSupplierProductById(?,?)");
      $stmt->bind_param("ii",$productId,$userId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * get product picture
     * params productId
     * returns json/Null
     */
    public function GetFeaturedPicture($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetFeaturedPicture(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data and store in json array*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get 3 product picture
     * params productId
     * returns json/Null
     */
    public function GetProductSlider($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductSlider(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get product pictures
     * params productId
     * returns json/Null
     */
    public function GetProductPics($productId) {
      $stmt = $this->conn->prepare("CALL sp_GetProductPics(?)");
      $stmt->bind_param("i",$productId);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get best seller products
     * returns json/Null
     */
    public function GetBestSellerProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetBestSellerProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get less than 99 seller products
     * returns json/Null
     */
    public function Getlessthan99Products() {
      $stmt = $this->conn->prepare("CALL sp_Getlessthan99Products()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get latest products
     * returns json/Null
     */
    public function GetLatestProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetLatestProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get Eid event products
     * returns json/Null
     */
    public function GetEidProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetEidProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * get featured products
     * returns json/Null
     */
    public function GetFeaturedProducts() {
      $stmt = $this->conn->prepare("CALL sp_GetFeaturedProducts()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }

    /**
     * Get  product details by id
     * params productdetailId
     * returns json/Null
     */
    public function GetproductdetailById($productdetailId,$table_name) {
        $stmt = $this->conn->prepare("CALL sp_GetProductdetailById(?,?)");
        $stmt->bind_param("is",$productdetailId,$table_name);
        if ($stmt->execute()) {
            $productdetails = $stmt->get_result()->fetch_assoc(); //fetch productdetail data and productdetail in array
            $stmt->close();
            if ($productdetails==true) {
                return $productdetails;
            }
        } else return NULL;
    }
    /**
     * Get suppliers of product
     * params productId
     * returns json/Null
     */
    public function GetsuppliersByproductId($productId) {
        $stmt = $this->conn->prepare("CALL sp_GetsuppliersByproductId(?)");
        $stmt->bind_param("i",$productId);
        if ($stmt->execute()) {
          $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
          $stmt->close();
          if ($products==true) return $products;
          else return NULL;
        } else return NULL;
    }
    /**
     * storing new product
     * parameters brandId, categoryId, subcategoryId, name, description, barcode, asin
     * returns boolean
     */
    public function PushProductList($supplierId, $productId) {
      $stmt = $this->conn->prepare("CALL sp_PushProductList(?,?)");
      $stmt->bind_param("ii",$supplierId, $productId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful store*/
      if ($result) {
          return true;
      } else {
          return false;
      }
    }
    /**
     * pagination
     * parameters start page, end page, total pages
     * returns boolean
     */
    public function pagination($start, $total) {
      $pages = array();
      for($i=$start;$i<=5;$i++){
        if($i<$total) array_push($pages,$i);
      }
      return $pages;
    }
    public function updateInventoryless ($sellerId ,$productId, $quantity) {
      $stmt = $this->conn->prepare("CALL sp_updateInventoryless (?,?,?)");
      $stmt->bind_param("iii", $sellerId ,$productId, $quantity);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    public function updateTotalInventoryless ($productId, $quantity) {
      $stmt = $this->conn->prepare("CALL sp_updateTotalInventoryless (?,?)");
      $stmt->bind_param("ii", $productId, $quantity);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    public function updateInventorymore ($sellerId ,$productId, $quantity) {
      $stmt = $this->conn->prepare("CALL sp_updateInventorymore (?,?,?)");
      $stmt->bind_param("iii", $sellerId ,$productId, $quantity);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    public function updateTotalInventorymore ($productId, $quantity) {
      $stmt = $this->conn->prepare("CALL sp_updateTotalInventorymore (?,?)");
      $stmt->bind_param("ii", $productId, $quantity);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful edit*/
      if($result) return true;
      else return false;
    }
    public function getsellerproductquantity($sellerId, $productId)
    {
        $stmt = $this->conn->prepare("CALL sp_getsellerproductquantity(?,?)");
        $stmt->bind_param("ii", $sellerId, $productId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /*************************Admin Functions********************************/
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallProducts()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallProducts()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_GetproductById($productId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_GetproductById(?)");
        $stmt->bind_param("i", $productId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_GetProductPics($productId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_GetProductPics(?)");
        $stmt->bind_param("i", $productId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_GetsuppliersByproductId($productId)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_GetsuppliersByproductId(?)");
        $stmt->bind_param("i", $productId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
}
?>
