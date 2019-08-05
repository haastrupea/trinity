<?php
include_once 'includes/ch_info.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Church-Contact us</title>
<?php include_once("includes/css.import.php"); ?>
<link rel="stylesheet" type="text/css" media="screen" href="css/contact.css">
</head>
<body>
  <?php include("includes/nav.php"); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="contact-hero-container col-md-12 parallax">
          <div class="overlay-gradient"></div>
          <div class="overlay-gradient"></div>
          <div class="dark-overlay"></div>

        <div class="row align-items-center text-center">
          <div class="col-md-12">
            <span class="fa fa-map-marked animate"> Fellowship With Us </span>
          </div>
        </div>
      </div>
    </div>


  </div>

  <!-------------------------------------Contact------------------------------------------>
  <section class="contact-section">
    <div class="container bg-light contact-info">
      <div class="row">
        <div class="col-md-12">
          <h2 class="contact-us text-center mt-5 animate"> Contact Us </h2>
          <div class="text-center mb-5 animate">
            <p>Have any Question? We'd love to hear from you.<p>
                <p>Here's how to get in touch with us.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 pr-md-5 animate">
          <form action="#">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn-sm btn btn-primary py-3 px-5">
            </div>
          </form>

        </div>

        <div class="col-md-6">
          <b >Media Request</b>
          <p class="mb-3 animate"><span>Address:</span> 198 West Georgia Street, Suite 721 Ebutemeta Atakunmosa West.</p>
          <b>Mobile Address</b>
          <p class="mb-3 animate"><span>Phone:</span> <a href="tel://1234567920">+234 3453 421</a></p>
          <b>Mailing Address</b>
          <p class="mb-3 animate"><span>Email:</span> <a href="mailto:info@yoursite.com">info@Godschurch.com</a></p>
          <b>Web Address</b>
          <p class="aniamte"><span>Website</span> <a href="#">GodsChurch.com</a></p>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <?php include("includes/footer.php"); ?>
  <script src="js/Js_visible_element.js"></script>
<script src="js/home-main.js"></script>
</body>

</html>