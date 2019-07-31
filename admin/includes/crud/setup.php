<?php
session_start();
use uploadHelperClass\UploadFile;
$message = [];
if (isset($_SESSION['logged_in'])) {
 $createdby = $_SESSION['logged_in'];
}

$action_fail = true;
//loc location folder
$image_dir = dirname(__DIR__, 3) . '/assets/uploads/images/';
// $f_pic_dir = $image_dir."founder/";
try {
 include_once "../dbcons.php";
 require_once '../../includes/classes/UploadFile.php';
 if (!file_exists('../../vendor/autoload.php')) {

  array_push($message, 'Composer: Missing dependencies ');

 } else {
  require_once '../../vendor/autoload.php';
 }

 require_once '../fn.php';
} catch (Exception $e) {
 // $message=$e->getMessage();
 // echo $e->getMessage();
}
if (!$db) {
 $message[] = "Database error:try again later";
}

if (!file_exists($image_dir)) {
 if (!mkdir($image_dir, 0777, true)) {
  array_push($message, "Permission error:trinity could not create a new folder");
 }
} //create folder /bulletins

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if (isset($_POST['save_ch_info']) && empty($message)) {

 $ch_name = trim($_POST['church_name']);
 if (empty($ch_name)) {
  array_push($message, "Church name can not be blank");
 }
 $ch_addr = trim($_POST['church_addr']);
 if (empty($ch_addr)) {
  array_push($message, "Church address can not be blank");
 }
 $ch_email = trim($_POST['church_email']);
 if (empty($ch_email)) {
  array_push($message, "Church email can not be blank");
 }
 $ch_phn_1 = (int) trim($_POST['ch_phone_1']);
 if (empty($ch_phn_1)) {
  array_push($message, "Please Enter Atleast 1 phone number");
 }
 if (!is_numeric($ch_phn_1)) {
  array_push($message, "Phone number 1 must be a number");
 }
 if (isset($_POST['ch_phone_2'])) {
  $ch_phn_2 = (int) trim($_POST['ch_phone_2']);

  if (!is_numeric($ch_phn_2)) {
   array_push($message, "Phone number 2 must be a number");
  }
 }
 if (isset($_POST['ch_phone_3'])) {
  $ch_phn_3 = (int) trim($_POST['ch_phone_3']);
  if (!is_numeric($ch_phn_3)) {
   array_push($message, "Phone number 3 must be a number");
  }
 }
 if (isset($_POST['ch_phone_4'])) {
  $ch_phn_4 = (int) trim($_POST['ch_phone_4']);
  if (!is_numeric($ch_phn_4)) {
   array_push($message, "Phone number 4 must be a number");
  }
 }
 $ch_bx_num      = trim($_POST['church_box_number']);
 $ch_post_office = trim($_POST['church_post_office']);
 $ch_fax         = trim($_POST['church_fax']);
 $ch_fb_pg       = trim($_POST['church_fb_page']);
 $ch_tw_handle   = trim($_POST['church_tw_handle']);
 $ch_ig_handle   = trim($_POST['church_ig_handle']);

 if (empty($message)) {

  $sql_chk = "SELECT * FROM church_info LIMIT 1 OFFSET 0";

  $qry_chk         = $db->query($sql_chk);
  $rows            = $qry_chk->fetch(PDO::FETCH_ASSOC);
  $sql_update      = "UPDATE church_info SET";
  $sql_insert      = "INSERT INTO church_info ";
  $col_placeholder = [];
  $col_name        = [];
  $col_values      = [];
  if ($rows['ch_name'] != $ch_name) {
   $sql_update .= " ch_name=:ch_name,";
   array_push($col_values, $ch_name);
   array_push($col_placeholder, ':ch_name');
   array_push($col_name, 'ch_name');
  }

  if ($rows['ch_address'] != $ch_addr) {
   $sql_update .= " ch_address=:ch_addr,";
   array_push($col_values, $ch_addr);
   array_push($col_placeholder, ':ch_addr');
   array_push($col_name, 'ch_address');
  }

  if ($rows['ch_email'] != $ch_email) {
   $sql_update .= " ch_email=:ch_mail,";
   array_push($col_values, $ch_email);
   array_push($col_placeholder, ':ch_mail');
   array_push($col_name, 'ch_email');
  }
  if ($rows['ch_phone_1'] != $ch_phn_1) {
   $sql_update .= " ch_phone_1=:ch_phn1,";
   array_push($col_values, $ch_phn_1);
   array_push($col_placeholder, ':ch_phn1');
   array_push($col_name, 'ch_phone_1');
  }
  if (isset($ch_phn_2) && $rows['ch_phone_2'] != $ch_phn_2) {
   $sql_update .= " ch_phone_2=:ch_phn2,";
   array_push($col_values, $ch_phn_2);
   array_push($col_placeholder, ':ch_phn2');
   array_push($col_name, 'ch_phone_2');
  }
  if (isset($ch_phn_3) && $rows['ch_phone_3'] != $ch_phn_3) {
   $sql_update .= " ch_phone_3=:ch_phn3,";
   array_push($col_values, $ch_phn_3);
   array_push($col_placeholder, ':ch_phn3');
   array_push($col_name, 'ch_phone_3');
  }
  if (isset($ch_phn_4) && $rows['ch_phone_4'] != $ch_phn_4) {
   $sql_update .= " ch_phone_4=:ch_phn4,";
   array_push($col_values, $ch_phn_4);
   array_push($col_placeholder, ':ch_phn4');
   array_push($col_name, 'ch_phone_4');
  }
  if ($rows['ch_box_number'] != $ch_bx_num) {
   $sql_update .= " ch_box_number=:ch_bx_num,";
   array_push($col_values, $ch_bx_num);
   array_push($col_placeholder, ':ch_bx_num');
   array_push($col_name, 'ch_box_number');
  }
  if ($rows['ch_post_office'] != $ch_post_office) {
   $sql_update .= " ch_post_office=:ch_post_office,";
   array_push($col_values, $ch_post_office);
   array_push($col_placeholder, ':ch_post_office');
   array_push($col_name, 'ch_post_office');
  }
  if ($rows['ch_fax'] != $ch_fax) {
   $sql_update .= " ch_fax=:ch_fax,";
   array_push($col_values, $ch_fax);
   array_push($col_placeholder, ':ch_fax');
   array_push($col_name, 'ch_fax');
  }
  if ($rows['ch_fb_pg'] != $ch_fb_pg) {
   $sql_update .= " ch_fb_pg=:ch_fb,";
   array_push($col_values, $ch_fb_pg);
   array_push($col_placeholder, ':ch_fb');
   array_push($col_name, 'ch_fb_pg');
  }
  if ($rows['ch_twitter'] != $ch_tw_handle) {
   $sql_update .= " ch_twitter=:ch_tweet,";
   array_push($col_values, $ch_tw_handle);
   array_push($col_placeholder, ':ch_tweet');
   array_push($col_name, 'ch_twitter');
  }
  if ($rows['ch_instagram'] != $ch_ig_handle) {
   $sql_update .= " ch_instagram=:ch_ig,";
   array_push($col_values, $ch_ig_handle);
   array_push($col_placeholder, ':ch_ig');
   array_push($col_name, 'ch_instagram');
  }

  $upd        = array_combine($col_placeholder, $col_values);
  $sql_select = "SELECT COUNT(*) AS row FROM church_info";
  $qry        = $db->query($sql_select);
  $row        = (int) $qry->fetch(PDO::FETCH_ASSOC)['row'];

  if (!empty($upd)) {
   $sql_update = substr($sql_update, 0, strlen($sql_update) - 1); //remove any trailing comma
   $sql_insert .= "(" . implode(", ", $col_name) . ") VALUES(" . implode(", ", $col_placeholder) . " )";
   if ($row >= 1) {
    $qry_chnge = $db->prepare($sql_update);
   } else {
    $qry_chnge = $db->prepare($sql_insert);
   }
   if ($qry_chnge->execute($upd)) {
    array_push($message, 'Changes saved successfully');
   } else {
    array_push($message, 'Something went wrong, please try again');
   }
  }

 }

}

