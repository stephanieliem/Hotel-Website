<?php
include "connect.php";
if (!isset($_SESSION['choose'])) {
  header("Location: index.php");
}
$max = $_SESSION['max'];
$_SESSION['current'] = $_GET['facilities'];
$harga_kamar = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe = ".$_SESSION['kamar'][$_SESSION['current']]));
// if ($current > $max || $_SESSION['choose'] != 'f') {
//   header("Location: delsession.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>S2K | Choose Your Package</title>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link href="css/progress-wizard.min.css" rel="stylesheet">
  <link href="css/bootstrap-modal-carousel.css" rel="stylesheet" />
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
</head>
<body>
  <div class="container-fluid">
    <?php include "navbar.php";?>
    <div class="container" style="margin-top: 7%;">
      <div class="row">
        <div class="col-xs-4">
          <h3 class="header" style="margin-top: 8px;">AVAILABLE PACKAGE</h3>
        </div>
        <div class="col-xs-8">
          <ul class="progress-indicator">
            <li class="completed" > <span class="bubble"></span><h5> Plan Your Stay</h5></li>
            <li class="completed"> <span class="bubble"></span><h5> Choose Your Room</h5></li>
            <li class="completed"> <span class="bubble"></span><h5> Choose Your Package</h5></li>
            <li> <span class="bubble"></span><h5> Confirm Your Stay</h5></li>
          </ul>
        </div>
      </div>
      <?php
        $fasilitas = mysqli_query($con, "SELECT * FROM fasilitas");
        $j = 1;
        while ($row = mysqli_fetch_assoc($fasilitas)) {
      ?>
      <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
        <div class="row" style="background-color: #f1f1f5">
          <div class="col-sm-12 col-md-5">
            <img src="<?php echo $row['image'];?>" class="img-responsive" style="width: 100%; height: auto;">
          </div>
          <div class="col-sm-12 col-md-7 text-center">
            <h3><?php echo $row['nama'];?></h3>
            <div class="row">
              <div class="col-xs-7 col-sm-7">
                <p><h5>Included in this package</h5></p>
                <?php echo $row['deskripsi'];?>
              </div>
              <div class="col-xs-5 col-sm-5">
                <h4><b>IDR <?php echo $harga_kamar['harga']+$row['harga'];?></b></h4>per night
              </div>
            </div>
            <div class="row">
              <div class="col-xs-5 col-sm-5 col-xs-offset-7">
                <div class="form-group">
                  <form action="tambahfasilitas.php" method="POST">
                    <input type="hidden" name="idfasil" value="<?php echo $row['id_fasilitas'];?>">
                    <button type="submit" class="btn btn-primary" style="margin-top:22%;">Select Package</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          $j++;
        }  
      ?>
    </div>
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
  <script src="js/bootstrap-modal-carousel.js"/></script/>
</body>
</html>
