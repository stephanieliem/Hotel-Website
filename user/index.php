<?php
  session_start();
  unset($_SESSION['kamar']);
  unset($_SESSION['fasilitas']);
  unset($_SESSION['max']);
  unset($_SESSION['untipe']);
  unset($_SESSION['totalroom']);
  unset($_SESSION['avaroom']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to S2K Hotel</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" style="text/css" href="css/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <style>
    .clearNav {
      -webkit-transition: all 0.25s;
      -moz-transition: all 0.25s;
      -o-transition: all 0.25s;
      transition: all 0.25s;
    }
    ul li a{
      color:white; 
    }
    ul li a:hover{
      color:white;
    }
  </style>
</head>
<body>
 <div >
  <nav class="navbar navbar-default  navbar-fixed-top" id="mobileNav">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">S2K</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
         <li><a href="planmystay.php">Reserve Now</a></li>
         <li><a href="#intro">Introduction</a></li>
         <li><a href="#news">News</a></li>
         <li><a href="#offers">Offers</a></li>
         <li><a href="#footer">Contact</a></li>
         <li><a data-toggle="modal" data-target="#myModal">Sign In</a></li>
       </ul>
     </div>
   </div>
 </nav>
</div>
<div id="desktopNav" class="clearNav container-fluid" style="height: 20%;">
  <div class="row">
    <div class="col-sm-1 col-md-2">
      <ul class="nav navbar-nav navbar-left">
        <div style="height: 50%; position: relative;"><li><a href="#reservenow" class="btn btn-default reserve" style="position: absolute; transform: translateY(20%);"><b>RESERVE NOW</b></a></li></div>
      </ul>
    </div>
    <div class="col-sm-10 col-md-8">
      <ul class="nav navbar-nav navbar-center" style="width: 100%; position: fixed; transform: translateX(-15%);">
        <li><a class="tIntro navbar-middle" href="#intro"><b>INTRODUCTION</b></a></li>
        <li><a class="tOffers navbar-middle" href="#news"><b>NEWS</b></a></li>
        <li><a class="tWeddings navbar-middle" href="#offers"><b>OFFERS</b></a></li>
        <li><a class="tContact navbar-middle" href="#footer"><b>CONTACT</b></a></li>
      </ul>
    </div>
    <div class="col-sm-1 col-md-2">
      <ul class="nav navbar-nav navbar-right" style="margin-right: 0.2%;">
        <div style="height: 50%; position: relative;">
          <li>
          <?php
            if (isset($_SESSION['userid'])) {
              echo '<a class="btn btn-default signin" href="delsession.php" style="position: absolute; transform: translate(-100%, 40%);"><span class="glyphicon glyphicon-log-out"></span> <b>SIGN OUT</b></a>';
            } else {
              echo '<a class="btn btn-default signin" data-toggle="modal" data-target="#myModal" style="position: absolute; transform: translate(-100%, 40%);"><span class="glyphicon glyphicon-log-in"></span> <b>SIGN IN</b></a>';  
            }
            
          ?>
          </li>
        </div>
      </ul>
    </div>
    <div style="transform: translateY(35%);">
      <center>
        <table>
          <tr>
            <td><span style="font-family: Tribal Animal; font-size: 500%;">f</span></td>
            <td><span style="font-size: 150%;">&nbsp;&nbsp;&nbsp;S2K<span></td>
          </tr>
        </table>
      </center>
    </div>
  </div>
</div>
<div class="parallax-window" data-parallax="scroll" data-image-src="images/background1.jpg"></div>
<div class="container-fluid" style="background-color:black; min-height:250px;">
  <div class="container">
    <div class="col-sm-8 col-sm-offset-2" id="reservenow">
     <div id="pesan" style="top:50%;transform:translateY(30%);">
       <h3 style="color:white; "> MAKE A RESERVATION </h3>
       <div class="col-md-12">
        <form action="reserve.php" method="POST">
         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <?php 
              $tomorrow = new DateTime('tomorrow');
              ?>
              <input type="text" name="daterange" class="form-control" value="<?php echo date('m/d/Y');?> - <?php echo $tomorrow->format('m/d/Y');?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
             <select class="form-control" name="room"> 
               <option value="1"> 1 Room </option>
               <option value="2"> 2 Room </option>
               <option value="3"> 3 Room </option>
               <option value="4"> 4 Room </option>
               <option value="5"> 5 Room </option>
             </select>
            </div>
          </div>
       </div>
       <div class="row">
        <?php
          if (isset($_SESSION['userid'])) {
        ?>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="code" placeholder="Enter code here (optional)">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <button type="submit" class="btn btn-default" style="width:100%;">Check Availability</button>
            </div>
          </div>
        <?php    
          } else {
        ?>
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
              <button type="submit" class="btn btn-default" style="width:100%;">Check Availability</button>
            </div>
          </div>
        <?php    
          }
        ?>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>
<div class="container-fluid">
  <div class="container">

    <div class="row" id="intro">
      <div class="col-md-12" style="margin-top:3%;">
        <center><h2>INTRODUCTION TO OUR HOTEL</h2></center>
        <div class="row" style="margin-top: 3%;">
          <div class="col-md-4">
           <img src="images/1.jpeg" class="img-responsive">
           <h4>SIGNATURE OVERNIGHT STAYS</h4>
           <p>Enjoy an overnight package that elevates your stay with unique amenities and special touches that you will long remember.</p>
         </div>
         <div class="col-md-4 text-center">
           <img src="images/2.jpeg" class="img-responsive">
           <h4>JOURNEY WITH US</h4>
           <p>Whether you're looking to plan your next adventure or discover travel trends - explore a curated world of travel, style and culture.</p>
         </div>
         <div class="col-md-4 text-right">
           <img src="images/3.jpeg" class="img-responsive">
           <h4>S2K CLUB LEVEL</h4>
           <p>A peaceful space for relaxation and conversation, S2K Club Level Lounge is a secluded haven where our guests can connect.</p>
         </div>
       </div>
     </div>
   </div>

   <div class="row" id="news">
    <div class="col-md-12" style="margin-top:3%;">
      <center><h2>NEWS</h2></center>
      <div class="row" style="margin-top:5%;">
        <div class="col-md-8" >
          <img src="images/casino.jpg" class="img-responsive">
        </div>
        <div class="col-md-4">
          <div class="content-offers">
            <h4>SAVE AND SHOP MORE</h4>
            <p>Reserve strip-view room within 19 April 2017 until 30 April 2017 and receive a voucher to get $100 in the nearest casino!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="offers">
    <div class="col-md-12" style="margin-top:3%;">
      <center><h2>WHAT YOU CAN GET?</h2></center>
      <div class="row" style="margin-top:5%;">
        <div class="col-md-3">
          <div class="content-offers">
            <h4>S2K MEMORIES</h4>
            <p>A peaceful space for relaxation and conversation, S2K Club Level Lounge is a secluded haven where our guests can connect.</p>
          </div>
        </div>
        <div class="col-md-9" >
          <img src="images/4.jpeg" class="img-responsive">
        </div>
      </div>
    </div>
  </div>

</div>
</div>

<div class="container-fluid" style="background-color:black; min-height:150px; margin-top: 3%;">
  <div class="container">
    <div class="row" id="footer">
      <div class="row"> 
        <div class="col-md-5">
          <table>
            <tr>
              <td>
                <h4 style="color:white; padding-top:5px;padding-right:15px;"> FIND US </h4>
              </td>
              <td>
                <i class="fa fa-instagram fa-2x" style="color:white; padding-top:8px;padding-right:10px;" aria-hidden="true"></i>
              </td>
              <td>
                <i class="fa fa-youtube-play fa-2x" style="color:white; padding-right:10px;padding-top:8px;" aria-hidden="true"></i>
              </td>
              <td>
                <i class="fa fa-facebook-official fa-2x" style="color:white; padding-right:10px;padding-top:8px;" aria-hidden="true"></i>
              </td>
              <td>
                <i class="fa fa-twitter fa-2x" style="color:white; padding-right:10px; padding-top:8px;" aria-hidden="true"></i>
              </td>
            </tr>
          </table>
        </div>
        
        <div class="col-md-7">
          <ul style="list-style: none; margin-top:1.5%; margin-left:20%;">
            <li style="display:inline-block; margin:1%; margin-bottom:0%;"><a href="#">Magazine</a></li>
            <li style="display:inline-block; margin:1%; margin-bottom:0%;"><a href="#">Contact</a></li>
            <li style="display:inline-block; margin:1%; margin-bottom:0%;"><a href="#">Facilities</a></li>
            <li style="display:inline-block; margin:1%; margin-bottom:0%;"><a href="#">Legal Notices</a></li>
            <li style="display:inline-block; margin:1%; margin-bottom:0%;"><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
        <hr>
      </div>
      <div class="row">
        <hr style="margin:0%;">
        <div class="col-md-12">
          <center>
            <h2 style="color:white; margin-top:3%;">S2K</h2>
            <img src="images/s2k.jpg" class="img-responsive" style="margin:0%; margin-bottom:2%; width:5%; height:5%;">
            <h5 style="color:white; margin-top:0%;">&copy;2017 - S2K All Rights Reserved</h5>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form action="signin.php" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Welcome!</h4>
        </div>
        <div class="modal-body">
          <!-- <h4>Welcome!</h4> -->
          <center>
        
            <table class="table">
              <tr>
                <div class="form-group">
                  <td style="width: 30%; border:none; text-align: right;"><label for="user">Username: </label></td>
                  <td style="border: none;"><input type="text" class="form-control" style="width: 75%;" id="user" name="user" placeholder="Put your username here.."></td>
                </div>
              </tr>
              <tr>
                <div class="form-group">
                  <td style="border: none; text-align: right;"><label for="pass">Password: </label></td>
                  <td style="border: none;"><input type="password" class="form-control" style="width: 75%;" id="pass" name="pass" placeholder="Put your password here.."></td>
                </div>
              </tr>
            </table>
            
          </center>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Submit">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animation.js"></script>
<script src="js/notify.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript">
  $(function() {
    $('input[name="daterange"]').daterangepicker();
  });
  <?php
    if(isset($_GET['status'])) {
      if($_GET['status'] == 1) {
        echo 'alert("Signed In Successfully");';
      } else if($_GET['status'] == 2) {
        echo 'alert("Username or Password Incorrect");';
      }
      else if($_GET['status'] == 3)
      {
        echo 'alert("Invalid Date");';
      }
    }
  ?>
</script>
</body>
</html>