if (isset($_POST['save_history']) && empty($message)) {
 //verfiy user input
 $ch = (int) trim($_POST['church']);

 $sql_his = "SELECT * FROM church_history where church_id=? LIMIT 1 OFFSET 0";
 $qry_his = $db->prepare($sql_his);
 $qry_his->execute([$ch]);
 $church_his = $qry_his->fetch(PDO::FETCH_ASSOC);

 $sql_h_chk = "SELECT Count(*) as row FROM church_info where id=? LIMIT 1 OFFSET 0";
 $qry_h_chk = $db->prepare($sql_h_chk);
 $qry_h_chk->execute([$ch]);
 $church_chk = $qry_h_chk->fetch(PDO::FETCH_ASSOC)['row'];
 if (empty($church_chk)) {
  array_push($message, "Please add Church information first");
 }

 $f_date = trim($_POST['founding_date']);
 if (empty($f_date)) {
  array_push($message, "Founding date can not be empty");
 }

 //optional fields
 $ch_doc_video = trim($_POST['y_link']);
 $ch_his       = trim($_POST['about_church']);

 if (empty($message)) {
  $sql_his_upd     = "UPDATE church_history SET ";
  $sql_his_ins     = "INSERT INTO church_history ";
  $col_placeholder = [];
  $col_name        = [];
  $col_values      = [];

  if ($church_his['church_id'] != $ch) {
   $sql_his_upd .= " church_id=:ch_id,";
   array_push($col_values, $ch);
  array_push($col_placeholder, ':ch_id');
  array_push($col_name, 'church_id');
  }
  if ($church_his['founding_date'] != $f_date) {
   $sql_his_upd .= " founding_date=:ch_date,";
   array_push($col_values, $f_date);
   array_push($col_placeholder, ':ch_date');
   array_push($col_name, 'founding_date');
  }

  if ($church_his['church_History'] != $ch_his) {
   $sql_his_upd .= " church_History=:ch_his,";
   array_push($col_values, $ch_his);
   array_push($col_placeholder, ':ch_his');
   array_push($col_name, 'church_History');
  }
  if ($church_his['video_doc'] != $ch_doc_video) {
   $sql_his_upd .= " video_doc=:ch_v_doc,";
   array_push($col_values, $ch_doc_video);
   array_push($col_placeholder, ':ch_v_doc');
   array_push($col_name, 'video_doc');
  }

  //update or insert user changes to church history into db
  $upd = array_combine($col_placeholder, $col_values);
  if (!empty($upd)) {
   $sql_his_upd = substr($sql_his_upd, 0, strlen($sql_his_upd) - 1); //remove any trailing comma
   $sql_his_ins .= "(" . implode(", ", $col_name) . ") VALUES(" . implode(", ", $col_placeholder) . " )";
   if (!empty($church_his)) {
    $qry_chng = $db->prepare($sql_his_upd);
   } else {
    $qry_chng = $db->prepare($sql_his_ins);
   }

   if ($qry_chng->execute($upd)) {
    array_push($message, 'Changes saved successfully');
   } else {
    array_push($message, 'Something went wrong, please try again');
   }
  }

 }
}



