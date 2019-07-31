<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Bulletin</title>
<?php include_once("includes/css.import.php"); ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/carousel.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/admin.css">
</head>
<body>
<section>
    <nav class="fixed-top">
            <a href="#"><img src="images/churchlook.jpg" height="100" width="100">Hello, Michael</a>
            <ul>
           <li>
            <a href="#">lorem</a>
           </li>
           <li>
            <a href="#">ipsum</a>
           </li>
           <li>
            <a href="#">Geni</a>
           </li>
           <li>
           
           </li>
           <li>
            <a href="#"></a>
           </li>
       </ul>
       <ul class="nav-icons">
       <li><span class="text-white fas fa-envelope-square fa-2x"></span><span class="badge-danger">5</span></span></li>
       <li><span class="text-white fas fa-outdent fa-2x"></span><span class="badge-danger">10</span></li>
</ul>
</nav>
</section>
</section>
    <section class="admin-Dashboard">
    <div class="admin-container">
        <div class="side-bar">
        <div class="title-sidenav"><p> Admin Area</p></div>
        <div class="action-menu">
        <ul>
                        <li><a href="admin.php"target="_parent">Home page</a></li>
                        <li><a href="admin-event.php" target="_parent">Event Page</a></li>
                        <li><a href="admin-bulletin.php" target="_parent">Bulletin Page</a></li>
                        <li><a href="admin-contact.php" target="_parent">Contact Us</a></li>
                        <li><a href="admin-sermon.php" target="_parent">Sermon Page</a></li>
                        <li><a href="admin-about.php" target="_parent">About Us</a></li>
</ul> 
        </div>
        </div>
        <div class="admin-workspace">
            <div class="container-fluid">
                <div class="row">
                <div class="first-form col-md-6 d-flex align-items-stretch  grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      
                      <h4 class="card-title">Default form</h4><p class="card-description">
                        Basic form layout
                      </p>
                      <form class="forms-sample">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Horizontal Form</h4>
                      <p class="card-description">
                        Horizontal form layout
                      </p>
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </div>
        </div>
    </div>
    </div>
    </section>

    <footer class="fixed-bottom">
        <div class="bg-dark row">
            <div class="col-md-12 text-center">
                <p class="text-white">Copyright &copy;
                    <?php echo date("Y") ?> All rights reserved | Gods Church <i class="icon-heart"
                        aria-hidden="true"></i>
                    by <a href="#" target="_blank">wikytek</a> </p>
            </div>
        </div>
    </footer>
</body>
</html>