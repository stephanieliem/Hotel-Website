<?php
include "connect.php";
if (!isset($_SESSION['choose'])) {
  header("Location: index.php");
}
$max = $_SESSION['max'];
$_SESSION['current'] = $_GET['room'];
// if ($current > $max || $current > $current2 || $_SESSION['choose'] != 'k') {
//  header("Location: delsession.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>S2K | Choose Your Room</title>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link href="css/progress-wizard.min.css" rel="stylesheet">
  <script src="js/jquery-3.2.1.js"></script>
  <style>
    body {
      overflow-x: hidden;
    }
    p a {
      color:black;
    }
    p a:hover {
      color:black;
    }
  </style>
    <script>
     $(document).ready(function()
     {
      var elementPosition = $('#fix').offset();
      $(window).scroll(function()
      {
       if($(window).scrollTop() > elementPosition.top)
       {
         $('#fix').css('position','fixed').css('top','0').css("width", "100%");
       }
       else
       {
         $('#fix').css('position','static');
       }    
     });
    });
  </script>
</head>
<body>
 <div class="fix">
  <nav class="navbar navbar-default navbar-static-top" style="background-color: black; display:none;">
    <div class="container">
      <div class="navbar-header">
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">

        </ul>
        <ul class="nav navbar-nav navbar-right">

        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <?php include "navbar.php";?>
  <div class="container" style="margin-top: 7%;">
    <div class="row">
      <div class="col-xs-4">
        <h3 class="header" style="margin-top: 8px;">AVAILABLE ROOM</h3>
      </div>
      <div class="col-xs-8">
        <ul class="progress-indicator">
          <li class="completed" > <span class="bubble"></span><h5> Plan Your Stay</h5></li>
          <li class="completed"> <span class="bubble"></span><h5> Choose Your Room</h5></li>
          <li> <span class="bubble"></span><h5> Choose Your Package</h5></li>
          <li> <span class="bubble"></span><h5> Confirm Your Stay</h5></li>
        </ul>
      </div>
    </div>
    <?php
      $room = mysqli_query($con, "SELECT * FROM tipe");
      $j = 1;
      while ($row = mysqli_fetch_assoc($room)) {
        if ($_SESSION['avaroom'][$j] > 0) {
    ?>
    <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
      <div class="row" style="background-color: #f1f1f5">
        <div class="col-sm-12 col-md-5">
          <img src="<?php echo $row['image1'];?>" class="img-responsive" style="width: 100%; height: auto;">
        </div>
        <div class="col-sm-12 col-md-7 text-center">
          <h3><?php echo $row['nama'];?></h3>
          <div class="col-md-12"> 
            <div class="row">
              <div class="col-xs-5 col-sm-5">
                <h5>View</h5>
                <p><?php echo $row['deskripsi'];?></p>
              </div>
              <div class="col-xs-3 col-sm-3">
                <h5>Room Size</h5>
                <p><?php echo $row['ukuran'];?> sq.ft.</p>
              </div>
              <div class="col-xs-4 col-sm-4">
                <p><span style="font-size: 18px;"><b>IDR <?php echo $row['harga'];?></b></span><br>per night</p>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-5 col-sm-5">
                <div class="form-group">
                  <button class="btn btn-default" data-toggle="modal" data-target="<?php echo '#detail'.$j;?>">View Detail Room</button>
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 col-xs-offset-3">
                <div class="form-group">
                  <form action="tambahkamar.php" method="POST">
                    <input type="hidden" name="idkamar" value="<?php echo $row['id_tipe'];?>">
                    <button type="submit" class="btn btn-primary">Select Room</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="<?php echo 'detail'.$j;?>" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div id="<?php echo 'carousel-example-generic'.$j;?>" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
               <img class="img-responsive" src="<?php echo $row['image1'];?>" alt="...">
                <div class="carousel-caption">
                  First View
                </div>
              </div>
              <div class="item">
                <img class="img-responsive" src="<?php echo $row['image2'];?>" alt="...">
                <div class="carousel-caption">
                  Second View
                </div>
              </div>
               <div class="item">
                <img class="img-responsive" src="<?php echo $row['image3'];?>" alt="...">
                <div class="carousel-caption">
                  Third View
                </div>
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="<?php echo '#carousel-example-generic'.$j;?>" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="<?php echo '#carousel-example-generic'.$j;?>" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php
        }
        $j++;
      }  
    ?>
  </div>
  
  <div class="container-fluid" style="background-color:black; min-height:210px; width:100%; margin-top: 20px;">
    <div class="container">
      <div class="row" id="footer">
        <div class="row"> 
          <div class="col-md-3">
            <h4 style="color:white; margin-top:15%;"> MORE INFORMATION </h4>
            <a href="#" style="color:white;"><h5 style="margin-top:5%; color:white;">Press Room</h5></a>
            <a href="#" style="color:white;"><h5 style="margin-top:5%; color:white;">Resturant</h5></a>
            <a href="#" style="color:white;"><h5 style="margin-top:5%; color:white;">Magazine</h5></a>
          </div>
          <div class="col-md-3">
            <h4 style="color:white; margin-top:15%;"> ABOUT US </h4>
            <a href="#" style="color:white;"><h5 style="margin-top:5%; color:white;">Introduction to Our Hotel</h5></a>
            <a href="#" style="color:white;"><h5 style="margin-top:5%; color:white;">What You Can Get</h5></a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
            <h5 style="color:white; margin-top:0%;">&copy;2017 - S2K All Rights Reserved</h5>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