if (isset($_POST['save_pst_ic']) && empty($message)) {

 $sql_pst="SELECT * FROM church_pastor";
 $qry_pst=$db->query($sql_pst);
 $pst=$qry_pst->fetch(PDO::FETCH_ASSOC);

 $pst_title = trim($_POST['title']);
 if (empty($pst_title)) {
  array_push($message, "Please provide founder's title");
 }

 $pst_fname = trim($_POST['firstname']);
 if (empty($pst_fname)) {
  array_push($message, "Please provide founder's firstname");
 }

 $pst_lname = trim($_POST['lastname']);
 if (empty($pst_lname)) {
  array_push($message, "Please provide founder's lastname");
 }
 //optional field
 $pst_mname     = trim($_POST['middlename']);
 $pst_gender     = trim($_POST['pst_gender']);
 $abt_pst = trim($_POST['about_Pastor']);
 $wlm_addr = trim($_POST['pst_wlcm_address']);
 $fb_pst = trim($_POST['fb']);
 $ig_pst = trim($_POST['ig']);
 $twitter_pst = trim($_POST['twitter']);
 $founder   = isset($_POST['pst_is_founder'])?true:false;

 $pst_pic_upload = $_FILES['pst_picture'];
 $getID3 = new getID3;
 if (is_uploaded_file($pst_pic_upload['tmp_name'])) {
  $max_size    = UploadFile::convertToBytes("5m");
  $filetype    = "image";
  $hashNewname = false;
  $fileNewname = $pst_title . "_" . strtoupper(substr($pst_fname, 0, 1)) . ".";
  if (!empty($pst_mname)) {
   $fileNewname .= strtoupper(substr($pst_mname, 0, 1));
  }
  $fileNewname .= "_" . $pst_lname;

  $format   = $getID3->analyze($pst_pic_upload['tmp_name'])['fileformat'];
  $allowImg = UploadFile::gethAllowfileType($filetype);
  if (in_array($format, $allowImg)) {
   $res = uploadFile($pst_pic_upload, $image_dir, $fileNewname, $hashNewname, ['fileType' => $filetype, 'fileSize' => $max_size]);
   $msg = $res['message'];
   if (empty($msg)) {
    $pst_pic = $res['hash'];
   } else {
    if (is_array($msg) && !empty($msg)) {
     foreach ($msg as $key => $value) {
      array_push($message, $value);
     }
    }
   }
  } else {
   array_push($message, "Founder image must be " . implode(",", $format) . " filetype");
  }
 }

 $col_name        = [];
 $col_placeholder = [];
 $col_values      = [];
 $sql_pst_upd     = "UPDATE church_pastor SET ";
 $sql_pst_ins     = "INSERT INTO church_pastor ";

 if ($pst['title'] != $pst_title) {
  $sql_pst_upd .= " title=:pst_title,";
  array_push($col_values, $pst_title);
  array_push($col_placeholder, ':pst_title');
  array_push($col_name, 'title');
 }
 if ($pst['firstname'] != $pst_fname) {
  $sql_pst_upd .= " firstname=:pst_fname,";
  array_push($col_values, $pst_fname);
  array_push($col_placeholder, ':pst_fname');
  array_push($col_name, 'firstname');
 }
 if (!empty($pst_mname) && $pst['middlename'] != $pst_mname) {
  $sql_pst_upd .= " middlename=:pst_mname,";
  array_push($col_values, $pst_mname);
  array_push($col_placeholder, ':pst_mname');
  array_push($col_name, 'middlename');
 }
 if ($pst['lastname'] != $pst_lname) {
  $sql_pst_upd .= " lastname=:pst_lname,";
  array_push($col_values, $pst_lname);
  array_push($col_placeholder, ':pst_lname');
  array_push($col_name, 'lastname');
 }
 if ($pst['gender'] != $pst_gender) {
  $sql_pst_upd .= " gender=:pst_gender,";
  array_push($col_values, $pst_gender);
  array_push($col_placeholder, ':pst_gender');
  array_push($col_name, 'gender');
 }

 if (isset($pst_pic) && $pst['picture'] != $pst_pic) {
  $sql_pst_upd .= " picture=:pst_pic,";
  array_push($col_values, $pst_pic);
  array_push($col_placeholder, ':pst_pic');
  array_push($col_name, 'picture');

  if (!empty($pst_pic)) {
   $img_pst_old = $image_dir . $pst['picture'];
   if (is_readable($img_pst_old) && is_writable($img_pst_old)) {
    unlink($img_pst_old);
   }
  }
 }
 if ($pst['about'] != $abt_pst) {
  $sql_pst_upd .= " about=:abt_pst,";
  array_push($col_values, $abt_pst);
  array_push($col_placeholder, ':abt_pst');
  array_push($col_name, 'about');
 }
 if ($pst['welcome_address'] != $wlm_addr) {
  $sql_pst_upd .= " welcome_address=:wlm_addr,";
  array_push($col_values, $wlm_addr);
  array_push($col_placeholder, ':wlm_addr');
  array_push($col_name, 'welcome_address');
 }
 if ($pst['fb_page'] != $fb_pst) {
  $sql_pst_upd .= " fb_page=:fb_pst,";
  array_push($col_values, $fb_pst);
  array_push($col_placeholder, ':fb_pst');
  array_push($col_name, 'fb_page');
 }
 if ($pst['ig_page'] != $ig_pst) {
  $sql_pst_upd .= " ig_page=:ig_pst,";
  array_push($col_values, $ig_pst);
  array_push($col_placeholder, ':ig_pst');
  array_push($col_name, 'ig_page');
 }
 if ($pst['twitter_page'] != $twitter_pst) {
  $sql_pst_upd .= " twitter_page=:twitter_pst,";
  array_push($col_values, $twitter_pst);
  array_push($col_placeholder, ':twitter_pst');
  array_push($col_name, 'twitter_page');
 }
 if ($pst['is_founder'] != $founder) {
  $sql_pst_upd .= " is_founder=:founder,";
  array_push($col_values, $founder);
  array_push($col_placeholder, ':founder');
  array_push($col_name, 'is_founder');
 }

  //update or insert user changes to church history into db
  $upd = array_combine($col_placeholder, $col_values);


 if (!empty($upd) && empty($message) ) {

  $sql_pst_upd = substr($sql_pst_upd, 0, strlen($sql_pst_upd) - 1); //remove any trailing comma
  $sql_pst_ins .= "(" . implode(", ", $col_name) . ") VALUES(" . implode(", ", $col_placeholder) . " )";
  if (!empty($pst)) {
   $qry_chng = $db->prepare($sql_pst_upd);
  } else {
   $qry_chng = $db->prepare($sql_pst_ins);
  }

  if ($qry_chng->execute($upd)) {
   $action_fail = false;
   array_push($message, 'Changes saved successfully');
  } else {
   array_push($message, 'Something went wrong, please try again');
  }
  }

 if ($action_fail) {
  //delete any file that has been uploaded if process fail
  if (!empty($pst_pic_upload['tmp_name'])) {
   $img_pst = $image_dir . $upd[':pst_pic'];

   if (is_readable($img_pst) && is_writable($img_pst)) {
    unlink($img_pst);
   }

  }

 }
}


