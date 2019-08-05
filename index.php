<?php
include_once 'includes/ch_info.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <title>Church-home <?php echo $ch_name; ?></title>
<?php include_once("includes/css.import.php"); ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/carousel.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/home.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/countdown.css">
</head>
<body>
<?php include_once("includes/nav.php"); ?>
<section>
    <div class="slides-wrapper vh">
        <div class="slide-inner fullHight">
<!-- <div class="slide-left">left</div>
        <div class="slide-right">right</div> -->
        <div class="slide-item">
        <div class="overlay-gradient">
        </div>
        <div class="dark-overlay">
        </div>
        <!-- any other slide content can go in here -->
        <div class="parallax fullHight salvation-slide">
        <div class="container fullHight">
        <div class="row fullHight slide-content justify-content-center align-items-center text-white mx-0">
        <div class="text-center texto col-10">
            <h1 class="mb-4 animate" data-effect="fadeInRight">Only <strong class="text-danger">Jesus Christ</strong> saves</h1>
            <p class="animate" data-effect="fadeInLeft"><a id="rj" href="#" class="btn btn-primary btn-outline-white px-4 py-3">Save your soul</a></p>
        </div>
    </div>
 </div>
        </div>
</div>
<div class="slide-item active">
    <div class="overlay-gradient">
    </div>
    <div class="overlay-gradient welcome-slide-overlay animate parallax" data-effect="rubberBand">
    </div>
    <!-- any other slide content can go in here -->
    <div class="parallax fullHight welcome-slide">
    <div class="container-fluid ">
    <div class="row slide-content pt-md-5 mt-md-4">
    <div class="col-md-2 col-sm-5 col-12 bg-dar pt-md-5 d-flex justify-content-center pt-3">
    <div class="pastor text-center mt-md-5 pt-md-5 text-white">
        <img class="img-thumbnail" src="<?php echo $pst_pic ?>" width="150">
        <p class="mb-0"><?php echo $pst_abbr_title_fullname ?></p>
        <h5>General Overseer</h5>
    </div>
    </div>
    <div class="texto col-md-10 col-sm-7 mt-md-5 px-3 text-white welcome-msg">
        <h1 class="animate" data-effect="fadeInLeft">Welcome <small>from pastor</small></h1>
        <p class="animate para-1"><?php echo $welcome_addr; ?></p>
    </div>

</div>
</div>
    </div>
</div>



 </div>
 </div>
</section>
    <section class="next-on-calender">
<div class="next-calender-wrapper">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="calender-description animate">
                            <h3 class="calender-title">
                                    General House Fellowship
                                </h3>
                                <p class="desc">
                                        Hosted By Brother Peter and Family. <br><span class="fa fa-map-marked"></span>  No 2, Ede Road,opp. OAU Gate, Ile-ife.
                                </p>
                    </div>
                   
                </div>
                <div class="col-sm-12  col-md-8 p-0">
                    <div class="calender-schedule d-md-flex align-items-md-center animate">
                        <div class="countdown-wrapper">
                            <p class=" countdown">
                                <span id="day-int" class="day">00
                                    <small>Days</small>
                                </span>
                                <span>:</span>
                                <span id="hour-int" class="hour">00
                                    <small>Hours</small>
                                </span>
                                <span>:</span>
                                <span id="minute-int" class="minute">00
                                    <small>Minutes</small>
                                </span>
                                <span>:</span>
                                <span id="second-int" class="second">00
                                    <small>Seconds</small>
                                </span>
                            </p>
                        </div>
                        <div class="event-button">
                            <p>
                                    <a href="events.php?event='house fellowship'&tag='upcoming event'" class="btn btn-primary rounded">Event Details</a>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>

    <section id="vision-mission">
