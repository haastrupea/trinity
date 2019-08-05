<?php
require_once "admin/includes/dbcons.php";
$image_dir ='assets/uploads/images/';

 if($db){
// echo $image_dir;
	$sql_chk="SELECT * FROM church_info LIMIT 1 OFFSET 0";
    $qry_chk=$db->query($sql_chk);
    $church_info=$qry_chk->fetch(PDO::FETCH_ASSOC);


    $sql_his="SELECT * FROM church_history";
    if(isset($church_info['id'])){
        $sql_his.=" where church_id=".$church_info['id'];
    }
    $sql_his.=" LIMIT 1 OFFSET 0";
    $qry_his=$db->query($sql_his);
    $ch_his=$qry_his->fetch(PDO::FETCH_ASSOC);

    $sql_pst="SELECT * FROM church_pastor";
    $qry_pst=$db->query($sql_pst);
    $church_pst=$qry_pst->fetch(PDO::FETCH_ASSOC);

    $sql_picture="SELECT * FROM picture_gallery LIMIT 1 OFFSET 0";
    $qry_picture=$db->query($sql_picture);
    $picture=$qry_picture->fetch(PDO::FETCH_ASSOC);

    //church info
    $logo=$image_dir.$picture['logo'];
    $ch_name=$church_info['ch_name'];
    //church contact
    $ch_addr=$church_info['ch_address'];
    $ch_mail=$church_info['ch_email'];
    $ch_phn1=$church_info['ch_phone_1'];
    $ch_phn2=$church_info['ch_phone_2'];
    $ch_phn3=$church_info['ch_phone_3'];
    $ch_phn4=$church_info['ch_phone_4'];
    $ch_post_office=$church_info['ch_post_office'];
    $ch_pob=$church_info['ch_box_number'];
    $ch_fx=$church_info['ch_fax'];
    //church soscial media
    $ch_fb=$church_info['ch_fb_pg'];
    $ch_tw=$church_info['ch_twitter'];
    $ch_ig=$church_info['ch_instagram'];
    $ch_ytube=$ch_his['video_doc'];
    //church biography
    $ch_mission=$ch_his['mission'];
    $ch_vision=$ch_his['vision'];
    $ch_history=$ch_his['church_History'];
    $ch_date=$ch_his['founding_date'];
    //pastor info
    $pst_pic=$image_dir.$church_pst['picture'];
    $Pst_lname=$church_pst['lastname'];
    $Pst_mname=$church_pst['middlename'];
    $Pst_fname=$church_pst['firstname'];
    $Pst_title=$church_pst['title'];
    $Pst_fb=$church_pst['fb_page'];
    $Pst_twitter=$church_pst['twitter_page'];
    $Pst_twitter=$church_pst['twitter_page'];
    $Pst_abt=$church_pst['about'];
    $pst_post= $church_pst['is_founder']? 'Founder': 
    $welcome_addr=$church_pst['welcome_address'];
    $pst_abbr_fullname=strtoupper(substr($Pst_fname,0,1)).".".strtoupper(substr($Pst_mname,0,1))." ".strtoupper(substr($Pst_lname,0,1)).substr($Pst_lname,1);

    $pst_abbr_title_fullname= strtoupper(substr($Pst_title,0,1)).substr($Pst_title,1)." ".strtoupper(substr($Pst_fname,0,1)).".".strtoupper(substr($Pst_mname,0,1))." ".strtoupper(substr($Pst_lname,0,1)).substr($Pst_lname,1);

    $pst_fullname=strtoupper(substr($Pst_fname,0,1)).substr($Pst_fname,1)." ".strtoupper(substr($Pst_mname,0,1)).substr($Pst_mname,1)." ".strtoupper(substr($Pst_lname,0,1)).substr($Pst_lname,1);

    $pst_title_fullname=strtoupper(substr($Pst_title,0,1)).substr($Pst_title,1)." ".strtoupper(substr($Pst_fname,0,1)).substr($Pst_fname,1)." ".strtoupper(substr($Pst_mname,0,1)).substr($Pst_mname,1)." ".strtoupper(substr($Pst_lname,0,1)).substr($Pst_lname,1);
    

 }