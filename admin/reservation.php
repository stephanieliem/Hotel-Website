<?php
    include "connect.php";
    if (!isset($_SESSION['nama'])){
        header("Location: index.php");
    }
    $cekdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jml FROM reservasi"));
    $_SESSION['page'] = "reservation";
?>

<?php

if (isset($_POST['showtable']))
{
  if ($cekdata['jml'] == 0)
  {
    echo "<center><h6>No list of reservation.</h6></center>";
  }
  else
  { 
    echo "
    <div style='width: 100%; overflow-x: auto;'>
    <table class='table table-hover' id='myTable' style='width: 100%;''>
      <thead>
        <tr>
            <th>#</th>
            <th>Reservation Time</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Mobile Phone</th>
            <th>Email</th>
            <th>Name on card</th>
            <th>CreditCard Number</th>
            <th>CreditCard Expired Date</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Total</th>
            <th>Payment Method</th>
            <th>Id Promo</th>
            <th>Id Member</th>
        </tr>
      </thead>
      <tbody>";
        $datarev = mysqli_query($con, "SELECT * FROM reservasi");
        while ($row = mysqli_fetch_assoc($datarev))
        {
            echo "<tr>";
            echo "<td>".$row['id_reservasi']."</td>";
            echo "<td>".$row['waktu_reservasi']."</td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['last_name']."</td>";
            echo "<td>".$row['mobile_phone']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['name_oncard']."</td>";
            echo "<td>".$row['creditcard_number']."</td>";
            echo "<td>".$row['creditcard_ex']."</td>";
            echo "<td>".$row['tgl_in']."</td>";
            echo "<td>".$row['tgl_out']."</td>";
            echo "<td>".$row['total']."</td>";
            if ($row['pembayaran'] == 0)
            {
                echo "<td>Mastercard</td>";  
            }
            else
            {
                echo "<td>Visa</td>";  
            }
            if ($row['id_promo'] == NULL)
            {
                echo "<td>-</td>";  
            }
            else
            {
                echo "<td>".$row['id_promo']."</td>"; 
            }
            echo "<td>".$row['id_member']."</td>";
        }
        echo 
        "</tbody>
      </table>";
    }
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
                        <h4 class="page-title">Reservation</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
                            <li class="active">Reservation</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Reservation List</h3>
                            <div class="table-responsive">
                                <div id="showdata"></div>
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
            url     : "reservation.php",
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

    });
    </script>
</body>

</html>
