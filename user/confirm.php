<?php
include 'connect.php';
if (!isset($_SESSION['choose'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>S2K | Confirm Your Stay</title>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" style="text/css" href="css/style.css" />
	<link href="css/progress-wizard.min.css" rel="stylesheet">
	<link href="css/bootstrap-modal-carousel.css" rel="stylesheet" />
	<style>
		.ha {display: block; padding: 0; margin: 0; border: 0; width: 100%;}
		select {border: 0; width: 100%; padding: 0; margin: 0; height:34px;}
		td {margin: 0; padding: 0;}
		img {
			vertical-align:middle;
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
	<script>
	function checkvalid()
	{
		var firstname = document.getElementById("firstname").value;
    	if (firstname == "")
    	{
        	alert("Firstname must be filled out");
        	return false;
    	}
		if (!firstname.match(/^[a-zA-Z_\s]+$/)) {
   			 alert('Firstname must not contain numbers or special characters');
   			 return false;
		}

    	var lastname = document.getElementById("lastname").value;
    	if (lastname == "")
    	{
        	alert("Lastname must be filled out");
        	return false;
    	}

    	if (!lastname.match(/^[a-zA-Z_\s]+$/)) {
   			 alert('Lastname must not contain numbers or special characters');
   			 return false;
		}


    	var mobile = document.getElementById("mobile").value;
    	if (mobile == "")
    	{
        	alert("Mobile number must be filled out");
        	return false;
    	}
    	if (isNaN(mobile) || mobile.length < 10 || mobile.length > 15) {
    		alert("Not a valid mobile number");
        	return false;
    	}

    	var email = document.getElementById("email").value;
    	var atpos = email.indexOf("@");
   		var dotpos = email.lastIndexOf(".");
   		if (email == "")
    	{
        	alert("Email must be filled out");
        	return false;
    	}
    	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        	alert("Not a valid e-mail address");
        	return false;
   		}
    	
    	var name_oncard = document.getElementById("name_oncard").value;
    	if (name_oncard == "")
    	{
        	alert("Name on card must be filled out");
        	return false;
    	}

    	if (!name_oncard.match(/^[a-zA-Z_\s]+$/)) {
   			 alert('Name on card must not contain numbers or special characters');
   			 return false;
		}

    	var ccnumber = document.getElementById("ccnumber").value;
    	if (ccnumber == "")
    	{
        	alert("Credit Card Number must be filled out");
        	return false;
    	}
    	if (isNaN(ccnumber) || ccnumber.length>14 || ccnumber.length <12)
    	{
    		alert("Not a valid credit card number");
        	return false;
    	}

    	var ccexmonth = document.getElementById("ccexmonth");
        var val1 = ccexmonth.options[ccexmonth.selectedIndex].value;
        if(val1==0)
        {
            alert("Credit Card expired month must be selected");
            return false;
        }

        var ccexyear = document.getElementById("ccexyear");
        var val2 = ccexyear.options[ccexyear.selectedIndex].value;
        if(val2==0)
        {
            alert("Credit Card expired year must be selected");
            return false;
        }

        if(val2 == '2017')
        {
        	if(val1 < 7)
        	{
        		alert("Credit card expiry not valid");
        		return false;
        	}
        }
        var mc = document.getElementById("mc");
		var visa = document.getElementById("visa");
		var card = false;

		if(mc.checked || visa.checked)
		{
			card = true;
		}

		if(card==false)
		{
			alert("Credit Card type must be selected");
            return false;
		}
		var term = document.getElementById("term");
		var termc = false;

		if(term.checked)
		{
			termc = true;
		}

		if(termc==false)
		{
			alert("You must agree to the terms and condition");
            return false;
		}

	}	
	</script>
</head>
<body>
	<!-- <nav class="navbar navbar-default navbar-static-top" style="background-color: black;">
      <div class="container">
        <div class="navbar-header">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
          </ul>
        </div>
      </div>
    </nav> -->
    <nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">S2K Hotel</a>
	    </div>
	    <div id="navbar" class="navbar-collapse collapse">
	      <ul class="nav navbar-nav navbar-right">
	        <a href="index.php" type="button" class="btn btn-danger navbar-btn">Cancel</a> 
	      </ul>
	    </div>
	  </div>
	</nav>
    <div class="container" style="margin-top: 7%;">
      <center><h4>BEST RATE GUARANTEED</h4>
        <h4>Book direct and get the best rate and most favourable cancellation terms, guaranteed</h4><br/></center>
        <ul class="progress-indicator">
          <li class="completed" > <span class="bubble"></span><h5> Plan Your Stay</h5></li>
          <li class="completed"> <span class="bubble"></span><h5> Choose Your Room</h5></li>
          <li class="completed"> <span class="bubble"></span><h5> Choose Your Package</h5></li>
          <li class="completed"> <span class="bubble"></span><h5> Confirm Your Stay</h5></li>
        </ul>
      </div>
	<div class="container">
		<div class="row">	
			<div class="col-xs-4">
				<br/>
				<h3 style="text-align: center;"> YOUR RESERVATION </h3>
				<div>
					<h4 style="margin-top: 20px;">Raja Ampat</h4><h5>
					<?php
					$tglpesan = explode(" - ", $_SESSION['tgl']);
					$tglpesan[0] = explode("/", $tglpesan[0]);
					$tglpesan[1] = explode("/", $tglpesan[1]);
					$bulan = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					for ($i = 0; $i < 12; $i++) {
						if ($tglpesan[0][0] == $i) {
							echo $bulan[$i]." ";
						}
					}
					echo $tglpesan[0][1].", ".$tglpesan[0][2]." - ";
					for ($i = 0; $i < 12; $i++) {
						if ($tglpesan[1][0] == $i) {
							echo $bulan[$i]." ";
						}
					}
					echo $tglpesan[1][1].", ".$tglpesan[1][2];
					?>
					<br/>
					<?php echo $_SESSION['max']?> Room(s) 
				</h5>
			</div>
			<div>
				<br/>
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
					echo"<div class='col-xs-12' style='background-color:#DEE2E6;margin-bottom:10px;'><h5><b>".$datakamar['nama']."</b><br/>";
					echo $datafasilitas['nama']."</h5>";
					echo "<h5><br/><br/>Average Rate</h5>";
					echo "<h5 style='text-align:right;'><b>IDR ".$harga."</b></h5></div>";
					
				}
				echo "<div class='col-xs-12'><h5>Total Room Rates </h5>";
				echo "<h5 style='text-align:right;'><b>IDR ".$total."</b></h5>";
				$disc = 0;
				if(isset($_SESSION['userid']))
				{
					echo "<h5>Member Discount </h5>";
					$disc = $total*0.1;
					echo "<h5 style='text-align:right;'><b>IDR ".$disc."</b></h5>";
				}
				echo "<h5>Room Tax </h5>";
				$tax = ($total * 0.15);
				echo "<h5 style='text-align:right;'><b>IDR ".$tax."</b></h5>";
				echo "<h5>Estimated Total </h5>";

				$grandtotal = $total - $disc + $tax;
				$_SESSION['grandtotal'] = $grandtotal;
				echo "<h5 style='text-align:right;'><b>IDR ".$grandtotal."</b></h5></div>";
				?>
			</div>
		</div>
		<div class="col-xs-8">
			<h3 style="text-align: center;"> CONFIRM YOUR STAY </h3>
			<div class="container-fluid">
			<?php
			if(isset($_SESSION['userid']))
			{
				$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM member WHERE id_member = '".$_SESSION['userid']."'"));
				// $_SESSION['fnama'] = $result['firstname'];
				// $_SESSION['lnama'] = $result['lastname'];
				// $_SESSION['email'] = $result['email'];
			}
			?>
				<form action="inrev.php" method="POST" onsubmit="return checkvalid()">
					<table class="table table-bordered table-condensed">
						<tr>
							<td colspan="2" style="background-color: grey; text-align: center; color: white;"> GUEST DETAILS</td>
						</tr>
						<tr>
							<td style="width: 30%;"><h5>First Name </h5></td>
							<td><input type="text" class="form-control ha" id="firstname" name="firstname" placeholder=" Example: Kevin" value="<?php if(isset($_SESSION['userid'])){echo $result['firstname'];}?>" <?php if(isset($_SESSION['userid'])){echo ' readonly';}?>></td>
						</tr>
						<tr>
							<td><h5>Last Name </h5></td>
							<td><input type="text" class="form-control ha" id="lastname" name="lastname" placeholder=" Example: Nyoto" value="<?php if(isset($_SESSION['userid'])){echo $result['lastname'];}?>" <?php if(isset($_SESSION['userid'])){echo ' readonly';}?>></td>
						</tr>
						<tr>
							<td><h5>Mobile Phone Number </h5></td>
							<td><input type="text" class="form-control ha" name="mobile" id="mobile" placeholder=" Example: 081235241375" value="<?php if(isset($_SESSION['userid'])){echo $result['telepon'];}?>" <?php if(isset($_SESSION['userid'])){echo ' readonly';}?>></td>
						</tr>
						<tr>
							<td><h5>Email Address </h5></td>
							<td><input type="email" class="form-control ha" id="email" name="email" placeholder=" Example: m26415039@john.petra.ac.id" value="<?php if(isset($_SESSION['userid'])){echo $result['email'];}?>" <?php if(isset($_SESSION['userid'])){echo ' readonly';}?>></td>
						</tr>
					</table>
					<table class="table table-bordered table-condensed">
						<tr>
							<td colspan="3" style="background-color: grey; text-align: center; color: white;"> CREDIT CARD DETAILS</td>
						</tr>
						<tr>
							<td style="width: 30%;"><h5>Name On Card </h5></td>
							<td colspan="2"><input type="text" class="form-control ha" name="name_oncard" id="name_oncard" placeholder=" Name on card"></td>
						</tr>
						<tr>
							<td><h5>Credit Card Number </h5></td>
							<td colspan="2"><input type="text" class="form-control ha" name="ccnumber" id="ccnumber" placeholder=" Credit card number"></td>
						</tr>
						<tr>
							<td><h5>Credit Card Expiry Date </h5></td>
							<td style="width:35%;">
								<select name="ccexmonth" id="ccexmonth">
									<option disabled selected value value="0">Please Choose</option>
									<option value="1">01 </option>
									<option value="2">02 </option>
									<option value="3">03 </option>
									<option value="4">04 </option>
									<option value="5">05 </option>
									<option value="6">06 </option>
									<option value="7">07 </option>
									<option value="8">08 </option>
									<option value="9">09 </option>
									<option value="10">10 </option>
									<option value="11">11 </option>
									<option value="12">12 </option>
								</select>
							</td>
							<td style="width:35%;">
								<select name="ccexyear" id="ccexyear">
									<option disabled selected value value="0">Please Choose</option>
									<option value="2017">2017 </option>
									<option value="2018">2018 </option>
									<option value="2019">2019 </option>
									<option value="2020">2020 </option>
									<option value="2021">2021 </option>
									<option value="2022">2022 </option>
									<option value="2023">2023 </option>
									<option value="2024">2024 </option>
									<option value="2025">2025 </option>
									<option value="2026">2026 </option>
									<option value="2027">2027 </option>
									<option value="2028">2028 </option>
								</select>
							</td>
						</tr>
						<tr>
							<td><h5>Credit Card Type </h5></td>
							<td style="text-align: center; vertical-align:middle;">
								<center><table>
									<tr>
										<td>
											<input class="inline" type="radio" value="mastercard" name="typecard" id="mc">
										</td>
										<td style="padding-left:5px;">
											<img src="images/mc.png">
										</td>
									</tr>
								</table>
							</center>
						</td>
						<td style="text-align: center; vertical-align:middle;">
							<center>
								<table>
									<tr>
										<td>
											<input class="inline" type="radio" value="visa" name="typecard" id="visa">
										</td>
										<td style="padding-left:5px;">
											<img src="images/visa.png">
										</td>
									</tr>
								</table>
							</center>
						</td>
					</tr>
				</table>
				<table class="table table-bordered table-condensed">
					<tr>
						<td style="background-color: grey; text-align: center; color: white;"> TERMS AND CONDITION</td>
					</tr>
					<tr>
						<td>
							<table>
								<tr>
									<td style="padding-left:10px;">
										<input class="inline" type="radio" value="term" name="term" id="term">
									</td>
									<td style="padding-left:5px;">I have read and accepted the <a href="#">Terms & Condition</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<input type="submit" class="btn btn-primary pull-right" value="Submit">
			</form>
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
</body>
</html>