<?php
session_start();
use uploadHelperClass\UploadFile;
$message=[];
if(isset($_SESSION['logged_in'])){
$createdBy = $_SESSION['logged_in'];
}
$action_fail=true;
 //flyer location folder
$flyer_dir=dirname(__DIR__,3).'/assets/uploads/flyer/';
try {
    include_once("../dbcons.php");
    require_once '../../includes/classes/UploadFile.php';
    // include_once("includes/dbcons.php");
} catch (Exception $e) {
    // $message=$e->getMessage();
    // echo $e->getMessage();
}
if(!$db){
    $message[]="Database error:try again later";
}
//function
function uploadFileFlyer(String $destination,Array $option=['allowFileType'=>'image','fileSize'=>524288]){
        $message=[];
        $filetype=$option['allowFileType'];
        $max_file_size= $option['fileSize'];
        try {
            
            $upload = new UploadFile($destination, $filetype);
            $upload->setMaxSize($max_file_size);

            if($option['fileName']){
                $upload->setfileName($option['fileName']);
            }
            $upload->upload($_FILES,false);
            $result = $upload->getMessages();

        if(is_array($result)){
            $message=array_merge($message,$result);
          
        }
        unset($result);

        } catch (Exception $e) {
        array_push($message,$e->getMessage());
        }
        
    return ['hash'=>$upload->gethashfilename(),'message'=>$message];
}

function monthOfWeek(int $date){
    $vv=ceil($date/7);
    if($vv>=4){
    return 4;
    }else{
        return $vv;
    }
}

function nbweeks_of_month($month, $year){
    $nb_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first_day = date('w', mktime(0, 0, 0, $month, 1, $year));

    if($first_day > 1 && $first_day < 6){ 
        // month started on Tuesday-Friday, no chance of having 5 weeks
            return 4;
        
    } else if($nb_days == 31) return 5;
    else if($nb_days == 30) return ($first_day == 0 || $first_day == 1)? 5:4;
    else if($nb_days == 29) return $first_day == 1? 5:4;
}


