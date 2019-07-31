<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Church-bulletin</title>
        <?php include_once("includes/css.import.php"); ?>
        <link rel="stylesheet" type="text/css" media="screen" href="css/bulletin.css">
    </head>

    <body>
        <?php include("includes/nav.php"); ?>
        <section>
            <div class="container-fluid no-spacing">
                <div class="bulletin-hero row d-flex justify-content-md-start align-items-md-center pl-md-4 justify-content-sm-center align-items-sm-end">
                    <div class="overlay-gradient"></div>
                    <div class="overlay-gradient"></div>

                    <div class="col-md-4 col-sm-10">
                        <div class="bulletin-content-text animate" data-effect="fadeInLeftBig">
                            <p class="contextTitle">MEMORIAL OF JESUS’ DEATH</p>
                            <h3 class="bulletin-title">
                                You Are Welcome to Attend!
                            </h3>
                            <div class="bulletin-description">
                                <div class="bodyTxt">
                                    <div id="section1" class="section">
                                        <div class="welcome-message">
                                            <p>We welcome you to attend our annual event to
                                                commemorate the death of Jesus Christ. This year it will be held on
                                                <strong>Friday, April&nbsp;19.</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="bulletin-button">
                                <span class="bulletin-button-icon" aria-hidden="true">

                                </span>
                                <span class="bulletin-button-Text">Learn More</span>
                            </a>
                        </div>


                    </div>
                </div>
        </section>
        <section class="bulletin-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="bulletin-section">
                            <div class="bulletin-control">
                               <form  class="form-row justify-content-center align-items-center" action="#" method="post">
                                   <div class="form-group col-4"><h5 class="mb-0 text-right">Bulletin For:</h5>
                                   </div>
                               
                                   <div class="form-group col-5">
                                       <select name="filter-bulletin" class="form-control">
                                       <option value="this month" selected>This month</option>
                                           <option value="0">January</option>
                                           <option value="1">February</option>
                                           <option value="2">March</option>
                                           <option value="3">April</option>
                                           <option value="4">May</option>
                                           <option value="5">June</option>
                                           <option value="6">July</option>
                                           <option value="7">August</option>
                                           <option value="8">September</option>
                                           <option value="9">October</option>
                                           <option value="10">November</option>
                                           <option value="11">December</option>
                                       </select>
                                   </div>
                                   <div class="form-group col-2">
                                       <button class="btn btn-info" name="submit-btn"><span class="fa fa-filter"></span></button>
                                   </div>
                               </form>
                               <div class="form-text text-center"><h5 id="bulletin-filter-result" class="alert alert-success"><span class="fa fa-info-circle text-success"></span> Found <span id="total-result">10 </span>Bulletins for Month of April</h5></div>
                            </div>
<div class="bulletin-wrapper">
    <ul class="bulletin">
    <?php 
    $bulNo=10;
    for ($i=0; $i < $bulNo; $i++): ?>
    <li class="d-flex p-1 animate bulletin-item alert alert-info" data-effect="fadeInLeft">
        <div class="icon my-auto px-2">
            <span class="fa fa-file-pdf fa-4x"></span>
        </div>
        <div class="bulletin-details">
            <h5 class="bulletin-title">Buletin title goes here.Vol. <?php echo $i+1 ?></h5>
            <p class="bulletin-desc">
                <small>
                <i class="publish-date">
                published:
                        <?php echo date("l,jS  F, Y")." ( ".date("g:i:s A T ").")" ?>
                    
                </i>
                <a href="#" class="btn-sm btn-info  text-dark px-1 float-right"><span class="fa fa-download"></span>
                    Download <span class="size">(3.6MB)</span></a>
                </small>
            </p>
        </div>
        </li>
<?php endfor;?>
</ul>
 </div>
 <div class="bulletin-pagination d-flex justify-content-center">
 <ul class="pagination pagination-sm">
    <li class="page-item">
        <a href="#" class="page-link disabled"><span class="fa fa-step-backward"></span> Prev</a>
</li>
    <li class="page-item active">
        <a href="#" class="page-link ">1</a>
</li>
    <li class="page-item">
        <a href="#" class="page-link ">2</a>
</li>
    <li class="page-item">
        <a href="#" class="page-link ">3</a>
</li>
    <li class="page-item">
        <a href="#" class="page-link ">4</a>
</li>
    <li class="page-item">
        <a href="#" class="page-link ">5</a>
</li>
    <li class="page-item">
        <a href="#" class="page-link "> Next <span class="fa fa-step-forward"></span></a>
</li>
</ul>
</div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <aside class="sidebar px-2">
                           advert and general annoucement goes here
                        </aside>

                    </div>
                </div>
            </div>
        </section>

        <?php include("includes/footer.php"); ?>
        <script src="js/Js_visible_element.js"></script>
        <script src="js/home-main.js"></script>
    </body>

</html>