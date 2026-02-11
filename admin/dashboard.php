<?php
session_start();
error_reporting(0);
include('conn.php');
if (strlen($_SESSION['agmsaid']==0)) {
  header('location:logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Resale Retreate - Admin Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
.dashboard {
    display: flex;
    justify-content: space-around;
    padding: 20px;
}
.card {
    width: 200px;
    padding: 20px;
    border-radius: 5px;
    color: white;
    text-align: center;
}
.blue {
    background-color: #3498db;
}
.green {
    background-color: #2ecc71;
}
.yellow {
    background-color: #f1c40f;
}
.red {
    background-color: #e74c3c;
}
.card .count {
    margin: 0;
    font-size: 2.5em; /* Increased font size */
}
.card .title {
    margin: 10px 0 0;
    font-size: 2.5em; /* Increased font size */
}
.card .info {
    margin-top: 10px;
    font-size: 1.5em;
    text-decoration: underline;
    cursor: pointer;
}
</style>
<body>
  <!-- container section start -->
  <section id="container" class="">
    <?php include_once('includes/header.php'); ?>
    <!--header end-->

    <!--sidebar start-->
    <?php include_once('includes/sidebar.php'); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>
        
        <div class="row">
          <!-- Small windows (cards) -->
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a href="mcategory.php">
              <div class="info-box blue-bg">
                <i class="fa fa-thumbs-o-up"></i>
                <div class="title">Categories</div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a href="mitem.php">
              <div class="info-box green-bg">
                <i class="fa fa-shopping-cart"></i>
                <div class="title">Items</div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a href="users.php">
              <div class="info-box yellow-bg">
                <i class="fa fa-user"></i>
                <div class="title">Users</div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <a href="selling.php">
              <div class="info-box red-bg">
                <i class="fa fa-bar-chart-o"></i>
                <div class="title">Selling</div>
              </div>
            </a>
          </div>
        </div>
        
      </section>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true
        });
      });

      //custom select box
      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>
