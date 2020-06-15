<?php
/*Get product class*/
require_once '../../libraries/Ser_Buyers.php';
/*Create Product Instance*/
$db = new Ser_Buyers();
/*results array*/
$results=array();
/*Parameters*/
$search=$_GET['search'];
$query="SELECT users.userId, users.first_name, users.last_name FROM users";
$where="";
$orderby="";
if(isset($_GET['order_by'])){
    switch ($_GET['order_by']) {
      case 1:
        $orderby.=" ORDER BY first_name ASC";
        break;
      case 2:
        $orderby.=" ORDER BY first_name DESC";
        break;
      default:
        $orderby.="";
    }
}
if(isset($_GET['filter_category']) && $_GET['filter_category']!=0){
    if($where=="") $where.=" WHERE categoryId=".$_GET['filter_category'];
    else $where.=" AND categoryId=".$_GET['filter_category'];
}

if(isset($_GET['filter_brand']) && $_GET['filter_brand']!=0){
    if($where=="") $where.=" WHERE brandId =".$_GET['filter_brand'];
    else $where.=" AND brandId=".$_GET['filter_brand'];
}
if(isset($_GET['filter_rank']) && $_GET['filter_rank']!=0){
    if($where=="") $where.=" WHERE ranking =".$_GET['filter_rank'];
    else $where.=" AND ranking=".$_GET['filter_rank'];
}
if(isset($_GET['filter_location']) && $_GET['filter_location']!='0'){
    $query.= " INNER JOIN address ON users.addressId=address.addressId";
    if($where=="") $where.=" WHERE address.city='".$_GET['filter_location']."'";
    else $where.=" AND address.city=".$_GET['filter_category'];
}
/*get all products */

$sql=$query.$where.$orderby;
//echo $sql;
$getAll_buyers = $db->Getbuyers($sql);
if($getAll_buyers){
    foreach($getAll_buyers as $buyers){
        array_push($results,$buyers);
    }
}
echo json_encode($results);
?>
