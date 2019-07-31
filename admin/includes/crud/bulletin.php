<?php
session_start();
use uploadHelperClass\UploadFile;
$message     = [];
if(isset($_SESSION['logged_in'])){
    $createdby = $_SESSION['logged_in'];
}
$action_fail = true;
//flyer location folder
$bulletin_dir = dirname(__DIR__, 3) . '/assets/uploads/bulletins/';
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

//ajax request this help to dynamically help guess the volume and issues base on the last update to selected bulletin
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'ajax_req') {
 $q = $_POST['req'];
 if (!empty($q) && $q >= 1) {
  $sql_col = "SELECT volume, MAX(issue) as issue FROM bulletin,(SELECT MAX(volume) as vol from bulletin WHERE bulletin_title_id=:bulletin) as tb WHERE bulletin_title_id=:bulletin AND volume=tb.vol";

  $res = $db->prepare($sql_col);
  $res->execute([":bulletin" => $q]);
  $json = json_encode($res->fetch(PDO::FETCH_ASSOC));
  print_r($json);
 }

 return;
}

//setup fresh bulletin
if (isset($_POST['bulletin_setup']) && empty($message)) {
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
 $title = trim($_POST['bulletin_title']);
 if (empty($title)) {
  array_push($message, "please enter bulletin title");
 }
 $freq = trim($_POST['pub_freq']);
 if (empty($freq)) {
  array_push($message, "please enter bulletin publishing frequency");
 }
 $publish = trim($_POST['publish']);
 if (empty($publish)) {
  array_push($message, "please specify how you publish");
 }
 $desc = trim($_POST['bulletin_description']);
 if (empty($desc)) {
  array_push($message, "please enter bulletin description");
 }
 $createdby = 1;

 if (empty($message)) {
  //check if bulletin exist in db
  $sql_count = "SELECT COUNT(*) as row FROM bulletin_title where title=:title AND publish=:pub AND `description`=:b_desc";
  $qry_count = $db->prepare($sql_count);
  $qry_count->execute([":title" => $title, ":pub" => $publish, ":b_desc" => $desc]);
  $count_bulletin = $qry_count->fetch(PDO::FETCH_ASSOC)['row'];
  if ($count_bulletin >= 1) {
   array_push($message, "Bulletin already exist");
  } else {
   //let add bulletin to db
   $col         = ['title', 'description', 'publish', 'pub_freq', "created_by"];
   $placeholder = [':title', ':bulletin_desc', ':pub', ':pub_freq', ":user"];
   $value       = [$title, $desc, $publish, $freq, $createdby];

   $sql_bulletin = "INSERT INTO bulletin_title (" . implode(",", $col) . ") VALUES(" . implode(",", $placeholder) . ")";
   $qry          = $db->prepare($sql_bulletin);
   if ($qry->execute(array_combine($placeholder, $value))) {
    array_push($message, "bulletin created successfully");
   } else {
    array_push($message, "Failed to add bulletin, please try again");
   }
  }

 }

}

//insert new issue item into bulletin

