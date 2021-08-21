<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create Users instance*/
$db = new Ser_Users();
$query="SELECT * FROM users INNER JOIN address ON users.userId = address.userId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId INNER JOIN usr_reachout ON usr_reachout.reachoutId = users.reachoutId INNER JOIN usr_company ON users.usercompanyId = usr_company.usercompanyId ";
$query_count="SELECT COUNT( DISTINCT users.userId) as count FROM users INNER JOIN address ON users.userId = address.userId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId INNER JOIN usr_reachout ON usr_reachout.reachoutId = users.reachoutId INNER JOIN usr_company ON users.usercompanyId = usr_company.usercompanyId ";
/*initialize where clause*/
$where = "WHERE users.active=1";
/*initialize order by clause*/
$orderby="";
$groupby=" GROUP BY users.userId";
/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=24;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";

if(isset($_GET['categoryId'])){
  $query .= " INNER JOIN supplier_categories ON users.userId = supplier_categories.supplierId ";
  $query_count .= " INNER JOIN supplier_categories ON users.userId = supplier_categories.supplierId ";
  if($where == "") $where.=" WHERE supplier_categories.categoryId IN(".$_GET['categoryId'].")";
  else $where.=" AND supplier_categories.categoryId IN(".$_GET['categoryId'].")";
}
if(isset($_GET['brandId'])){
  $query .= " INNER JOIN supplier_brands ON users.userId = supplier_brands.supplierId ";
  $query_count .= " INNER JOIN supplier_brands ON users.userId = supplier_brands.supplierId ";
  $where.=" AND supplier_brands.brandId IN(".$_GET['brandId'].")";
}
if(isset($_GET['roleId'])){
  $where.=" AND usr_roles.roleId IN(".$_GET['roleId'].")";
}
if(isset($_GET['featured'])) $where.=" AND products.featured=1";
if(isset($_GET['bestseller'])) $where.=" AND products.bestseller=1";
if(isset($_GET['demandId'])){
  $query.=" INNER JOIN pro_demands ON products.productId = pro_demands.productId ";
  $query_count.=" INNER JOIN pro_demands ON products.productId = pro_demands.productId ";
  $where.=" AND pro_demands.demandId=".$_GET['demandId'];
}
if(isset($_GET['eventId'])){
  $query.=" INNER JOIN pro_events ON products.productId = pro_events.productId ";
  $query_count.=" INNER JOIN pro_events ON products.productId = pro_events.productId ";
  $where.=" AND pro_events.eventId=".$_GET['eventId'];
}
if(isset($_GET['generalSearch'])){
  $text = "'%".$_GET['generalSearch']."%'";
  $where.=" AND (usr_company.companyname LIKE ".$text.")";
}
if(isset($_GET['order_by'])){
  switch ($_GET['order_by']) {
    case 1:
      $sort='asc';
      $field='companyname';
      break;
    case 2:
      $sort='desc';
      $field='companyname';
      break;
    default:
      $sort='asc';
      $field='companyname';
      break;
  }
  $orderby =" ORDER BY ".$field." ".$sort;
}
if(isset($_GET['min_price']) && isset($_GET['max_price'])){
    if($_GET['min_price']==0 and $_GET['max_price']==0) $where.="";
    else{
      $where.=" AND min_price BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price'];
    }
}elseif(isset($_GET['min_price'])){
  if($_GET['min_price']==0) $where.="";
  else{
    $where.=" AND min_price >= ".$_GET['min_price'];
  }
}elseif(isset($_GET['max_price'])){
  if($_GET['max_price']==0) $where.="";
  else{
    $where.=" AND min_price <= ".$_GET['max_price'];
  }
}
if(isset($_GET['min_discount']) && isset($_GET['max_discount'])){
    if($_GET['min_discount']==0 and $_GET['max_discount']==0) $where.="";
    else{
      $where.=" AND min_discount BETWEEN ".$_GET['min_discount']." AND ".$_GET['max_discount'];
    }
}elseif(isset($_GET['min_discount'])){
  if($_GET['min_discount']==0) $where.="";
  else{
    $where.=" AND min_discount >= ".$_GET['min_discount'];
  }
}elseif(isset($_GET['max_discount'])){
  if($_GET['max_discount']==0) $where.="";
  else{
    $where.=" AND min_discount <= ".$_GET['max_discount'];
  }
}
$filter_cities=array();
if(isset($_GET['loc1'])) array_push($filter_cities,'Dubai');
if(isset($_GET['loc2'])) array_push($filter_cities,'Abu Dhabi');
if(isset($_GET['loc3'])) array_push($filter_cities,'Ajman');
if(isset($_GET['loc4'])) array_push($filter_cities,'Fujairah');
if(isset($_GET['loc5'])) array_push($filter_cities,'Ras al Khaimah');
if(isset($_GET['loc6'])) array_push($filter_cities,'Sharjah');
if(isset($_GET['loc7'])) array_push($filter_cities,'Umm al Quwain');
$cities="'".implode("', '", $filter_cities)."'";
if($cities!="''") $where.=" AND address.city IN (".$cities.")";
/*construct query*/
$sql=$query.$where.$groupby.$orderby.$limit;
$csql=$query_count.$where;
$data = $db->getallUsers($sql);
$users_count = $db->getUserscount($csql)['count'];
$pages=ceil($users_count/$num_rec_per_page);
$ppages=ceil($pages/5);
if(isset($_GET['pg'])) $pg=$_GET['pg'];
else $pg=1;
$start = ($pg - 1) * 5;
$offset1 = ($page - 1) * $num_rec_per_page + 1;
$offset2 = $page * $num_rec_per_page;
if($offset2>$users_count) $offset2=$users_count;
 if($pg<=1) $pgp=1;
 else $pgp=$pg-1;