if(isset($_POST['save_logo_pic']) && empty($message)){
    $sql_picture="SELECT * FROM picture_gallery LIMIT 1 OFFSET 0";
    $qry_picture=$db->query($sql_picture);
    $picture=$qry_picture->fetch(PDO::FETCH_ASSOC);

    function church_pic(array $upd_pic,string $filename){
        global $message;
        global $image_dir;

        if(empty($upd_pic) || empty($filename)){
            return false;
        }
    
        if (is_uploaded_file($upd_pic['tmp_name'])) {
            $max_size    = UploadFile::convertToBytes("2m");
            $filetype    = "image";
            $hashNewname = false;
            $fileNewname = $filename; 
            $getID3 = new getID3;
            $format   = $getID3->analyze($upd_pic['tmp_name'])['fileformat'];
            $allowImg = UploadFile::gethAllowfileType($filetype);
            if (in_array($format, $allowImg)) {
             $res = uploadFile($upd_pic, $image_dir, $fileNewname, $hashNewname, ['fileType' => $filetype, 'fileSize' => $max_size]);
             $msg = $res['message'];
            
             if (empty($msg)) {
              return $res['hash'];//return file name
             } else {
              if (is_array($msg) && !empty($msg)) {
               foreach ($msg as $key => $value) {
                array_push($message, $value);
               }
              }
             }
            } else {
             array_push($message, $filename." image must be " . implode(",", $format) . " filetype");
            }
           }

           echo "<pre>";
           
    } 
    
    function rm_file(array $upd_pic,string $col_name){
        global $picture;
        global $image_dir;
        if (!empty($upd_pic['tmp_name'])) {
            $img_pst_old = $image_dir . $picture[$col_name];
            if (is_readable($img_pst_old) && is_writable($img_pst_old)) {
             unlink($img_pst_old);
            }
           }
    }
    $col_values=[];
    $col_placeholder=[];
    $col_name=[];
    $sql_pic_upd="UPDATE picture_gallery SET ";
    

    $logo=$_FILES['ch_logo'];
    if(!empty($logo)){
        $logo_new=church_pic($logo,"logo");
        if(!empty($logo_new) && $picture['logo']!=$logo_new){
            $sql_pic_upd.=' logo=:ch_logo,';
            array_push($col_values, $logo_new);
            array_push($col_placeholder, ':ch_logo');
            array_push($col_name, 'logo');
            rm_file($logo,"logo");
        }
        
    }

    $in_view=$_FILES['ch_in_view'];
    if(!empty($in_view) ){
        $in_view_new=church_pic($in_view,"inside view");
        if(!empty($in_view_new) && $picture['inside_view']!=$in_view_new){

            $sql_pic_upd.=' inside_view=:in_view,';
            array_push($col_values, $in_view_new);
            array_push($col_placeholder, ':in_view');
            array_push($col_name, 'inside_view');
            rm_file($in_view,"inside_view");

        }
    }

    $out_view=$_FILES['ch_out_view'];
    if(!empty($out_view) ){
        $out_view_new=church_pic($out_view,"outside view");
        if(!empty($out_view_new) && $picture['outside_view']!=$out_view_new){
            $sql_pic_upd.=' outside_view=:out_view,';
            array_push($col_values, $out_view_new);
            array_push($col_placeholder, ':out_view');
            array_push($col_name, 'outside_view');
            rm_file($out_view,"outside_view");
        }
    }
    
    $upd=array_combine($col_placeholder,$col_values);
  // print_r($upd);
    if(!empty($upd)){
        $db->beginTransaction();
        $sql_pic_in="INSERT  INTO picture_gallery (".implode(",",$col_name).") VALUES (".implode(",",$col_placeholder).")";
        
        $sql_pic_upd = substr($sql_pic_upd, 0, strlen($sql_pic_upd) - 1)." WHERE id=".$picture['id']; //remove any trailing comma
        if(empty($picture)){
            $execu=$db->prepare($sql_pic_in);
        }else{
            $execu=$db->prepare($sql_pic_upd);
        }
       if( $execu->execute($upd)){
           if(!empty($message)){
               foreach ($upd as $key => $value) {
                  if(!empty($value)){
                    array_push($message,substr($value,0,strpos($value,"."))." change updated successfully");
                    $db->commit();
                  }else{
                      $db->rollBack();
                      print_r("hi");
                  }
               }
            
           }else{
           array_push($message,"Change updated successfully");
           $db->commit();
           }
       }else{
        array_push($message,"Something went wrong, please try again");
       }
    }
}

