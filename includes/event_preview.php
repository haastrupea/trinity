<?php
require_once "admin/includes/dbcons.php";
require_once "admin/includes/fn.php";
$image_dir ='assets/uploads/images/';
$upd_dir ='assets/uploads/';
if(!$db){
    return;
}

//get event featured events
    //automatic featuring
        //get two random events that fullfill the following critaria

        //no repeating that(startDate>now()) or enddate>now() where event=not repeat can be listed;
        //repeating event:forever=can be listed
        //repeating event that the untilldate+time is not greater than now can be listed
        //repeating event that the occuriesdate+time is not greater than now can be listed
    //maunal featuring
        //admin can feature events
    
    //exception from feature listing
        //non repeating: when enddate+time is <now()
        //repeat:untilldate+time <now()
        //repeat:occurdate+time <now()

        $sql2='SELECT Ev_events.id,event_name,start_time,end_time,venue,flyer_file_name,end_date,start_date,
        IF(Ev_events.is_recurring=0,Ev_events.start_date,IF(Ev_repeat_pattern.repeat_type=Ev_repeat_type.id,"hi","it is not daily event")) as startdate
        FROM `Ev_events` 
        LEFT JOIN Ev_repeat_pattern 
        ON Ev_repeat_pattern.event_id=Ev_events.id
        LEFT JOIN Ev_repeat_type
        ON Ev_repeat_type.id=Ev_repeat_pattern.repeat_type
        WHERE 
        NOT (TIMESTAMP(Ev_events.end_date)<CURRENT_TIMESTAMP()) or end_date IS NULL ORDER BY `Ev_events`.`end_date` DESC
        LIMIT 2 OFFSET 0';
        

//         SELECT Ev_events.is_recurring, Ev_repeat_pattern.occurencies,Ev_events.end_date,
//    CASE
//     WHEN Ev_repeat_pattern.repeat_type=1 THEN DATE_ADD(Ev_events.start_date, INTERVAL Ev_repeat_pattern.interval_sep MONTH)
//     WHEN Ev_repeat_pattern.repeat_type=2 THEN "The quantity is greater than 30"
//     WHEN Ev_repeat_pattern.repeat_type=3 THEN "The quantity is greater than 30"
//     WHEN Ev_repeat_pattern.repeat_type=4 THEN "The quantity is greater than 30"
//     ELSE "The quantity is under 30"
//    END as result
//         FROM `Ev_events` 
//         LEFT JOIN Ev_repeat_pattern 
//         ON Ev_repeat_pattern.event_id=Ev_events.id
//         LEFT JOIN Ev_repeat_type
//         ON Ev_repeat_type.id=Ev_repeat_pattern.repeat_type
//         WHERE 
//         NOT (TIMESTAMP(Ev_events.end_date)<CURRENT_TIMESTAMP()) or end_date IS NULL ORDER BY `Ev_events`.`end_date` DESC


$qry=$db->query($sql2);
$results=$qry->fetchAll(PDO::FETCH_ASSOC);