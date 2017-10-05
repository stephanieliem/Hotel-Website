<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyek Tekweb</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" style="text/css" href="css/style.css" />
    <style>
      .numberCircle {
        border-radius: 50%;
        width: 28px;
        height: 28px;
        padding: 5px;

        background: grey;
        border: 2px solid #333;
        color: #333;
        text-align: center;

        font: 13px Arial, sans-serif;
     	}

    	.now {
        border-radius: 50%;
        width: 28px;
        height: 28px;
        padding: 5px;

        background: grey;
        border: 2px solid white;
        color: white;
        text-align: center;

        font: 13px Arial, sans-serif;
    	}
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
  <div class="row">
<div class="col-md-1">
<div style="height:110px;padding-top: 25px;">
</div>
<div class="col-md-12" style="vertical-align: middle; background-color: grey; height:35px; padding-top: 3px;">
</div>
</div>
<div class="col-md-2">
<div style="height:150px; width:200px; margin-left: 0px;">
		<img src="images/s2k.jpg" style="height:100%;width:80%;">
		</div>
</div>
	<div class="col-md-9">
		<div class="row">
  		<div class="col-md-5" style="height:110px;padding-top: 25px;">
  		  <h5>BEST RATE GUARANTEED</h5>
  		  <h6>Book direct and get the best rate and most favourable cancellation terms, guaranteed</h6>
  		</div>
  		<div class="col-md-7">
  		  <p style="text-align: right; margin-top: 80px; margin-right:15px;"><a href="#"> Make A Reservation </a></p>
  		</div>
		</div>
		<div class="col-md-12" style="vertical-align: middle; background-color: grey; height:35px; padding-top: 3px;">
				<table>
				<tr>
				<td><div class="now">1</div></td>
				<td style="vertical-align: middle; color:white;padding-right:10px; padding-left:3px;">Plan Your Stay</td>
				<td><div class="numberCircle">2</div></td>
				<td style="vertical-align: middle; padding-right:10px; padding-left:3px;">Choose Your Room</td>
        <td><div class="numberCircle">3</div></td>
        <td style="text-align: center; padding-right:10px; padding-left:3px;">Choose Your Package</td>
				<td><div class="numberCircle">4</div></td>
				<td style="text-align: center; padding-right:10px; padding-left:3px;">Confirm Your Stay</td>
				</tr>
				</table>
		</div>
	</div>
</div>
    <div class="container-fluid" style="background-color:white; min-height:250px;">
      <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
          <div style="top:50%;transform:translateY(30%);">
            <h3 style="color:black; "> MAKE A RESERVATION </h3>
            <div class="row">
              <div class="col-md-6">
                <form action="coba.php" method="POST">
                   <div class="form-group">
                    <input type="text" name="daterange" class="form-control" value="<?php echo date('m/d/Y');?> - <?php echo date('m/d/Y');?>" />
                   </div>
                </form>
                <div class="row">
                  <div class="col-md-6">
                  <select class="form-control" name="room"> 
                    <option value="1"> 1 Room </option>
                    <option value="2"> 2 Room </option>
                    <option value="3"> 3 Room </option>
                  </select>
                  </div>
                  <div class="col-md-6">
                  <select class="form-control" name="guest"> 
                    <option value="1"> 1 Guest </option>
                    <option value="2"> 2 Guest </option>
                    <option value="3"> 3 Guest </option>
                    <option value="4"> 4 Guest </option>
                    <option value="5"> 5 Guest </option>
                    <option value="6"> 6 Guest </option>
                  </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              <!--  <div class="form-group" style="vertical-align: middle;">
                  <input type="checkbox" name="flexible" value="yes">     My dates are flexible</br>
                </div> -->

                <div class="form-group">
                    <input type="text" name="flexible" placeholder="Enter Code (optional)" class="form-control">
                </div>
                <div class="form-group">
                  <a href="available.php"><input type="button" value="Check Availability" class="btn btn-default" style="width:100%;"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid" style="background-color:black; min-height:210px; margin-top: 2%; width:100%;margin-left:0%;">
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

    
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <form action="signin.php" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sign In</h4>
          </div>
          <div class="modal-body">
            <h4>Welcome!</h4>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker();
    });
    </script>
  </body>
</html>