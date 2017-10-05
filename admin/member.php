<?php
include "connect.php";
if (!isset($_SESSION['nama'])){
  header("Location: index.php");
}
$cekdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jml FROM member"));
$_SESSION['page'] = "member";
?>

<?php

if (isset($_POST['showtable']))
{
  if ($cekdata['jml'] == 0)
  {
    echo "<center><h6>No list of member.</h6></center>";
  }
  else
  { 
    echo "
    <table class='table table-hover' id='myTable' style='width: 100%;''>
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th class='text-right'>Action</th>
        </tr>
      </thead>
      <tbody>";
        $datarev = mysqli_query($con, "SELECT * FROM member");
        while ($row = mysqli_fetch_assoc($datarev))
        {
          echo "<tr>";
          echo "<td>".$row['id_member']."</td>";
          echo "<td>".$row['firstname']."</td>";
          echo "<td>".$row['lastname']."</td>";
          echo "<td>".$row['alamat']."</td>";
          echo "<td>".$row['telepon']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td class='col-md-2 text-right'><a class='btn btn-success btn-sm' style='margin-right:5px;' data-target='#mEdit' data-toggle='modal' data-act='".$row['id_member']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
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
    $qselect = mysqli_query($con,"SELECT * FROM member WHERE id_member = '".$id."'");
    $qselect = mysqli_fetch_array($qselect);
    header("Content-type: text/x-json");
    echo json_encode($qselect);
    exit();
  }

  if(isset($_POST['insert']))
  {
    $fnama=$_POST['fnama'];
    $lnama=$_POST['lnama'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $qselect = mysqli_query($con,"INSERT INTO member(firstname, lastname, alamat, telepon, email, username, password) values('$fnama', '$lnama','$address', '$phone', '$email', '$username', '$pass')");
    exit();
  }

  if(isset($_POST['edit']))
  {
    $id=$_POST['id'];
    $fnama=$_POST['fnama'];
    $lnama=$_POST['lnama'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $qselect = mysqli_query($con,"UPDATE member SET firstname='$fnama', lastname='$lnama', alamat='$address', telepon='$phone', email='$email', username='$username', password='$password' where id_member = '".$id."'");
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
      var firstname = document.getElementById("ifnama").value;
      if (firstname == "")
      {
          alert("Firstname must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Firstname must not contain numbers or special characters');
         return false;
      }

      var lastname = document.getElementById("ilnama").value;
      if (lastname == "")
      {
          alert("Lastname must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Lastname must not contain numbers or special characters');
         return false;
      }

      var address = document.getElementById("iaddress").value;
      if (address == "")
      {
          alert("Address must be filled out");
          return false;
      }

      var email = document.getElementById("iemail").value;
      if (email == "")
      {
          alert("Email must be filled out");
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
      var firstname = document.getElementById("efnama").value;
      if (firstname == "")
      {
          alert("Firstname must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Firstname must not contain numbers or special characters');
         return false;
      }

      var lastname = document.getElementById("elnama").value;
      if (lastname == "")
      {
          alert("Lastname must be filled out");
          return false;
      }
      if (!firstname.match(/^[a-zA-Z_\s]+$/))
      {
         alert('Lastname must not contain numbers or special characters');
         return false;
      }

      var address = document.getElementById("eaddress").value;
      if (address == "")
      {
          alert("Address must be filled out");
          return false;
      }

      var email = document.getElementById("eemail").value;
      if (email == "")
      {
          alert("Email must be filled out");
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
              <h4 class="page-title">Member</h4> </div>
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
                  <li class="active">Member</li>
                </ol>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="white-box">
                  <h3 class="box-title">Member List<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>Add</button></h3>
                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add New Member</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="fnama">First Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="ifnama" name="ifnama">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="lnama">Last Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="ilnama" name="ilnama">
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
                                    <label style="margin-top: 8px;" for="email">Email</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="email" class="form-control" id="iemail" name="email">
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
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="pass">Password</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="text" class="form-control" id="ipass" name="pass">
                                  </div>
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
                          <h4 class="modal-title">Edit Member</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="nama">ID Member</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <label style="margin-top: 8px;" for="id" id="eid"></label>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="fnama">First Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="efnama" name="nama">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="lnama">Last Name</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group">  
                                    <input type="text" class="form-control" id="elnama" name="nama">
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
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="email">Email</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="email" class="form-control" id="eemail" name="email">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group"> 
                                    <label style="margin-top: 8px;" for="phone">Phone Number</label>
                                  </div>
                                </div>
                                <div class="col-md-8">
                                  <div class="form-group"> 
                                    <input type="email" class="form-control" id="ephone" name="phone">
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
                                    <input type="email" class="form-control" id="eusername" name="user">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <label style="margin-top: 8px;" for="pass">Password</label>
                                </div>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" id="epass" name="pass">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit">Update</button>
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
        url     : "member.php",
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
    	if(bisa == true)
    	{
    		$.ajax
    		({
		        url: "member.php",
		        type: "POST",
		        async: false,
		        data:
		        {
		          insert: 1,
		          fnama:$('#ifnama').val(),
		          lnama:$('#ilnama').val(),
		          address:$('#iaddress').val(),
		          email:$('#iemail').val(),
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
		          $('#ittl').val("");
		          $('#iemail').val("");
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
    	if(bisa == true)
    	{
    		$.ajax
    		({
		        url: "member.php",
		        type: "POST",
		        async: false,
		        data: {
		          edit: 1,
		          id:$('#eid').html(),
		          fnama:$('#efnama').val(),
		          lnama:$('#elnama').val(),
		          address:$('#eaddress').val(),
		          email:$('#eemail').val(),
		          phone:$('#ephone').val(),
		          username:$('#eusername').val(),
		          pass:$('#epass').val()
		        },
		        success: function(res)
		        {
		          alert("Updated!");
		          showdata();
		          $('#enama').val("");
		          $('#eaddress').val("");
		          $('#ettl').val("");
		          $('#eemail').val("");
		          $('#ephone').val("");
		          $('#eusername').val("");
		          $('#epass').val("");
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
      url: "member.php",
      type: "POST",
      async: false,
      data: {
        select: 1,
        id: act
      },
      success: function(res)
      {
        $("#eid").html(res.id_member);
        $('#efnama').val(res.firstname);
        $('#elnama').val(res.lastname);
        $('#eaddress').val(res.alamat);
        $('#ephone').val(res.telepon);
        $('#eemail').val(res.email);
        $('#eusername').val(res.username);
        $('#epass').val(res.password);
      }
    });

  })

</script>

</body>

</html>
