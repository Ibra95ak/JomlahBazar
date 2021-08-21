<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*require addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*create addresses instance*/
$db = new Ser_Addresses();
/*response Array*/
$response=array();
/*error flag*/
$response['err']=-1;
$response['countries']=array();
$response['states']=array();
$response['cities']=array();
/*url parameters*/
$action=$_GET['action'];
switch ($action) {
  case 'getcountries':
    $response['countries'] = $db->getcountries();
    $response['err']=0;
    break;
  case 'getstates':
    $response['states'] = $db->getcountrystates($_GET['iso']);
    $response['err']=0;
    break;
  case 'getcities':
    $response['cities'] = $db->getstatescities($_GET['stateId']);
    $response['err']=0;
    break;
  case 'getomanareas':
    $response['states'] = $db->getOmanAreas();
    $response['err']=0;
    break;

  default:
    $response['countries'] = $db->getcountries();
    break;
}
echo json_encode($response);
?>
