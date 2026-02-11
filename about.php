<!DOCTYPE html>
<html lang="zxx">
   <head>
      
      <script>
         addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
         }, false);

         function hideURLbar() {
            window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
      <style>
         .about-us-img {
            width: 100%;    /* Set width to 100% of the container */
            height: 400px;  /* Set height to 400px */
            object-fit: cover; /* Ensure the image is covered */
         }
		 .content{
			 justify-content: center;
		 }
      </style>
   </head>
<body>
      <!--header-->
      <?php include_once('includes/header.php');?>
      

      <img src="includes/aboutus.jpg" class="about-us-img"/>
      <center><br><br>
      <h3>About Us<br><br></h3>
	<div class="content" >
      Welcome to Resale Retreate <br>
			 
	  your trusted online marketplace for buying and selling quality secondhand goods.<br>
      We believe in giving pre-loved items a second chance<br>
	  while helping consumers find great deals on everything from <br>
	  clothing and accessories to home décor, electronics, and more.<br><br></p>

      At Resale Retreate, we make it easy for sellers to declutter and earn money <br>
	  while providing shoppers with a sustainable and affordable way to shop.<br>
	  Our platform is designed to create a seamless buying and selling experience<br>
	  ensuring that every transaction is secure, simple, and rewarding.<br><br>

      By choosing Resale Retreate, you're not just saving money<br>you’re also contributing to a more sustainable future by reducing waste and promoting reuse.<br>Join our growing community today and discover the joy of secondhand shopping!<br><br>

      Happy thrifting!<br>
      The Resale Retreate Team<br><br>
      </section>
      <!--//about -->

      <?php include_once('includes/footer.php');?>
      <!-- //Modal 1-->
      <!--js working-->
      <script src='js/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- cart-js -->
      <script src="js/minicart.js"></script>
      <script>
         toys.render();

         toys.cart.on('toys_checkout', function (evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
               items = this.items();

               for (i = 0, len = items.length; i < len; i++) {}
            }
         });
      </script>
      <!-- //cart-js -->
      <!-- start-smoth-scrolling -->
      <script src="js/move-top.js"></script>
      <script src="js/easing.js"></script>
      <script>
         jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
               event.preventDefault();
               $('html,body').animate({
                  scrollTop: $(this.hash).offset().top
               }, 900);
            });
         });
      </script>
      <!-- start-smoth-scrolling -->
      <!-- here stars scrolling icon -->
      <script>
         $(document).ready(function () {

            var defaults = {
               containerID: 'toTop', // fading element id
               containerHoverID: 'toTopHover', // fading element hover id
               scrollSpeed: 1200,
               easingType: 'linear'
            };

            $().UItoTop({
               easingType: 'easeOutQuart'
            });

         });
      </script>
      <!-- //here ends scrolling icon -->
      <!--bootstrap working-->
      <script src="js/bootstrap.min.js"></script>
      <!-- //bootstrap working-->      
      <!-- //OnScroll-Number-Increase-JavaScript -->
   </body>
</html>
