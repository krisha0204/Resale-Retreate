<?php
session_start();
error_reporting(0);
include("conn.php");
?>
<!DOCTYPE html>
<html lang="">
   <head>
      <title>Resale Retreate</title>
      
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
      <!-- For Clients slider -->
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
      <!--flexs slider-->
      <link href="css/JiSlider.css" rel="stylesheet">
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>

   </head>
   <body>
   
   
      <?php include_once('includes/header.php');?>
      <div class="slider text-center">
            <div class="callbacks_container">
               <div class="wrapper" style = "bgcolor:#ffffff">
 	<div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="includes/p.png" alt="Desert" title="Desert" id="wows1_1"/></li>
		<li><img src="includes/q.png" alt="javascript carousel" title="Hydrangeas" id="wows1_2"/></li>
		<li><img src="includes/r.png" alt="Chrysanthemum" title="Chrysanthemum" id="wows1_0"/></li>
		<li><img src="includes/s.png" alt="Jellyfish" title="Jellyfish" id="wows1_3"/></a></li>
		
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="Chrysanthemum"><span><img src="data1/tooltips/chrysanthemum.jpg" alt="Chrysanthemum"/>1</span></a>
		<a href="#" title="Desert"><span><img src="data1/tooltips/desert.jpg" alt="Desert"/>2</span></a>
		<a href="#" title="Hydrangeas"><span><img src="data1/tooltips/hydrangeas.jpg" alt="Hydrangeas"/>3</span></a>
		<a href="#" title="Jellyfish"><span><img src="data1/tooltips/jellyfish.jpg" alt="Jellyfish"/>4</span></a>
	</div></div>
	<div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">slider jquery</a> by WOWSlider.com v9.0</div>
	<div class="ws_shadow"></div>
	</div>	
	<br>
	
  </div>
  <!-- ei-slider -->
</div>
            </div>
<br>
	<section>
	              <marquee><table>
				  <tr>
				 <?php 
				$ret = mysqli_query($conn, "SELECT photo FROM item"); // Query to select all photos
				if ($ret) { // Check if the query executed successfully
					while ($row = mysqli_fetch_array($ret)) {
						// Get the photo field value
						$photos = $row['photo']; // Retrieve the photos field
						
						// Split the photo paths (assuming comma-separated values)
						$photoArray = explode(',', $photos); // Break into an array
						
						// Loop through each photo path and display the images
						foreach ($photoArray as $photoPath) {
							$photoPath = htmlspecialchars(trim($photoPath), ENT_QUOTES, 'UTF-8'); // Sanitize each photo path
							echo '<img src="'.$photoPath.'" alt="Item Photo" style="width:250px;height:250px;">'; // Display each photo
						}
					}
				} else {
					echo "Error: " . mysqli_error($conn); // Handle query failure
				}
				?>
                </tr>
               </table></marquee>
            </div>
         </div>
      </section>
      <!--//about -->
    
      <!--Product-about-->
      <section class="about py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
     
         </div>
      </section>
      <!--//Product-about-->
     
      <!-- footer -->
      <?php include_once('includes/footer.php');?>
      <!-- //footer -->
      <!-- Modal 1-->
    
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
      <!--responsiveslides banner-->
      <script src="js/responsiveslides.min.js"></script>
      <script>
         // You can also use "$(window).load(function() {"
         $(function () {
         	// Slideshow 4
         	$("#slider4").responsiveSlides({
         		auto: true,
         		pager:false,
         		nav:true ,
         		speed: 900,
         		namespace: "callbacks",
         		before: function () {
         			$('.events').append("<li>before event fired.</li>");
         		},
         		after: function () {
         			$('.events').append("<li>after event fired.</li>");
         		}
         	});
         
         });
      </script>
      <!--// responsiveslides banner-->	 
      <!--slider flexisel -->
      <script src="js/jquery.flexisel.js"></script>
      <script>
         $(window).load(function() {
         	$("#flexiselDemo1").flexisel({
         		visibleItems: 3,
         		animationSpeed: 3000,
         		autoPlay:true,
         		autoPlaySpeed: 2000,    		
         		pauseOnHover: true,
         		enableResponsiveBreakpoints: true,
         		responsiveBreakpoints: { 
         			portrait: { 
         				changePoint:480,
         				visibleItems: 1
         			}, 
         			landscape: { 
         				changePoint:640,
         				visibleItems:2
         			},
         			tablet: { 
         				changePoint:768,
         				visibleItems: 2
         			}
         		}
         	});
         	
         });
      </script>
      <!-- //slider flexisel -->
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
      <script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>

	  
	  <!-- //bootstrap working-->
   </body>
</html>