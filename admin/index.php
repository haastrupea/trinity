<?php
session_start();
require_once 'includes/login.check.php';
$page_enum = array("e" => "event", "b"=>"bulletin","s"=>"sermon","set"=>"setting","setting","sermon","event","bulletin");
isset($_GET["action"])?($action=strtolower($_GET['action'])):"do nothing";
$page=isset($_GET['page'])?strtolower($_GET['page']):"";
$_SESSION['image_size']=512*1024;
$_SESSION['sermon_size']=51200*1024;//50mb
$fromindex=true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>welcome-admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="../vendor/fontawesome-free-5.3.1-web/css/all.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/animate.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/font/admin-icon.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/admin-index.css">
</head>
    <body>
        <section>
            <div id="side-collapse" class="admin-wrp d-flex vh side-collapsed">
                <aside class="side-bar fullHeight">
                    <div class="icon-menu bg-dark">
                        <div class="actions-wrp row no-spacing">
                            <ul class="action-list col-12">
                                <li class="list-title">
                                    <p class="title d-flex">
                                        <span>Action&nbsp;panel</span>
                                        <span>MENU</span>
                                    </p>
                                </li>
                                <li class="action <?php if(!in_array($page,$page_enum))echo "active" ?>">
                                    <a href="index.php" title="Admin Home">
                                        <span class="wk wk-user-avatar-with-check-mark"></span></a></li>
                                <li class="action <?php if($page===$page_enum["e"])echo "active" ?>">
                                    <a title="Event" href="index.php?page=event">
                                        <span class="wk wk-event"></span></a></li>
                                <li class="action <?php if($page===$page_enum["s"])echo "active" ?>"><a title="Sermon" href="index.php?page=sermon"><span
                                            class="wk wk-sermon"></span></a></li>
                                <li class="action <?php if($page===$page_enum["b"])echo "active" ?>"><a title="Bulletin" href="index.php?page=bulletin"><span
                                            class="wk wk-newspaper"></span></a></li>
                                <li class="action <?php if($page===$page_enum["set"])echo "active" ?>"><a title="Settings" href="index.php?page=setting"><span class="fa fa-wrench"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-closed">
                        <ul class="action-content-list">
                            <li class="action-brand">
                                <div class="branded d-flex align-items-center justify-content-start">
                                    <span class="logo"></span>
                                    <span class="brand-text">God's <br><span>Church</span></span>
                                    <div class="menu-collapse">
                                        <span class="fa"></span>
                                    </div>
                                </div>
                            </li>
                            <li class="action-content">
                                <a href="index.php">
                                    <div class="action-manage d-flex  justify-content-start align-items-center <?php if(!in_array($page,$page_enum))echo "active"?>">
                                        <span class="icon fa fa-tachometer-alt"></span>
                                        <span>Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="index.php?page=event">
                                    <div class="action-manage d-flex  justify-content-start align-items-center <?php if($page===$page_enum["e"])echo "active" ?>">
                                        <span class="icon wk wk-event"></span>
                                        <span>Event</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="index.php?page=sermon">
                                    <div class="action-manage d-flex  justify-content-start align-items-center <?php if($page===$page_enum["s"])echo "active" ?>">
                                        <span class="icon wk wk-sermon"></span>
                                        <span>Sermon</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="index.php?page=bulletin">
                                    <div class="action-manage d-flex  justify-content-start align-items-center <?php if($page===$page_enum["b"])echo "active" ?>">
                                        <span class="icon wk wk-newspaper"></span>
                                        <span>Bulletin</span>
                                    </div>
                                </a>
                            </li>
                            <li class="action-content">
                                <a href="index.php?page=setting">
                                    <div class="action-manage d-flex  justify-content-start align-items-center <?php if($page===$page_enum["set"])echo "active" ?>">
                                        <span class="icon fa fa-wrench"></span>
                                        <span>Settings</span>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="developer">Developed By <a href="#">Wikytek</a>
                        </div>
                    </div>

                </aside>
                <article id="admin-canvas" class="admin-canvas fullHeight side-collapsed">
                <div class="container-fluid">
                    <div class="row bg-dark">
                        <div class="col-md-2 offset-md-10 py-2 text-right">
                            <a href="login.php?a=out" class="btn small btn-danger"><span class="fa fa-user"></span> Logout</a>
                        </div>
                    </div>
                </div>
                   <?php 
                switch ($page) {
                       case 'event':
                   include_once('includes/pages/event.php');
                        break;
                       case 'bulletin':
                   include_once('includes/pages/bulletin.php');         
                        break;
                       case 'sermon':
                   include_once('includes/pages/sermon.php');         
                        break;
                       case 'setting':
                   include_once('includes/pages/setup.php');         
                        break;
                       default:
                    include_once('includes/pages/dashboard.php'); 
                        break;
                }
                ?>
                </article>
            </div>
        </section>
        <script src="js/main.js"></script>
    </body>
</html>