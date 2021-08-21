<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call subcategories class*/
require_once '../../../'.DIR_MOD.'Ser_Subcategories.php';
/*Create subcategories instance*/
$db = new Ser_Subcategories();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['subcategories']=array();
/*URL parameters*/
$action=$_GET['action'];
if (isset($_GET['subcategoryId'])) {
    $subcategoryId=$_GET['subcategoryId'];
} else {
    $subcategoryId=0;
}
if ($action=='get') {
    /*get subcategories by Id*/
    if ($subcategoryId!=0) {
        $subcategories = $db->GetSubcategoryById($subcategoryId);
        echo json_encode($subcategories);
    } else {
        $subcategories = $db->Getallsubcategories();
        if ($subcategories) {
            foreach ($subcategories as $subcategory) {
                array_push($response['subcategories'], $subcategory);
            }
        }
        $fp = fopen('../json/subcategories.json', 'w');
        fwrite($fp, json_encode($response['subcategories']));
        fclose($fp);
    }
}
if ($action=='post') {
    $target_dir = "../../../assets/media/subcategories/";
    $target_file = $target_dir . basename($_FILES["icon"]["name"]);
    $icon=substr($target_file, 6);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
        $response['err']==0;
    } else {
        $response['err']==1;
    }
    $categoryId=$_POST['categoryId'];
    $name=$_POST['name'];
    if (isset($_POST['active'])) {
        $active=1;
    } else {
        $active=2;
    }
    if ($subcategoryId!=0) {
        if($target_dir==$target_file){
          $icon=$db->GetSubcategoryById($subcategoryId)['icon'];
        }
        /*edit subcategory info*/
        $subcategory = $db->editSubcategory($subcategoryId, $categoryId, $name, $icon, $active);
        if ($subcategory) {
            $response['err']=0;
        } else {
            $response['err']=1;
        }
    } else {
        /*add new subcategory*/
        $subcategory = $db->addSubcategory($categoryId, $name, $icon, $active);
        if ($subcategory) {
            $response['err']=0;
        } else {
            $response['err']=1;
        }
    }
    echo json_encode($response);
}
if ($action=='delete') {
  /*delete subcategory*/
  $subcategory = $db->DeleteSubcategoryById($subcategoryId);
  if ($subcategory) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location:".DIR_VIEW.DIR_SCAT."dt_subcategories.php?err=".$response['err']);
}
?>
