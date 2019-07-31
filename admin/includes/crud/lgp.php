<?php
session_start();
try {
    include_once "../dbcons.php";
    require_once '../fn.php';
   } catch (Exception $e) {
    // $message=$e->getMessage();
    // echo $e->getMessage();
   }
$message     = [];
if (!$db) {
    $message[] = "Database error:try again later";
   }


if(isset($_POST['login_btn']) && empty($message)){
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $name=trim($_POST['admin_name']);
    if(empty($name)){
        array_push($message,"Please Enter username");
    }
    $psw=trim($_POST['admin_psw']);
    if(empty($psw)){
        array_push($message,"Please Enter Password");
    }

    if(empty($message)){
        // $hash_pass=password_hash($psw,PASSWORD_DEFAULT);
        $sql="SELECT * FROM `Admin` WHERE user_name=:adm_name OR user_email=:adm_name";

        $qry=$db->prepare($sql);

        if($qry->execute([":adm_name"=>$name])){
            $res=$qry->fetch(PDO::FETCH_ASSOC);
            $db_hash_pass=$res['user_password'];

             if(password_verify($psw,$db_hash_pass)){
                 $user=[];
                 $user['usr_id']=$res['user_id'];
                 $user['usr_name']=$res['user_name'];
                 $user['usr_email']=$res['user_email'];
                 $user['usr_role']=$res['role_id'];

                 $_SESSION['logged_in']=$res['user_id'];
                 $_SESSION['active_user']=$user; 
                 if(isset($_SESSION['login_trial'])){
                     unset($_SESSION['login_trial']);   
                 }
                 header("Location: ../../index.php");
                 exit;
             }else{
                 array_push($message,"Wrong Credencials");
                 $_SESSION['login_trial']=(int) isset($_SESSION['login_trial'])? ($_SESSION['login_trial']+1):1;
             }

        }
    }

if (!empty($message)) {
    $_SESSION['message'] = $message;
}


}
header("Location: ../../login.php");
exit;