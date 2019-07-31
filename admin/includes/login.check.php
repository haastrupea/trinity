<?php
function logged_in(){
    if(isset($_SESSION['logged_in']) && isset($_SESSION['active_user'])){
        // $_SESSION['logged_in'];
        // $_SESSION['active_user'];
        if($_SESSION['logged_in']===$_SESSION['active_user']['usr_id']){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

if(!logged_in()){
header("Location:login.php");
exit;
}