<div class="container-fluid">
    <div class="row d-flex no-spacing">
        <div class="col-md-6 mission">
                <h1 class="text-center mb-0 p-3 animate"> MISSION <span class="fa fa-tasks float-right mr-5"></span></h1>
                <div id="slide" class="slide animate" data-uid="mision-slide" data-effect="fadein">
                    <div class="slide-inner">
                        <div class="slide-ite">
                            <div class="mision-container p-5">
                     <p class="mission-text p-5 text-center">
                     <?php echo $ch_mission ?>
                        </p>
                            </div>
                            </div>
                        </div>
                    </div>
            
            <a class="video-presentation">
                <span class="fa fa-play fa-2x my-auto"></span>   
            </a>
        </div>
        <div class="col-md-6 vision">
                <h1 class="text-center mb-0 p-3 animate"> VISION <span class="fa fa-eye float-right mr-5"></span></h1>
          <div id="slide" class="slide" data-uid="vision-slide">
              <div class="slide-inner">
                  <div class="slide-ite">
                       <div class="vision-container p-5">
                            
           <p class="vision-statement p-5 text-center animate">
           <?php echo $ch_vision ?>
           </p>
                       </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
    </section>
    <section>
        <div class="about-wrapper wrapper">
            <div class="container">
                <div class="row justify-content-center mb-4 pb-5">
                    <div class="col-md-7">
                        <span ></span>
                        <span class="section-title">
                            What we do
                        </span>
                        <span></span>
                        <!-- <h2 class="head motto animate">  
                        </h2> -->
                        <p class="intro animate">
                           Apart from our weekly sunday church services, we as a church also strive continuously to meet the following needs of our members.
                        </p>
                    </div>
                    </div>
                    <div class="row animate">
                    <div class="prayer-req col-md-3 animate">
                            <div class="icon-about-wrapper" >
                                    <span class="icon-about">
                                            <span class="wk wk-prayer wk-4x"></span>
                                        </span>
                               </div> 
                               <div class="short-desc">
                                            <h4 class="title">
                                           prayer request
                                            </h4>
                             <!-- <p class="short-text animate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis soluta facere asperiores. Nihil alias iure atque similique fuga odio, ab nisi eligendi?
                                            </p> -->
                                    </div>
                    </div>
                   <div class="counselling col-md-3 animate">
                        <div class="icon-about-wrapper" >
                                <span class="icon-about">
                                        <span class="wk wk-counselling wk-4x"></span>
                                    </span>
                           </div> 
                           <div class="short-desc">
                                        <h4 class="title">
                                        counselling
                                        </h4>
                         <!-- <p class="short-text animate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis soluta facere asperiores. Nihil alias iure atque similique fuga odio, ab nisi eligendi?
                                        </p> -->
                                </div>
                   </div>
                   <div class="care-ministry col-md-3 animate">
                          <div class="icon-about-wrapper" >
                            <span class="icon-about">
                                    <span class="wk wk-support wk-4x"></span>
                                </span>
                       </div> 
                       <div class="short-desc">
                                    <h4 class="title">
                                    Care ministry
                                    </h4>
                     <!-- <p class="short-text animate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis soluta facere asperiores. Nihil alias iure atque similique fuga odio, ab nisi eligendi?
                                    </p> -->
                            </div>
                   </div>
                   <div class="sermon col-md-3 animate">
                       <div class="icon-about-wrapper" >
                            <span class="icon-about">
                                    <span class="wk wk-sermon wk-4x"></span>
                                </span>
                       </div> 
                       <div class="short-desc">
                                    <h4 class="title">
                                            The Scriptural teachings
                                    </h4>
                                    <!-- <p class="short-text animate">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis soluta facere asperiores. Nihil alias iure atque similique fuga odio, ab nisi eligendi?
                                    </p> -->
                            </div>
                   </div>
                </div>

            </div>
        </div>
    </section>
    <section>
            <div class="sermon-wrapper wrapper">
                    <div class="container">
                        <div class="row justify-content-center mb-4 pb-5">
                            <div class="col-md-7">
                                <span class="section-title">
                                    Sermons
                                </span>
                                <h2 class="head animate">
                                    --LATEST SERMONS--
                                </h2>
                                <p class="intro animate">
                                    <!-- bible pessage talking about the word of God -->
                                    <span class="fa fa-quote-left"></span> Thy word is a lamp unto my feet, and a light unto my path. <span class="fa fa-quote-right"></span><span>-Psalm 119:105(KJV)</span>
                                </p>
                            </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4 animate">
                                            <div class="sermons">
                                            <a href="#" class="img  mb-3 d-flex justify-content-center align-items-center" >
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="fas fa-play"></span>
                                                    </div>
                                                </a>
                                                <div class="text">
                                                    <h3><a href="#">Be at Peace With One Another</a></h3>
                                                    <span class="position">Pastor. Ipsum Lorem</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 animate">
                                            <div class="sermons">
                                                <a href="#" class="img popup-vimeo mb-3 d-flex justify-content-center align-items-center" >
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="fas fa-play"></span>
                                                    </div>
                                                </a>
                                                <div class="text">
                                                    <h3><a href="#">Inspirational Message of God</a></h3>
                                                    <span class="position">Pastor. Lorem Ipsum</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 animate">
                                            <div class="sermons">
                                                <a href="https://vimeo.com/45830194" class="img popup-vimeo mb-3 d-flex justify-content-center align-items-center" style="background-image: url(images/sermons-3.jpg);">
                                                    <div class="icon d-flex justify-content-center align-items-center">
                                                        <span class="fas fa-play"></span>
                                                    </div>
                                                </a>
                                                <div class="text">
                                                    <h3><a href="#">Prayers, Presence, and Provision</a></h3>
                                                    <span class="position">Dave Zuleger</span>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                        <div class="row my-5 justify-content-center">
                            <div class="col-md-3 animate">
                                 <a href="sermons.php" class="btn btn-primary rounded">All Sermons</a>            
                            </div>
                        </div>
        
                    </div>
                </div>
    </section>
    <section>
       <div class="container-fliud">
           <div class="row no-spacing">
               <div class="col-md-6 d-flex justify-content-end align-items-center event-h-left">
                   <div class="col-md-8 text-sm-center text-md-right mr-md-5 mt-md-5 animate">
                       <h2>We love you to join us.</h2>
                       <p class="event-desc">
                            <span class="fa fa-quote-left"></span> I was glad when they said to me, “Let us go to the house of the LORD.” <span class="fa fa-quote-right"></span>
                       </p>
                       <h3 class="text-right">Psalm 122:1(NLT)</h3>
                       <div class="link-wrapper text-md-left">
                            <a href="#" class="btn btn-primary circle">View Events</a>
                       </div>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="event-wrapper">
                        <div class="event-container d-flex animate">
                                <div class="eventa1 mr-4">
                                        <p>
                                            <span>04</span>
                                            <span>Aug 2019</span>
                                        </p>
                                    </div>
                                    <div class="event-details">
                                        <h5 class="mb-1"><a href="events.html">Saturday's Bible Reading</a></h5>
                                        <p class="mb-2"><span>9:00am at ibeju-Lekki Lagos</span></p>
                                        <div class="img">
                                            <a href="#"><img src="images/event-3.jpg" alt="event-3 image" class="img-thumbnail"
                                                    height="200" width="300"></a>
                                        </div>
                                    </div>
                                    
                         </div>
                         <div class="eventa0 d-flex animate">
                                <div class="eventa1 mr-4">
                                        <p>
                                            <span>04</span>
                                            <span>Aug 2019</span>
                                        </p>
                                    </div>
                                    <div class="event-details">
                                        <h5 class="mb-1"><a href="events.html">Saturday's Bible Reading</a></h5>
                                        <p class="mb-2"><span>9:00am at ibeju-Lekki Lagos</span></p>
                                        <div class="img">
                                            <a href="#"><img src="images/event-3.jpg" alt="event-3 image" class="img-thumbnail"
                                                    height="200" width="300"></a>
                                        </div>
                                    </div>
                                    
                                </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
    <section>
        <div id="Newsletter" class="newsletter-wrapper">
                <div class="container">
                        <div class="row d-flex justify-content-center">
                          <div class="col-md-7 text-center animate">
                            <h3>Subcribe to our Newsletter</h3>
                            <p>We would love to have you on our mailing list, sign up below if you are interested</p>
                            <div class="row d-flex justify-content-center mt-5">
                              <div class="col-md-6">
                                <form action="#" method="post" class="subscribe-form">
                                  <div class="form-group">
                                  <input type="email" class="form-control" placeholder="Enter email address">
                                    <span class="subscribe fas fa-paper-plane"></span>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
        </div>
    </section>
<?php include_once("includes/footer.php"); ?>
</body>
<script src="js/Js_visible_element.js"></script>
<script src="js/carousel.js"></script>
<script src="js/home-main.js"></script>
<script src="js/countdown.js"></script>
</html>