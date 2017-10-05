<?php
include 'connect.php';
// if (!isset($_SESSION['choose'])) {
//  header("Location: index.php");
// }
          
          $tglpesan = explode(" - ", $_SESSION['tgl']);
          $tglpesan[0] = explode("/", $tglpesan[0]);
          $tglpesan[1] = explode("/", $tglpesan[1]);
          $bulan = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          for ($i = 0; $i < 12; $i++) {
            if ($tglpesan[0][0] == $i) {
              $checkin = $bulan[$i]." ";
            }
          }
          $checkin .= $tglpesan[0][1].", ".$tglpesan[0][2];
          for ($i = 0; $i < 12; $i++) {
            if ($tglpesan[1][0] == $i) {
              $checkout = $bulan[$i]." ";
            }
          }
          $checkout .= $tglpesan[1][1].", ".$tglpesan[1][2];
          
?>
<!DOCTYPE html>
<html>
<head>
  <title>S2K | Confirm Your Stay</title>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" style="text/css" href="css/style.css" />
  <link href="css/progress-wizard.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap-modal-carousel.css" rel="stylesheet" />
  <style>
  .row {
    margin-right: -15px;
    margin-left: -15px;
  }
  </style>
</head>
<body>
  <div class="col-md-6 col-md-offset-3">
    <div class="col-md-6">
    <h4>S2K</h4>
    <h5>Jl. Marinda - Waiwo, Raja Ampat, Papua Barat</h5>
    <h5>+62 853-4451-5123</h5>
    <h5>bookings@s2k.com</h5>
    </div>
    <h3 style="text-align: center;"> Booking Details </h3>
    <h2 style="text-align: center;">S2K</h2>
    <div class="col-md-12" style="border:2px solid;">
      <h4>Your Information</h4>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">First Name : </div>
        <div class="col-md-4" style="text-align:right;"><?php echo $_SESSION['fnama']?></div>
      </div>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Last Name :</div>
        <div class="col-md-4" style="text-align:right;"><?php echo $_SESSION['lnama']?></div>
      </div>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Email :</div>
        <div class="col-md-4" style="text-align:right;"><?php echo $_SESSION['email']?></div>
      </div>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Payment Method :</div>
        <div class="col-md-4" style="text-align:right;">
          <?php 
          if ( $_SESSION['card'] == "mastercard")
          {
            echo "Mastercard";
          }
          else if ( $_SESSION['card'] == "visa")
          {
            echo "Visa";
          }
          ?>  
        </div>
      </div>
    </div>
    <div class="col-md-12" style="border:2px solid;">
      <h4>Your Reservation</h4>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Number of Room(s) :</div>
        <div class="col-md-4" style="text-align:right;"><?php echo $_SESSION['max']?> Room(s)</div>
      </div>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Check In :</div>
        <div class="col-md-4" style="text-align:right;"><?php echo $checkin;?></div>
      </div>
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Check Out :</div>
        <div class="col-md-4" style="text-align:right;"><?php echo $checkout;?></div>
      </div>
    </div>
    <div class="col-md-12" style="border:2px solid;">
      <h4>Room Details</h4>
      
      <?php
      $kamar = $_SESSION['kamar'];
      $fasilitas = $_SESSION['fasilitas'];
      $total = 0;
      for($i = 1; $i <= count($kamar); $i++)
        {
          $datakamar = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe = $kamar[$i]"));
          $datafasilitas = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM fasilitas WHERE id_fasilitas = $fasilitas[$i]"));
          $harga = $datafasilitas['harga'] + $datakamar['harga'];
          $total = $total + $harga; 
          echo"<div style='margin-bottom:3%;'><div class='row' style='margin-bottom:1%;'><div class='col-md-8'>".$datakamar['nama']."</div>";
          echo"<div class='col-md-4' style='text-align:right;'>IDR ".$datakamar['harga'].",00</div></div>";
          echo "<div class='row' style='margin-bottom:1%;'><div class='col-md-8'>".$datafasilitas['nama']."</div>";
          echo"<div class='col-md-4' style='text-align:right;'>IDR ".$datafasilitas['harga'].",00</div></div>";
          echo "<div class='row' style='margin-bottom:1%;'><div class='col-md-8'>Average Rate</div>";
          echo "<div class='col-md-4' style='text-align:right;'>IDR ".$harga.",00</div></div></div>";
          
        }

      echo '<div class="row" style="margin-bottom:1%;"><div class="col-md-8"> Total : </div>';
      echo '<div class="col-md-4" style="text-align:right;">IDR '.$total.',00</div></div>';

      if(isset($_SESSION['userid']))
      {
        $disc = $total*0.1;
        echo '<div class="row" style="margin-bottom:1%;">
        <div class="col-md-8">Member Discount :</div>
        <div class="col-md-4" style="text-align:right;">IDR '.$disc.',00</div>
        </div>';
      }

        echo '<div class="row" style="margin-bottom:1%;"><div class="col-md-8"> Tax : </div>';
        $tax = ($total * 0.15);
        echo '<div class="col-md-4" style="text-align:right;">IDR '.$tax.',00</div></div>';

        

        $grandtotal = $total - $disc + $tax;
      ?>
        
      <div class="row" style="margin-bottom:1%;">
        <div class="col-md-8" style="font-size: 20px;">Grand Total :</div>
        <div class="col-md-4" style="text-align:right;font-size: 20px;">IDR <?php echo $grandtotal;?>,00</div>
      </div>
    
    </div>
    
  </div> 
 
 
</body>
</html>