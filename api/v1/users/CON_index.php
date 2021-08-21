<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call roles class*/
require_once '../../../'.DIR_MOD.'Ser_Index.php';
/*Create Users instance*/
$db = new Ser_Index();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['events']=array();
$response['demands']=array();
/*URL parameters*/
$action=$_GET['action'];
if ($action=='get') {
  /*get all events*/
  $events = $db->getallActiveEvents();
  /*fill result in json array*/
  foreach ($events as $event) {
    array_push($response['events'],$event);
  }
  /*get all demands*/
  $demands = $db->getallActiveDemands();
  /*fill result in json array*/
  foreach ($demands as $demand) {
    array_push($response['demands'],$demand);
  }
  $response['err']=0;
}
if ($action=='get-events') {
  /*get all events*/
  $events = $db->getallActiveEvents();
  /*fill result in json array*/
  foreach ($events as $event) {
    array_push($response['events'],$event);
  }
  $response['err']=0;
}
if ($action=='get-demands') {
  /*get all demands*/
  $demands = $db->getallActiveDemands();
  /*fill result in json array*/
  foreach ($demands as $demand) {
    array_push($response['demands'],$demands);
  }
  $response['err']=0;
}
echo json_encode($response);
?>
