<?php
session_start();
if (isset($_SESSION['logged_in']) && isset($_SESSION['active_user'])) {
    if (isset($_GET['a']) && $_GET['a'] === 'out') {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }

    } else {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/fontawesome-free-5.3.1-web/css/all.min.css">
    <title>Church Management System:Login</title>
    <style>
        .log-cont {
            background-color: white;
        }

        .log-cont .stage {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1)
        }

        .rec-msg {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="log-cont container">
        <div class="row justify-content-center">
            <div class="col-md-12 p-2 my-5">
                <h2 class="text-center text-uppercase">Admin Login</h2>

            </div>
            <?php
if (isset($_SESSION['message'])):
    foreach ($_SESSION['message'] as $key => $value):
    ?>
            <div id="msg-alert" class="mt-2 alert fs-animated <?php if (strpos(strtolower($value), "successfully")) {
        echo 'alert-success  rubberBand';
    } else {
        echo 'alert-danger shake';
    }
    ?>  col-md-8 text-center">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="fa fa-info-circle fa-2x mr-md-2"></span>
                    <span>
                        <?php echo $value ?>
                    </span>
                    <div class="dismiss fa fa-times fa-2x" onclick="cleared()">

                    </div>
                </div>

            </div>

            <?php
endforeach;
unset($_SESSION['message']);
endif;
?>
            <div class=" col-md-6">
                <form action="includes/crud/lgp.php" method="POST" name="login_form"
                    class="form-row justify-content-center border p-5 stage">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="admin_name" class="form-control"
                                placeholder="Enter Username or Email">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" placeholder="Enter password" name="admin_psw"
                                min="10">
                        </div>
                        <div class="form-group text-left">
                            <a href="login.php?psw=recovery">forgot password?</a>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-sm" name="login_btn">Login</button>
                        </div>
                    </div>

                </form>




                <?php //password reset form ?>

                <!-- <form action="" method="POST" name="reset-pwd-form" class="form-row justify-content-center border p-5">
                 <div class="col-md-8">
                     <div>
                     <h4 class="my-3 text-center pass-rec">
                         Password Recovery
                     </h4>
                     <form action="" method="post">
                         <div class="form-group">
                           <div class="nm"><input type="text" class="form-control" placeholder="Enter your Email"><button class="btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i></button></div>
                         </div>
                     </form>
                     <div class="my-5 text-center rec-msg">
                       <p>password recovry link will be send to your mail</p>
                     </div>
                     </div>
                 </div>

                 </form>




                 <div class="text-center col-md-12">
                      <h3 class="my-4"><i class="text-success fas fa-check"></i><i>You have Successfully Reset your password</i></h3>
                      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere architecto aspernatur dicta odit nam a quaerat officia dolor non ipsam?</p>
                      <div class="d-flex">
                      <button class="btn btn-primary btn-sm">Login  <i class="fas fa-arrow-right"></i></button>
                      </div>

                 </div>



                 <div class="text-center col-md-12">
                      <h3 class="my-4"><i class="text-danger fas fa-user-alt-slash"></i><i>Failed to Reset Password</i></h3>
                      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere architecto aspernatur dicta odit nam a quaerat officia dolor non ipsam?</p>
                      <div class="d-flex">
                      <button class="btn btn-primary btn-sm">Return  <i class="fas fa-arrow-left"></i></button>
                      </div>

                 </div> -->


            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>

</html>