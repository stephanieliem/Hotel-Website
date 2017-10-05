<?php
include "connect.php";
if (!isset($_SESSION['nama'])){
  header("Location: index.php");
}
$cekdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jml FROM staff"));
$_SESSION['page'] = "staff";
?>

<?php

if (isset($_POST['showtable']))
{
  if ($cekdata['jml'] == 0)
  {
    echo "<center><h6>No list of staff.</h6></center>";
  }
  else
  { 
    echo "
    <table class='table table-hover' id='myTable' style='width: 100%;''>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Address</th>
          <th>Place of Birth</th>
          <th>Date of Birth</th>
          <th>Phone Number</th>
          <th>Status</th>
          <th class='text-right'>Action</th>
        </tr>
      </thead>
      <tbody>";
        $datarev = mysqli_query($con, "SELECT * FROM staff");
        while ($row = mysqli_fetch_assoc($datarev))
        {
          echo "<tr>";
          echo "<td>".$row['id_staff']."</td>";
          echo "<td>".$row['nama']."</td>";
          echo "<td>".$row['alamat']."</td>";
          echo "<td>".$row['tempatlahir']."</td>";
          echo "<td>".$row['tanggallahir']."</td>";
          echo "<td>".$row['telepon']."</td>";
          if($row['status']==1)
          {
            echo"<td><span style='color: green;'>Active</span></td>";
          }
          else if($row['status']==0)
          {
            echo "<td><span style='color: red;'>Inactive</span></td>";
          }
          echo "<td class='col-md-2 text-right'><a class='btn btn-success btn-sm' style='margin-right:5px;' data-target='#mEdit' data-toggle='modal' data-act='".$row['id_staff']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
                            //<a class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a> 
        }
        echo 
        "</tbody>
      </table>";
    }
    exit();
  }

  if(isset($_POST['select']))
  {
    $id = $_POST['id'];
    $qselect = mysqli_query($con,"SELECT * FROM staff WHERE id_staff = '".$id."'");
    $qselect = mysqli_fetch_array($qselect);
    header("Content-type: text/x-json");
    echo json_encode($qselect);
    exit();
  }

  if(isset($_POST['insert']))
  {
    $nama=$_POST['nama'];
    $address=$_POST['address'];
    $ip=$_POST['ip'];
    $it=$_POST['it'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $qselect = mysqli_query($con,"INSERT INTO staff(nama, alamat, tempatlahir, tanggallahir, telepon, user, pass, status) values('$nama', '$address', '$ip', '$it', '$phone', '$username', '$pass', 1)");
    exit();
  }

  if(isset($_POST['edit']))
  {
    $id=$_POST['id'];
    $nama=$_POST['nama'];
    $address=$_POST['address'];
    $ip=$_POST['ep'];
    $it=$_POST['et'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $status=$_POST['status'];
    $qselect = mysqli_query($con,"UPDATE staff SET nama='$nama', alamat='$address', tempatlahir='$ip', tanggallahir='$it' ,telepon='$phone', user='$username', pass='$pass', status='$status' where id_staff = '".$id."'");
    exit();
  }

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Admin Panel S2K Hotel</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style_admin.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
    function insertcheckvalid()
    {
      var firstname = document.getElementById("inama").value;
      if (firstname == "")
      {
          alert("Name must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Name must not contain numbers or special characters');
         return false;
      }

      var address = document.getElementById("iaddress").value;
      if (address == "")
      {
          alert("Address must be filled out");
          return false;
      }

      var ip = document.getElementById("ip").value;
      if (ip == "")
      {
          alert("Place of Birth must be filled out");
          return false;
      }

      var cekdate = document.getElementById("idate");
      var val1 = cekdate.options[cekdate.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(date) must be selected");
          return false;
      }
      var cekmonth = document.getElementById("imonth");
      var val1 = cekmonth.options[cekmonth.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(month) must be selected");
          return false;
      }
      var cekyear = document.getElementById("iyear");
      var val1 = cekyear.options[cekyear.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(year) must be selected");
          return false;
      }
      
      var mobile = document.getElementById("iphone").value;
      if (mobile == "")
      {
          alert("Mobile number must be filled out");
          return false;
      }
      if (isNaN(mobile) || mobile.length < 10 || mobile.length > 15)
      {
        alert("Not a valid mobile number");
          return false;
      }

      var username = document.getElementById("iusername").value;
      if (username == "")
      {
          alert("Username must be filled out");
          return false;
      }

      var pass = document.getElementById("ipass").value;
      if (pass == "")
      {
          alert("Password must be filled out");
          return false;
      }
      return true;
    }

    function editcheckvalid()
    {
      var firstname = document.getElementById("enama").value;
      if (firstname == "")
      {
          alert("Name must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Name must not contain numbers or special characters');
         return false;
      }

      var address = document.getElementById("eaddress").value;
      if (address == "")
      {
          alert("Address must be filled out");
          return false;
      }

      var ip = document.getElementById("ep").value;
      if (ip == "")
      {
          alert("Place of Birth must be filled out");
          return false;
      }

      var cekdate = document.getElementById("edate");
      var val1 = cekdate.options[cekdate.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(date) must be selected");
          return false;
      }
      var cekmonth = document.getElementById("emonth");
      var val1 = cekmonth.options[cekmonth.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(month) must be selected");
          return false;
      }
      var cekyear = document.getElementById("eyear");
      var val1 = cekyear.options[cekyear.selectedIndex].value;
      if(val1==0)
      {
          alert("Date of Birth(year) must be selected");
          return false;
      }
      
      var mobile = document.getElementById("ephone").value;
      if (mobile == "")
      {
          alert("Mobile number must be filled out");
          return false;
      }
      if (isNaN(mobile) || mobile.length < 10 || mobile.length > 15)
      {
        alert("Not a valid mobile number");
          return false;
      }

      var username = document.getElementById("eusername").value;
      if (username == "")
      {
          alert("Username must be filled out");
          return false;
      }

      var pass = document.getElementById("epass").value;
      if (pass == "")
      {
          alert("Password must be filled out");
          return false;
      }
      return true;
    }
    </script>
  </head>

  <body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
      </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <?php include "navbar.php";?>
      <!-- End Top Navigation -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <?php include "sidemenu.php";?>
      <!-- ============================================================== -->
      <!-- End Left Sidebar -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page Content -->
      <!-- ============================================================== -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">Staff</h4> </div>
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
                  <li class="active">Staff</li>
                </ol>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="white-box">
                  <h3 class="box-title">Staff List<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>Add</button></h3>

                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add New Staff</h4>
                        </div>  
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="nama">Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="inama" name="nama">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                   <label style="margin-top: 8px;" for="address">Address</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="iaddress" name="address">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                  <label style="margin-top: 8px;" for="ttl">Place of Birth</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="ip" name="ttl">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                  <label style="margin-top: 8px;" for="ttl">Date of Birth</label>
                                  </div>
                                </div>
                                <div class="col-md-2" style="padding-right: 1px;">
                                <div class="form-group">
                                 <select class="form-control" name="date" id="idate">
                                  <option disabled selected value value="0">Date</option>
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
                                  <option value="13">13 </option>
                                  <option value="14">14 </option>
                                  <option value="15">15 </option>
                                  <option value="16">16 </option>
                                  <option value="17">17 </option>
                                  <option value="18">18 </option>
                                  <option value="19">19 </option>
                                  <option value="20">20 </option>
                                  <option value="21">21 </option>
                                  <option value="22">22 </option>
                                  <option value="23">23 </option>
                                  <option value="24">24 </option>
                                  <option value="25">25 </option>
                                  <option value="26">26 </option>
                                  <option value="27">27 </option>
                                  <option value="28">28 </option>
                                  <option value="29">29 </option>
                                  <option value="30">30 </option>
                                  <option value="31">31 </option>
                                  </select>
                                  </div>
                                </div>
                                <div class="col-md-3" style="padding-right: 3px;padding-left: 3px">
                                <div class="form-group">
                                 <select class="form-control" name="month" id="imonth">
                                  <option disabled selected value value="0">Month</option>
                                  <option value="January">January </option>
                                  <option value="February">February </option>
                                  <option value="March">March </option>
                                  <option value="April">April </option>
                                  <option value="May">May </option>
                                  <option value="June">June </option>
                                  <option value="July">July </option>
                                  <option value="August">August </option>
                                  <option value="September">September </option>
                                  <option value="October">October </option>
                                  <option value="November">November </option>
                                  <option value="December">December </option>
                                  </select>
                                </div>
                                </div>
                                <div class="col-md-3" style="padding-left: 1px;">
                                <div class="form-group">
                                 <select class="form-control" name="year" id="iyear">
                                  <option disabled selected value value="0">Year</option>
                                  <option value="1970">1970 </option>
                                  <option value="1971">1971 </option>
                                  <option value="1972">1972 </option>
                                  <option value="1973">1973 </option>
                                  <option value="1974">1974 </option>
                                  <option value="1975">1975 </option>
                                  <option value="1976">1976 </option>
                                  <option value="1977">1977 </option>
                                  <option value="1978">1978 </option>
                                  <option value="1979">1979 </option>
                                  <option value="1980">1980 </option>
                                  <option value="1981">1981 </option>
                                  <option value="1982">1982 </option>
                                  <option value="1983">1983 </option>
                                  <option value="1984">1984 </option>
                                  <option value="1985">1985 </option>
                                  <option value="1986">1986 </option>
                                  <option value="1987">1987 </option>
                                  <option value="1988">1988 </option>
                                  <option value="1989">1989 </option>
                                  <option value="1990">1990 </option>
                                  <option value="1991">1991 </option>
                                  <option value="1992">1992 </option>
                                  <option value="1993">1993 </option>
                                  <option value="1994">1994 </option>
                                  <option value="1995">1995 </option>
                                  <option value="1996">1996 </option>
                                  <option value="1997">1997 </option>
                                  <option value="1998">1998 </option>
                                  <option value="1999">1999 </option>
                                  <option value="2000">2000 </option>
                                  </select>
                                </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="phone">Phone Number</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="iphone" name="phone">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="user">Username</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="iusername" name="user">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <label style="margin-top: 8px;" for="pass">Password</label>
                                </div>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" id="ipass" name="pass">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="insert">Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <div id="showdata"></div>
                  </div>

                  <div id="mEdit" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Edit Staff</h4>
                        </div>  
                        <div class="modal-body">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 text-right"> 
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="nama">ID Staff</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">  
                                    <label style="margin-top: 8px;" for="id" id="eid"></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="nama">Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="enama" name="nama">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="address">Address</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="eaddress" name="address">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label style="margin-top: 8px;" for="ttl">Place of Birth</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="ep" name="ttl">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label style="margin-top: 8px;" for="ttl">Date of Birth</label>
                                  </div>
                                </div>
                                <div class="col-md-2" style="padding-right: 1px;">
                                  <div class="form-group">
                                    <select class="form-control" name="date" id="edate">
                                      <option disabled selected value value="0">Date</option>
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
                                      <option value="13">13 </option>
                                      <option value="14">14 </option>
                                      <option value="15">15 </option>
                                      <option value="16">16 </option>
                                      <option value="17">17 </option>
                                      <option value="18">18 </option>
                                      <option value="19">19 </option>
                                      <option value="20">20 </option>
                                      <option value="21">21 </option>
                                      <option value="22">22 </option>
                                      <option value="23">23 </option>
                                      <option value="24">24 </option>
                                      <option value="25">25 </option>
                                      <option value="26">26 </option>
                                      <option value="27">27 </option>
                                      <option value="28">28 </option>
                                      <option value="29">29 </option>
                                      <option value="30">30 </option>
                                      <option value="31">31 </option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3" style="padding-right: 3px;padding-left: 3px;">
                                  <div class="form-group">
                                    <select class="form-control" name="month" id="emonth">
                                      <option disabled selected value value="0">Month</option>
                                      <option value="January">January </option>
                                      <option value="February">February </option>
                                      <option value="March">March </option>
                                      <option value="April">April </option>
                                      <option value="May">May </option>
                                      <option value="June">June </option>
                                      <option value="July">July </option>
                                      <option value="August">August </option>
                                      <option value="September">September </option>
                                      <option value="October">October </option>
                                      <option value="November">November </option>
                                      <option value="December">December </option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3" style="padding-left: 1px;">
                                  <div class="form-group">
                                    <select class="form-control" name="year" id="eyear">
                                      <option disabled selected value value="0">Year</option>
                                      <option value="1970">1970 </option>
                                      <option value="1971">1971 </option>
                                      <option value="1972">1972 </option>
                                      <option value="1973">1973 </option>
                                      <option value="1974">1974 </option>
                                      <option value="1975">1975 </option>
                                      <option value="1976">1976 </option>
                                      <option value="1977">1977 </option>
                                      <option value="1978">1978 </option>
                                      <option value="1979">1979 </option>
                                      <option value="1980">1980 </option>
                                      <option value="1981">1981 </option>
                                      <option value="1982">1982 </option>
                                      <option value="1983">1983 </option>
                                      <option value="1984">1984 </option>
                                      <option value="1985">1985 </option>
                                      <option value="1986">1986 </option>
                                      <option value="1987">1987 </option>
                                      <option value="1988">1988 </option>
                                      <option value="1989">1989 </option>
                                      <option value="1990">1990 </option>
                                      <option value="1991">1991 </option>
                                      <option value="1992">1992 </option>
                                      <option value="1993">1993 </option>
                                      <option value="1994">1994 </option>
                                      <option value="1995">1995 </option>
                                      <option value="1996">1996 </option>
                                      <option value="1997">1997 </option>
                                      <option value="1998">1998 </option>
                                      <option value="1999">1999 </option>
                                      <option value="2000">2000 </option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="phone">Phone Number</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="ephone" name="phone">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="user">Username</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="eusername" name="user">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="pass">Password</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="epass" name="user">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <label style="margin-top: 8px;" for="status">Status</label>
                                </div>
                                <div class="col-md-8">
                                  <select class="form-control" name="status" id="estatus">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit">Edit</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
          <footer class="footer text-center"> 2017 &copy; S2K Hotel </footer>
        </div>
        <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    $("#<?php echo $_SESSION['page'];?>").addClass("active");
    showdata();

    function showdata()
    {
      $.ajax({
        url     : "staff.php",
        type    : "POST",
        async   : false,
        data    :
        {
          showtable   : 1
        },
        success : function(res)
        {
          $('#showdata').html(res);
        }
      });
    }

    $('#insert').on('click', function (event)
    {
      var bisa = insertcheckvalid();
      var d = $('#idate').val();
      var m = $('#imonth').val();
      var y = $('#iyear').val();
      var tl = (((d.concat(" ")).concat(m)).concat(" ")).concat(y);

      if(bisa == true)
      {
        $.ajax
        ({
            url: "staff.php",
            type: "POST",
            async: false,
            data:
            {
              insert: 1,
              nama:$('#inama').val(),
              address:$('#iaddress').val(),
              ip:$('#ip').val(),
              it:tl,
              phone:$('#iphone').val(),
              username:$('#iusername').val(),
              pass:$('#ipass').val()
            },
            success: function(res)
            {
              alert("Success!");
              showdata();
              $('#inama').val("");
              $('#iaddress').val("");
              $('#ip').val("");
              $('#it').val("");
              $('#iphone').val("");
              $('#iusername').val("");
              $('#ipass').val("");
            }
          });
        };
      });

    $('#edit').on('click', function (event)
    {
      var bisa = editcheckvalid();
      var d = $('#edate').val();
      var m = $('#emonth').val();
      var y = $('#eyear').val();
      var tl = (((d.concat(" ")).concat(m)).concat(" ")).concat(y);

      if(bisa == true)
      {
        $.ajax
        ({
          url: "staff.php",
          type: "POST",
          async: false,
          data: {
            edit: 1,
            id:$('#eid').html(),
            nama:$('#enama').val(),
            address:$('#eaddress').val(),
            ep:$('#ep').val(),
            et:tl,
            phone:$('#ephone').val(),
            username:$('#eusername').val(),
            pass:$('#epass').val(),
            status:$('#estatus').val()
          },
          success: function(res)
          {
            alert("Updated!");
            showdata();
            $('#enama').val("");
            $('#eaddress').val("");
            $('#ep').val("");
            $('#edate').val("");
            $('#emonth').val("");
            $('#eyear').val("");
            $('#ephone').val("");
            $('#eusername').val("");
            $('#epass').val("");
            $('#estatus').val("");
          }
        });
      };
    });

  });
</script>

<script type="text/javascript">

  $('#mEdit').on('show.bs.modal', function (event)
  {
    var button = $(event.relatedTarget);
    var act = parseInt(button.data('act'));

    $.ajax
    ({
      url: "staff.php",
      type: "POST",
      async: false,
      data: {
        select: 1,
        id: act
      },
      success: function(res)
      {
        var tl = res.tanggallahir;
        var d = tl.split(" ");

        $("#eid").html(res.id_staff);
        $('#enama').val(res.nama);
        $('#eaddress').val(res.alamat);
        $('#ep').val(res.tempatlahir);
        $('#edate').val(d[0]);
        $('#emonth').val(d[1]);
        $('#eyear').val(d[2]);
        $('#ephone').val(res.telepon);
        $('#eusername').val(res.user);
        $('#epass').val(res.pass);
        $('#estatus').val(res.status);
      }
    });

  })

</script>

</body>

</html>