if(!empty($_POST['add_event_btn'])){

    $je=json_encode($_POST);
    $jd=json_decode($je);
    //check that name,venue and desc of an event is not empty
    $eventName=trim( $jd->event_name);
    if( isset($_POST['eventName']) && $eventName===""){
       array_push($message,"Event name can not be blank");
    }
    $venue=trim( $jd->event_venue);
    
    if(isset($_POST['venue']) && $venue===""){
        array_push($message,"Venue can not be blank");
     }
    
    $eventDesc=trim( $jd->event_description);
    if(isset($_POST['eventDescription']) && $eventDesc===""){
        array_push($message,"Event Description can not be blank");
     }
    
    
    $eventdateStart=$jd->event_date_start;
    $eventdateEnd=$jd->event_date_end;
    $allDay=$jd->all_day;
    $startInsertquery='INSERT INTO';
    
    $colName=['event_name','venue','event_description','start_date','created_by'];
    $placeholder=[':eventName',':venue',':eventDesc',':startDate',':createdBy'];
    $datavalue=[$eventName,$venue,$eventDesc,$eventdateStart,$createdBy];
    
    if(!$allDay){
        $eventTimeStart=$jd->start_time;
        $eventTimeEnd=$jd->end_time;
        $colName=array_merge($colName,array('is_all_day','start_time','end_time'));
        $placeholder=array_merge($placeholder,array(':isallDay',':startTime',':endTime'));
        $datavalue=array_merge($datavalue,array(false,$eventTimeStart,$eventTimeEnd));
    }


        if(!isset($jd->use_event_name)){
            //add flyer to query chain
          $results=uploadFileFlyer($flyer_dir,['fileName'=>$eventName,'allowFileType'=>'image','fileSize'=>524288]);
          if(empty($results['message'])){

        $file_name=$results['hash'];
        $colName=array_merge($colName,array('use_event_name','flyer_file_name'));
        $placeholder=array_merge($placeholder,array(':use_event_name',':flyer_file_name'));
        $datavalue=array_merge($datavalue,array(false,$file_name));
        }
    }


    $repeatEvent=$jd->repeat_event;
    if(empty($message)  && $repeatEvent==="no_repeat"){
        //add event enddate
        array_push($colName,'end_date');
    array_push($placeholder,":eventend");
    array_push($datavalue,$eventdateEnd);

    //bind placehoder with user input data
    $data=array_combine($placeholder,$datavalue);
    //build the query
    $Insertqueryevent=$startInsertquery."`Ev_events`";
    $query=$Insertqueryevent.' ('.implode(',',$colName).') VALUES('.implode(",",$placeholder).')';
    $queried=$db->prepare($query);
    //excute the query against database
   if(!$queried->execute($data)){
    array_push($message,"Event not added, please add again");
    }else{
    array_push($message,"Event Added Successfully");
    $action_fail=false;
   }
  }

  //handle repeat events

    if(empty($message)  && $repeatEvent!=="no_repeat"){
        $repeatEvent=trim($jd->repeat_event);
        $repeatInterval=trim($jd->interval);
        $startdate=strtotime($eventdateStart);//start date timestamp
   
        array_push($placeholder,':is_recurring');
        array_push($datavalue,true);
        array_push($colName,'is_recurring');


        //get event type id from Ev_repeat_type table
        $sqlEventType='SELECT id FROM Ev_repeat_type
        WHERE repeat_type=?';
        $querygetEvType=$db->prepare($sqlEventType);
        if($querygetEvType->execute([$repeatEvent])){
            $repeat_type_id=$querygetEvType->fetch(PDO::FETCH_ASSOC)['id'];

            $pattern_datavalue=[];
            $pattern_colname=[];
            $pattern_placeholder=[];
            $repeatFor=$jd->repeat_for;
    
    
         //add event name and id to repeat pattern table
            array_push($pattern_colname,'repeat_type','interval_sep');
            array_push($pattern_placeholder,':repeat_type',':interval');
            if($repeat_type_id){
                array_push($pattern_datavalue,$repeat_type_id,$repeatInterval);
            }else{
            array_push($message,"Repeat type given does not exist");

            }//incase some edit form input via inspect
        }else{
            array_push($message,"Error processing your request,please try again later");
        }//error getting repeat type id;
    

        if(empty($message)){
              
            if($repeatFor==="until"){
                //until
                $until=$jd->until;
                $untilTimestamp=strtotime($until);
                $oneday=(24*60*60);
                if(!$untilTimestamp){
                    array_push($message,"Please enter valid End date");
                }
                if(!$startdate){
                    array_push($message,"Please enter Valid start date");
                }

                
                
                if(empty($message)){
                if($repeatEvent==='daily'){

                    if(($startdate+$oneday)>$untilTimestamp){
                        array_push($message,"Event End date must be greater than starting date");
                    }
                }
                
                if($repeatEvent==='weekly'){
                if($startdate>$untilTimestamp){
                        array_push($message,"Event End date must be greater than starting date");
                }

                $startyrweek=date('W',$startdate);
                $untilyrweek=date('W',$untilTimestamp);
                if($startyrweek===$untilyrweek){
                    array_push($message,"Start and end date can not be in the same week");
                }
                }
                
                if($repeatEvent==='monthly'){
                  //untill date must be another Month
                  $untilMonth=date('Y-m', $untilTimestamp);
                  $startMonth=date('Y-m', $startdate);

                 if($startMonth===$untilMonth){
                
                    array_push($message,"Start and end month can not be the same ");
                 }
                }
                
                if($repeatEvent==='yearly'){

                    if(date('Y', $startdate)===date('Y', $untilTimestamp)){
                        array_push($message,"Start and end year can not be the same ");
                    }
                }

                }

                if(empty($message)){
                    $eventdateEnd  = date('Y-m-d',$untilTimestamp); 
                }
            }

         if(empty($message)){
                //week days
            if(isset($_POST['weekdays'])){
                    $weekselected=$_POST['weekdays'];
                    sort($weekselected);
                    //build query for week
                    array_push($pattern_colname,'day_of_week');
                    array_push($pattern_placeholder,':day_of_week');
                    array_push($pattern_datavalue,implode(',',$weekselected));       
           

            }

                //week of month if any
            if(isset($_POST['weekofmonth'])){
                $weekofmonthselected=$_POST['weekofmonth'];
                sort($weekofmonthselected);
                array_push($pattern_colname,'week_of_month');
                array_push($pattern_placeholder,':week_of_month');
                array_push($pattern_datavalue,implode(',',$weekofmonthselected));
            }

            if($repeatFor==="0"){
                $eventdateEnd=null; 
            } 
            
            
            if($repeatFor==="occurencies"){
                //occurencies
                $occ=$jd->occurencies;
                //event pattern table occurencies takies its value
                array_push($pattern_colname,'occurencies');
                array_push($pattern_placeholder,':occurencies');
                array_push($pattern_datavalue,$occ);
          
                //add it to query chain
                //determine end date for until
                
                $start=strtotime($eventdateStart);
                if ($start === false || $start < 0) {
                    array_push($message,"invalid start date supplied");    
                }
    
                if(empty($massage)){
                    if($repeatEvent==='daily'){
                        $event_endDate_stamp  = mktime(0, 0, 0, date("m",$start)  , date("d",$start)+$occ, date("Y",$start));
                
                        $eventdateEnd  = date('Y-m-d',$event_endDate_stamp); 
                    }else if($repeatEvent==='weekly'){
                        $days=$occ*(7);
                        $event_endDate_stamp  = mktime(0, 0, 0, date("m",$start)  , date("d",$start)+$days, date("Y",$start));
                
                        $eventdateEnd  = date('Y-m-d',$event_endDate_stamp);
                    }else if($repeatEvent==='monthly'){
                        $event_endDate_stamp  = mktime(0, 0, 0, date("m",$start)+$occ  , date("d",$start), date("Y",$start));
                
                        $eventdateEnd  = date('Y-m-d',$event_endDate_stamp);
                    }else if($repeatEvent==='yearly'){
                        $event_endDate_stamp  = mktime(0, 0, 0, date("m",$start)  , date("d",$start), date("Y",$start)+$occ);
                
                        $eventdateEnd  = date('Y-m-d',$event_endDate_stamp);
                    }
                }
            }//compute end date when there is no of occurency
        }

        }

        
      
            

//paramenter for excute fn;
        if($eventdateEnd!==null){
            //add endate to query chain if not null
            array_push($colName,'end_date');
            array_push($placeholder,":eventend");
            array_push($datavalue,$eventdateEnd);
        }

        if(empty($message)){
            //check if this event has been added before;
            $sqlcount='SELECT COUNT(*) as row FROM `Ev_events` WHERE  event_description=? AND event_name=? AND venue=? AND is_recurring=?';
            $values=[$eventDesc,$eventName,$venue,true];
            $quercount=$db->prepare($sqlcount);
            $quercount->execute($values);
            $rowcount=$quercount->fetch(PDO::FETCH_ASSOC);

            //insert into event table
            if((int)$rowcount['row']===0){
            $data=array_combine($placeholder,$datavalue);
            //build the query
            $Insertqueryevent=$startInsertquery." `Ev_events`";
            $queryaddEvent=$Insertqueryevent.' ('.implode(',',$colName).') VALUES('.implode(",",$placeholder).')';//query for event table alone.
            $insertEvent=$db->prepare($queryaddEvent);

            //Transaction begin
            $db->beginTransaction();
            $inserted=$insertEvent->execute($data);
            if(!$inserted){
                $db->rollBack();
                array_push($message,"Failed to add Event, Please try again");
            }else{
                //fetch the last inserted event id
                $sql='SELECT id FROM `Ev_events` WHERE  event_description=? AND event_name=? AND venue=? AND is_recurring=?';
                $querylastid=$db->prepare($sql);
                $values=[$eventDesc,$eventName,$venue,true];
                $querylastid->execute($values);
                $last_insert_id=$querylastid->fetch(PDO::FETCH_ASSOC)['id'];
                
                if($last_insert_id===null){
                    $db->rollBack();
                    array_push($message,"Failed to add Event, Please try again");
                }else{
                array_push($pattern_colname,'event_id');
                array_push($pattern_placeholder,":eventid");
                array_push($pattern_datavalue,$last_insert_id);
    
                //use the id to update event pattern table field event_id
                $patern_data=array_combine($pattern_placeholder,$pattern_datavalue);
                //build the query
                $InsertqueryEventpatern=$startInsertquery." `Ev_repeat_pattern`";
                $queryaddEventpattern=$InsertqueryEventpatern.' ('.implode(',',$pattern_colname).') VALUES('.implode(",",$pattern_placeholder).')';//query for event table alone.
                $insertEventpatern=$db->prepare($queryaddEventpattern);
                $resultpatern=$insertEventpatern->execute($patern_data);
                if($resultpatern!=1){
                    $db->rollBack();
                    array_push($message,"Failed to add Event, Please try again");
                }else{
                    $db->commit();
                array_push($message,"Event Added Successfully");
                $action_fail=false;
                }
                }
            }
            }else if((int)$rowcount['row']>0){
                array_push($message,'Event Already Exist');
            }  
        } 

 }

if($action_fail && !isset($jd->use_event_name)){
    //delete any flyer that has been uploaded for this event  fail
    $filedoc=$flyer_dir.$file_name;
    if(is_readable($filedoc) && is_writable($filedoc)){
        unlink($filedoc);
    }
}


if(!empty($message)){
    //set error session pertaining to add error page;
    $_SESSION['message']=$message;
    session_write_close();
}

 header('Location: ../../index.php?page=event&action=add-event');
 exit();
}
// echo password_hash("Undercover", PASSWORD_DEFAULT);
if(isset($_POST['event_search'])){
    $srcq=trim($_POST['event_search']);
    if(!empty($srcq)){
        header("Location: ../../index.php?page=event&q=".urlencode($srcq));
        exit();
    }
}
header('Location: ../../index.php?page=event');
exit();