if($pg>=$ppages) $pgn=$ppages;
else $pgn=$pg+1;
if($page+1>0 && $page+1<=$pages) $next = $page+1;
else $next = $pages;
if($page-1>0 && $page-1<=$pages) $prev = $page-1;
else $prev = 1;
if($data){
  foreach ($data as $user) {
    $username=$user['companyname'];
    echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 230px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__head-label">';
    echo '<a href="javascript:void" class="btn btn-icon size-20 btn-circle btn-label-dark kt-mb-5 contacts-link-grid" data-id="'.$user['userId'].'"><img src="'.DIR_ROOT.DIR_MED.'logos/favicon.ico" style="width: 24px;"/></a>';
    echo '<div id="contactsgrid'.$user['userId'].'" class="top-bubble" style="display:none;">';
    echo '<a href="mailto:'.$user['email'].'" class="btn btn-icon size-20 btn-circle btn-label-dark kt-mb-5" target="_blank"><img src="'.DIR_ROOT.DIR_MED.'logos/favicon.ico" style="width: 24px;"/></a>';
    if(isset($user['phone']) && $user['phone']!=null) echo '<a href="tel:'.$user['phone'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fa fa-phone"></i></a>';
    if(isset($user['whatsapp']) && $user['whatsapp']!=null) echo '<a href="https://wa.me/'.$user['whatsapp'].'?text=Im%20interested%20in%20your%20products" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fab fa-whatsapp"></i></a>';
    if(isset($user['teams']) && $user['teams']!=null) echo '<a href="callto:'.$user['teams'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><img src="'.DIR_ROOT.DIR_ICON.'teams.png" style="width: 24px;"/></a>';
    if(isset($user['zoom']) && $user['zoom']!=null) echo '<a href="'.$user['zoom'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><img src="'.DIR_ROOT.DIR_ICON.'zoom.ico" style="width: 24px;"/></a>';
    if(isset($user['telegram']) && $user['telegram']!=null) echo '<a href="https://t.me/'.$user['telegram'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fab fa-telegram-plane"></i></a>';
    if(isset($user['messenger']) && $user['messenger']!=null) echo '<a href="https://m.me/'.$user['messenger'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fab fa-facebook-messenger contact_icon"></i></a>';
    if(isset($user['linkedin']) && $user['linkedin']!=null) echo '<a href="'.$user['linkedin'].'" class="btn btn-icon size-20 btn-circle btn-label-dark contact_icon" target="_blank"><i class="fab fa-linkedin"></i></a>';
    if(isset($user['sms']) && $user['sms']!=null) echo '<a href="sms:'.$user['sms'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fa fa-sms contact_icon"></i></a>';
    if(isset($user['facebook']) && $user['facebook']!=null) echo '<a href="https://www.facebook.com/'.$user['facebook'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fab fa-facebook-f contact_icon"></i></a>';
    if(isset($user['instagram']) && $user['instagram']!=null) echo '<a href="https://www.instagram.com/'.$user['instagram'].'" class="btn btn-icon size-20 btn-circle btn-label-dark" target="_blank"><i class="fab fa-instagram contact_icon"></i></a></div>';
    echo '</div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media">';
    if ($user['profile_pic']) {
      echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user['userId'].'"><img class="kt-widget__img " src="'.$user['profile_pic'].'" alt="image"></a>';
    }else {
      echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user['userId'].'"><img class="kt-widget__img " src="'.DIR_MED.'companies/default.jpg" alt="image"></a>';
    }
    echo '<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">'.substr($username,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <div class="row safari-row-flex"><div class="col-md-6 col-6 kt-p0">';
    if (strlen($username)>13) {
      echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user['userId'].'" class="kt-widget__username">'.substr($username,0,9).'...</a>';
    }else {
      echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user['userId'].'" class="kt-widget__username">'.$username.'</a>';
    }
    echo '</div><div class="col-md-6 col-6"><a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user['userId'].'" class="kt-widget__username kt-font-bolder">'.$user['role'].'</a></div></div></div>';
    echo '<div class="kt-widget__item flex-fill"><div class="kt-media-group"><div class="kt-widget__action">';
    echo '<div class="kt-space-10"></div>';
    echo '</div></div></div></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
 <div class="kt-portlet kt-mb-5 col-md-12">
   <div class="kt-portlet__body kt-padding-2">

     <!--begin: Pagination-->
     <div class="kt-pagination kt-pagination--dark kt-m5" style="margin-bottom: 13px !important;">
       <div class="kt-pagination__toolbar">
       </div>
       <ul class="kt-pagination__links">
         <li class="kt-pagination__link--first">
           <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-dark"></i></a>
           <li class="kt-pagination__link--next">
             <a href="javascript:void(0)" onclick="page(<?php echo $prev;?>)"><i class="fa fa-angle-left kt-font-dark"></i></a>
           </li>
         </li>
         <?php
         $count=0;
         for($i=$start+1;$i<=$pages;$i++){
           $count++;
           if($count<=5){
             if($page==$i) echo '<li class="kt-pagination__link--active"><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
             else echo '<li><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
           }
           else echo '';
         }
          ?>
          <li class="kt-pagination__link--prev">
            <a href="javascript:void(0)" onclick="page(<?php echo $next;?>)"><i class="fa fa-angle-right kt-font-dark"></i></a>
          </li>
         <li class="kt-pagination__link--last">
           <a href="javascript:void(0)" onclick="page(<?php echo $pages;?>)"><i class="fa fa-angle-double-right kt-font-dark"></i></a>
         </li>
         <li class="transparent-bg"><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">
           <?php echo 'Displaying '.$offset1.' - '.$offset2.' of '.$users_count.' records'; ?>
         </span></li>
       </ul>
     </div>

     <!--end: Pagination-->
   </div>
 </div>