if (isset($_POST['add_to_bulletin']) && empty($message)) {

 $col_upd         = [];
 $placeholder_upd = [];
 $upd_value       = [];
 $bulletin_id     = (int) trim($_POST['bulletin_title']);
 $vol             = (int) trim($_POST['volume']);
 if (empty($vol)) {
  array_push($message, "Please specify the volume number");
 }
 $issue = (int) trim($_POST['issue']);
 if (empty($issue)) {
  array_push($message, "Please specify the issue number");
 }

 $publish = trim($_POST['publish']);
 $until   = trim($_POST['until']);
 switch ($publish) {
  case 'now':
   $publish_on = date('Y-m-d');
   array_push($col_upd, "publish_date");
   array_push($placeholder_upd, ":publish_date");
   array_push($upd_value, $publish_on);
   break;
  case 'until':

   $publish_on = trim($_POST['until']);
   if (empty($publish_on)) {
    array_push($message, "Please provide a publishing date");
   } else {
    array_push($col_upd, "publish_status", "publish_date");
    array_push($placeholder_upd, ":publish_status", ":publish_date");
    array_push($upd_value, $publish, $publish_on);
   }
   break;
  case 'later':
   array_push($col_upd, "publish_status");
   array_push($placeholder_upd, ":publish_status");
   array_push($upd_value, $publish);
   break;
 }

 $keyword = trim($_POST['keyword']);
 if (empty($keyword)) {
  array_push($message, "Please specify atleast a keyword");
 }

 if (empty($message)) {
  //add other field to sql cahin
  array_push($col_upd, "volume", "issue", "keyword", "added_by", "bulletin_title_id");
  array_push($placeholder_upd, ":vol", ":issue", ":keyword", ":user", ":bulletin_id");
  array_push($upd_value, $vol, $issue, $keyword, $createdby, $bulletin_id);

  //check if bulletin id supply exist
  $sql_b_count = "SELECT COUNT(*) as row FROM bulletin_title WHERE title_id=?";
  $qry_b_count = $db->prepare($sql_b_count);
  $qry_b_count->execute([$bulletin_id]);
  $res = (int) $qry_b_count->fetch(PDO::FETCH_ASSOC)['row'];
  if ($res === 0) {
   array_push($message, "Bulletin Does not exist");
  }else if($res===1){
    //try to create bulletins folder only if the bulletin update exist
    if (!file_exists($bulletin_dir)) {
        if (!mkdir($bulletin_dir, 0777, true)) {
            array_push($message, "Permission error:trinity could not create a new folder");
        }
    } //create folder /bulletins
  }

  if (empty($message)) {
      //check if bulletin update already exist
      //check if bulletin id supply exist
   $sql_upd_count = "SELECT COUNT(*) as row FROM bulletin WHERE bulletin_id=? AND volume=? AND issue=?";
   $qry_upd_count = $db->prepare($sql_upd_count);
   $qry_upd_count->execute([$bulletin_id, $vol, $issue]);
   $res = (int) $qry_upd_count->fetch(PDO::FETCH_ASSOC)['row'];
   if ($res >= 1) {
    array_push($message, "This Edition of bulletin already Exist");
   } else {

    $bulletin_file     = $_FILES['bulletin_file'];
    $getID3            = new getID3; // Initialize getID3 engine
    $bulletin_filetype = "application";

    if (is_uploaded_file($bulletin_file['tmp_name'])) {
     //add bulletin file
     $sql_b = "SELECT title FROM bulletin_title WHERE title_id=?";
     $qry_b = $db->prepare($sql_b);
     $qry_b->execute([$bulletin_id]);
     $bulletin_title = (String) $qry_b->fetch(PDO::FETCH_ASSOC)['title'];

     $fileNewname       = $bulletin_title . "_vol_" . $vol . "_issue_" . $issue;
     $allow_b_doc       = UploadFile::gethAllowfileType($bulletin_filetype);

     $format            = $getID3->analyze($bulletin_file['tmp_name'])['fileformat'];

     $max_bulletin_size = UploadFile::convertToBytes("50M");
     $hashNewname=false;

     if (in_array($format, $allow_b_doc)) {
        $res = uploadFile($bulletin_file, $bulletin_dir, $fileNewname, $hashNewname, ['fileType' => $bulletin_filetype, 'fileSize' => $max_bulletin_size]);
        $msg = $res['message'];
        if (empty($msg)) {
            array_push($col_upd, "bulletin_file");
            array_push($placeholder_upd, ":bulletin_file");
            array_push($upd_value, $res['hash']);
        } else {
            if (is_array($msg) && !empty($msg)) {
                foreach ($msg as $key => $value) {
                    array_push($message, $value);
                }
            }
        }
     }else{
      array_push($message, "Bulletin must be " . implode(",", $format) . " filetype");
     }
    } else {
        array_push($message, "Please specify the Bulletin file");
    }

    
    if(empty($message)){
      //add the bulletin to db
      print_r($col_upd);
      print_r($placeholder_upd);
      print_r($upd_value);
      $upd_combine=array_combine($placeholder_upd,$upd_value);
      $sql_upd="INSERT INTO bulletin (".implode(",",$col_upd).") VALUE(".implode(",",$placeholder_upd).")";
      $qry_upd=$db->prepare($sql_upd);
     if($qry_upd->execute($upd_combine)){
         $action_fail=false;
         array_push($message,$bulletin_title." Volume ".$vol." Issue ".$issue.", has been added successfully.");
     }else{
        array_push($message,"Update not added, please try again");

     }
      
    }
   }
  }

 
 }




 if ($action_fail) {
    //delete any file that has been uploaded 
    
    if (!empty($bulletin_file['tmp_name'])) {
        $bulletin = $bulletin_dir.$upd_combine[':bulletin_file'];

        if (is_readable($bulletin) && is_writable($bulletin)) {
            unlink($bulletin); //delete bulletin file         
        }

    }

}
}

//manage bulletin

if(isset($_POST['manage_bulletin']) && empty($message)){
    // print_r($_SESSION['buid']);
    $uid=(int) $_POST['bulletin_list'];
    if(is_numeric($uid)){
        $_SESSION['buid']=$uid;
    }
    header("Location: ../../index.php?page=bulletin&action=manage-bulletin");
    exit;
    // print_r($message);
    // print_r($_POST);
    // print_r($_SESSION['buid']);
}

//search bulletin by keyword and buid session
if(isset($_POST["bulletin_search"]) && empty($message)){
    $srcq = trim($_POST['bulletin_search']);
    if (!empty($srcq)) {
        header("Location: ../../index.php?page=bulletin&action=manage-bulletin&q=" . urlencode($srcq));
        exit();
    }
}

//control the publishing of existing bulletin
if(isset($_POST['pub_bulletin-btn']) && empty($message)){
    print_r($_POST);
    if(isset($_SESSION['buid'])){ 
    $uid=$_SESSION['buid'];
    $pub=(String) strtolower(trim($_POST['publish_bulletin']));
    $sql_publish="UPDATE `bulletin_title` SET `publish_status` =?, date_published=NOW() WHERE `bulletin_title`.`title_id` = ?";
    $qry_publish=$db->prepare($sql_publish);

    if($pub==='yes'){
        if($qry_publish->execute(['published',$uid])){
            array_push($message,"Bulletin has been published successfully");
        }else{
            array_push($message,"Could'nt publish right now, please  try again");
        }
    }
    if($pub==='unpublish'){
        if($qry_publish->execute(['pending',$uid])){
            array_push($message,"Bulletin has been successfully withdrawn");
        }else{
            array_push($message,"Could'nt unpublish bulletin right now, please  try again");
        }
    }
}
}


if (!empty($message)) {
 $_SESSION['message'] = $message;
}

if (isset($_POST['bulletin_setup'])) {
 header("Location: ../../index.php?page=bulletin&action=add-bulletin&newbulletin");
 exit;
}

if (isset($_POST['add_to_bulletin'])) {
 header("Location: ../../index.php?page=bulletin&action=add-bulletin");
 exit;
}

header("Location: ../../index.php?page=bulletin");
exit;