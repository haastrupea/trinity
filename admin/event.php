<?php
session_start();
$message=[];
try {
    include_once("includes/dbcons.php");
    // include_once("includes/dbcons.php");
} catch (Exception $e) {
    // $message=$e->getMessage();
}
if(!$db){
    $message="Db error:try again later";
  return;
}

$je=json_encode($_POST);
$jd=json_decode($je);

//check that name,venue and desc of an event is not empty
$eventName=trim( $jd->eventName);
if( isset($_POST['eventName']) && $eventName===""){
   array_push($message,"Event name can not be blank");
}

$venue=trim( $jd->venue);

if(isset($_POST['venue']) && $venue===""){
    array_push($message,"Venue can not be blank");
 }

$eventDesc=trim( $jd->eventDescription);
if(isset($_POST['eventDescription']) && $eventDesc===""){
    array_push($message,"Event Description can not be blank");
 }


$eventdateStart=$jd->eventDateStart;
$eventdateEnd=$jd->eventDateEnd;
$createdOn=date('Y:m:d');
$createdBy=1;
$eventdateEnd=$jd->eventDateEnd;
$allDay=$jd->allDay;

$repeatEvent=$jd->repeatEvent;

$startquery='INSERT INTO event';
$datavalue=[$eventName,$venue,$eventDesc,$eventdateStart,$eventdateEnd,$createdOn,$createdBy];

$colName=['eventTitle','venue','eventDescription','startDate','endDate','createdDate','createdBy'];
$placeholder=[':eventName',':venue',':eventDesc',':startDate',':endDate',':createdOn',':createdBy'];

if(!$allDay){
    $eventTimeStart=$jd->startTime;
    $eventTimeEnd=$jd->endTime;

    $alldaydatakey=array(':isallDay',':startTime',':endTime');
    $colName=array_merge($colName,array('isAllDay','startTime','endTime'));
    $placeholder=array_merge($placeholder,$alldaydatakey);
    $datavalue=array_merge($datavalue,array(false,$eventTimeStart,$eventTimeEnd));
}


if((!empty($_POST['addEventBtn'])) && $repeatEvent==="no-repeat"){
    //bind placehoder with user input data
    $data=array_combine($placeholder,$datavalue);
    //build the query
    $query=$startquery.' ('.implode(',',$colName).') VALUES('.implode(",",$placeholder).')';
    //prepare the query
    $queried=$db->prepare($query);
    //excute the query against database
    // $eventadded=$queried->execute($data);
    $eventadded=1;
   if(!$eventadded){
    array_push($message,"Event not added, please add again"); 
    }else{
    array_push($message,"Event Added Successfully");
   }

}

if((!empty($_POST)) && $repeatEvent!=="no-repeat"){
    echo "repeat event";
}



//set error session pertaining to add error page;
// if(!empty($message)){
//     $_SESSION['message']=$message;
//     session_write_close();
// }
$_SESSION['message']=$message;
    session_write_close();
echo "<pre>";
var_dump($_REQUEST);
// var_dump($_SESSION);
var_dump($_COOKIE['PHPSESSID']);
echo "</pre>";
header('Location: index.php?page=event&action=add-event');
exit();
?>