if(isset($_POST['save_m_v'])){
    $ch = (int) trim($_POST['church']);

    $sql_his = "SELECT * FROM church_history where church_id=? LIMIT 1 OFFSET 0";
    $qry_his = $db->prepare($sql_his);
    $qry_his->execute([$ch]);
    $church_his = $qry_his->fetch(PDO::FETCH_ASSOC);
    if (empty($church_his)) {
     array_push($message, "Please add Church information first");
    }

    $ch_mission = trim($_POST['ch_mission']);
 if (empty($ch_mission)) {
  array_push($message, "Please enter your church mission statement");
 }

    $ch_vision = trim($_POST['ch_vision']);
 if (empty($ch_vision)) {
  array_push($message, "Please enter your church vision statement");
 }
    //optional field
    $ch_v_m_video = trim($_POST['ch_vs_ms_video']);

    

    if (empty($message)) {
        $sql_his_upd     = "UPDATE church_history SET ";
        $col_values      = [];
        $col_placeholder=[];    
        if ($church_his['mission'] != $ch_mission) {
         $sql_his_upd .= " mission=:ch_msn,";
         array_push($col_values, $ch_mission);
         array_push($col_placeholder, ':ch_msn');
        }
        if ($church_his['vision'] != $ch_vision) {
         $sql_his_upd .= " vision=:ch_vs,";
         array_push($col_values, $ch_vision);
         array_push($col_placeholder, ':ch_vs');
        }
        if ($church_his['vs_ms_youtube_link'] != $ch_v_m_video) {
         $sql_his_upd .= " vs_ms_youtube_link=:ch_youtube,";
         array_push($col_values, $ch_v_m_video);
         array_push($col_placeholder, ':ch_youtube');
        }

        if(!empty($col_values)){
         array_push($col_values, $ch);
         array_push($col_placeholder, ':ch_id');
        }

         //update user changes to church history into db
  $upd = array_combine($col_placeholder, $col_values);
  if (!empty($upd)) {
      $sql_his_upd = substr($sql_his_upd, 0, strlen($sql_his_upd) - 1); //remove any trailing comma
      $sql_his_upd.=" WHERE church_id=:ch_id";

   if (!empty($church_his)) {
    $qry_chng = $db->prepare($sql_his_upd);

    if ($qry_chng->execute($upd)) {
        array_push($message, 'Changes saved successfully');
       } else {
        array_push($message, 'Something went wrong, please try again');
       }
   }

  }
    }

    print_r($_POST);

}

if (!empty($message)) {
 $_SESSION['message'] = $message;
}

if (isset($_POST['save_ch_info'])) {
 header("Location: ../../index.php?page=setting&action=ch_info");
 exit;
}


if (isset($_POST['save_history'])) {
 header("Location: ../../index.php?page=setting&action=ch_history");
 exit;
}

if (isset($_POST['save_pst_ic'])) {
 header("Location: ../../index.php?page=setting&action=ch_pst");
 exit;
}

if(isset($_POST['save_logo_pic'])){
    header("Location: ../../index.php?page=setting&action=ch_logo_pic");
    exit;  
}
if(isset($_POST['save_m_v'])){
    header("Location: ../../index.php?page=setting&action=ch_mission_vision");
    exit;  
}

header("Location: ../../index.php?page=setting");
exit;
