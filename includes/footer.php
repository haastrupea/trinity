<footer class="ch-footer bg-dark text-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class=" mb-4">
                    <h4 class="logo animate">
                        
                            <?php if(!isset($logo)): ?>
                            <img src="images/christian-cross.svg" height="50" width="50"><?php else: ?><img src="<?php echo $logo; ?>" alt="Pastor picture" width="50" height="50"> <?php endif; ?>   
                   <a href="index.php">
                       <!-- <span>God</span> -->
                       <span>
                        <?php echo isset($church_name)? $church_name:"Church" ?></span></a></h5>
                    <p class="animate">pastors welcome address</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-4 ml-md-5 animate">
                    <h2>Quick Links</h2>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="py-2 d-block">Home</a></li>
                        <li><a href="bulletins.php" class="py-2 d-block">Bulletin</a></li>
                        <li><a href="index.php#Newsletter" class="py-2 d-block">Newsletter</a></li>
                        <li><a href="sermons.php" class="py-2 d-block">Sermons</a></li>
                        <li><a href="events.php" class="py-2 d-block">Events</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-4 animate">
                    <h2 >Contact Information</h2>
                    <ul class="list-unstyled contact-detail">
               <li><span class="fa fa-map-marked"></span><span class="text"> 24, Adeniji street Lagos</span>
                                </li>
                            <li><a href="#"><span class="fas fa-phone"></span><span class="text"> +234 902 3929 210</span></a></li>
                            <li><a href="#"><span class="fas fa-envelope"></span><span class="text"> info@Godschurch.com</span></a></li>
                            <li><span class="fas fa-clock"></span><span class="text"> Saturday — Sunday 8:00am -
                                    5:00pm</span></li>
                        </ul>
                    <ul class="social-media list-unstyled d-flex animate ">
                        <li class=""><a href="#"><span class="fab fa-twitter fa-2x"></span></a></li>
                        <li class=""><a href="#"><span class="fab fa-facebook fa-2x"></span></a></li>
                        <li class=""><a href=" #"><span class="fab fa-instagram fa-2x"></span></a></li>
                        <li class=""><a href=" #"><span class="fab fa-youtube fa-2x"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center animate">
                <p class="text-white">Copyright &copy;
                    <?php echo date("Y") ?> All rights reserved | Gods Church <i class="icon-heart" aria-hidden="true"></i>
                    by <a href="#" target="_blank">wikytek</a> </p>
            </div>
        </div>
    </div>

    </footer>