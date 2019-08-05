
<nav id="navbar" class="church-nav  navbar navbar-expand-lg navbar-dark ch-navbar-light bg-dark">
	    <div class="container">
            <a  class="church-logo navbar-brand" href="index.php">
			<?php if(!isset($picture['logo'])): ?>

			<img class="float-left mr-2" src="images/christian-cross.svg" height="50" width="50">

                                <?php else: ?>
                                <img class="float-left mr-2" src="<?php echo $image_dir.$picture['logo']; ?>" alt="Pastor picture"
                                        width="50" height="50">
								<?php endif; ?>
					
        <span class="d-inline-block brand-text animate" data-effect="border-wide"><span class="d-block animate" data-effect="fadeInLeft"><?php echo $ch_abbr?></span><span class="d-block animate" data-effect="fadeInLeft"><?php echo $ch_name?></span></span></a>
	      <button class="navbar-toggler"  type="button" data-toggle="collapse" aria-controls="church-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fas fa-bars"></span> Menu
					
					<div class="show collapse navbar-collapse">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item home"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item events"><a href="events.php" class="nav-link">Events</a></li>
	          <li class="nav-item sermon"><a href="sermons.php" class="nav-link">Sermons</a></li>
	          <li class="nav-item bulletin"><a href="bulletins.php" class="nav-link">Bulletin</a></li>
						<li class="nav-item contact"><a href="contact.php" class="nav-link">Contact</a></li>
						
	          <li class="nav-item about"><a href="about.php" class="nav-link">About</a></li>
	        </ul>
				</div>
				
	      </button>
	      <div class="collapse navbar-collapse">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item home"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item events"><a href="events.php" class="nav-link">Events</a></li>
	          <li class="nav-item sermon"><a href="sermons.php" class="nav-link">Sermons</a></li>
	          <li class="nav-item bulletin"><a href="bulletins.php" class="nav-link">Bulletin</a></li>
						<li class="nav-item contact"><a href="contact.php" class="nav-link">Contact</a></li>
						<li class="nav-item about"><div class="about-dropdown">
						    <span class="about-dropdown-btn"><a href="about.php" class="nav-link">About Us</a></span>
								<div class="about-dropdown-content">
								 <div class="container">
									 <div class="row">
										 <div class="col-md-3 col-lg-3">
											 <h2 class="mb-4">About Us</h2>
											 <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam fuga, voluptates ducimus deserunt debitis, tenetur
													cum dolor quis quae inventore culpa ratione esse temporibus. Laudantium
													<a  href="#mission" ><span  class="mt-1 about-readmore-btn">Read More</span></a>
												</p>
											
										</div>
										<div class="col-md-3 col-lg-3">
                     <h5 class="mt-3 mb-4">About</h5>
										<p><a href="#">Our Church</a><p>
									 <p><a href="#"> Our Branches</a><p>
									 <p><a href="#"> Our Service </a><p>
											 </div>
											 <div class="col-md-3 col-lg-3">
											 <h5 class="mt-3 mb-4"> Ministries </h5>
											 <p><a href="#"> lorem dopma cotex</a><p>
											 <p><a href="#"> Bota don mos codeva</a><p>
											 <p><a href="#"> Lorem Ipsum Dogma</a><p>
											 </div> <div class="col-md-3 col-lg-3">
											 <h5 class="mt-3 mb-4">I am New</h5>
											  <img src="images/sermons-3.jpg" width="150" height="100" alt="New member" class="img-thumbnail">
											 <p> Secondary Bushmea </p>
											 <p> Secondary Bushmea </p>
											 <p> Secondary Bushmea </p>
											 </div>
									 </div>
								 </div>
								</div>
							</div>
						</li>
	        </ul>
	      </div>
	    </div>
    </nav>