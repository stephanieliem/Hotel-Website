<?php
include "connect.php";
if (!isset($_SESSION['nama'])){
  header("Location: index.php");
}
$cekdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jml FROM fasilitas"));
$_SESSION['page'] = "facilities";
?>

<?php
if(isset($_POST['select']))
{
  $id = $_POST['id'];
  $qselect = mysqli_query($con,"SELECT * FROM fasilitas WHERE id_fasilitas = '".$id."'");
  $qselect = mysqli_fetch_array($qselect);
  header("Content-type: text/x-json");
  echo json_encode($qselect);
  exit();
}

if (isset($_POST['showtable']))
{
 if ($cekdata['jml'] == 0)
 {
   echo "<center><h6>No list of facilities.</h6></center>";
 }
 else
 {
  echo "
  <table class='table table-hover' id='myTable' style='width: 100%;''>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Price</th>
        <th class='text-right'>Action</th>
      </tr>
    </thead>
    <tbody>";
      $datarev = mysqli_query($con, "SELECT * FROM fasilitas");
      while ($row = mysqli_fetch_assoc($datarev))
      {
        echo "<tr>";
        echo "<td>".$row['id_fasilitas']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['deskripsi']."</td>";
        echo "<td><img class='responsive' style='width:200px; height:auto;' src='../".$row['image']."'></td>";
        echo "<td>".$row['harga']."</td>";
        echo "<td class='col-md-2 text-right'><a class='btn btn-success btn-sm' style='margin-right:5px;' data-target='#mEdit' data-toggle='modal' data-act='".$row['id_fasilitas']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";             

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
              <h4 class="page-title">Facilities</h4> </div>
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
                  <li class="active">Facilities</li>
                </ol>
              </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="white-box">
                  <h3 class="box-title">Facilities List<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>Add</button></h3>
                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <form id="uploadimage" method="post" enctype="multipart/form-data" action="">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New Facilities</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group"> 
                                      <label style="margin-top: 8px;" for="nama">Name</label>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group">  
                                      <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2">
                                    <label style="margin-top: 13px;" for="deskripsi">Desc</label>
                                  </div>
                                  <div class="col-md-10">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group"> 
                                      <label style="margin-top: 8px;" for="image">Image</label>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group"> 
                                      <input type="file" class="btn btn-default" name="images" id="images" style="width: 100%;">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2">
                                    <label style="margin-top: 8px;" for="harga">Price</label>
                                  </div>
                                  <div class="col-md-10">
                                    <input type="number" class="form-control" id="harga" name="harga">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Submit" id="insert">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div id="mEdit" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <form id="edit" method="post" enctype="multipart/form-data" action="">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Facilities</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group"> 
                                      <label style="margin-top: 8px;" for="id">Id</label>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group">  
                                      <label style="margin-top: 8px;" for="id" id="eid"></label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group"> 
                                      <label style="margin-top: 8px;" for="nama">Name</label>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group">  
                                      <input type="text" class="form-control" id="enama" name="enama">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2">
                                    <label style="margin-top: 13px;" for="deskripsi">Desc</label>
                                  </div>
                                  <div class="col-md-10">
                                    <textarea class="form-control" id="edeskripsi" name="edeskripsi"></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group"> 
                                      <label style="margin-top: 8px;" for="image">Image</label>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group"> 
                                      <input type="file" class="btn btn-default" name="eimages" id="eimages" style="width: 100%;">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-2">
                                    <label style="margin-top: 8px;" for="harga">Price</label>
                                  </div>
                                  <div class="col-md-10">
                                    <input type="number" class="form-control" id="eharga" name="eharga">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Submit" id="edit">
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>

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
    $(document).ready(function(e) {

      $("#<?php echo $_SESSION['page'];?>").addClass("active");   

      showdata();

      function showdata()
      {
       $.ajax({
         url     : "facilities.php",
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
     $("#insert").click((function(e)
     {

       var name= document.getElementById('images');
       var alpha=name.files[0];
       console.log(alpha.name);

       var data= new FormData();
       data.append('file',alpha);

       var n = document.getElementById('nama').value;
       var d = document.getElementById('deskripsi').value;
       var p = document.getElementById('harga').value;
       data.append('name',n);
       data.append('desc',d);
       data.append('price',p);

       e.preventDefault();

       $.ajax
       ({
            url: "addfaci.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            async : false,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              //alert(data);
              alert("Success");
              showdata();
            }
          });
      }));

      $("#edit").click((function(e)
      {
       var name= document.getElementById('eimages');
       var alpha=name.files[0];
       console.log(alpha.name);

       var data= new FormData();
       data.append('file',alpha);

       var n = document.getElementById('enama').value;
       var id = $('#eid').html();
       var d = document.getElementById('edeskripsi').value;
       var p = document.getElementById('eharga').value;

       data.append('name',n);
       data.append('desc',d);
       data.append('price',p);
       data.append('id',id);

       e.preventDefault();

       $.ajax
       ({
            url: "editfaci.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            async : false,
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
              //alert(data);
              //alert("Updated");
              showdata();
            }
          });
        }));
   });


 </script>
 
 <script type="text/javascript">

  $('#mEdit').on('show.bs.modal', function (event)
  {
    var button = $(event.relatedTarget);
    var act = parseInt(button.data('act'));

    $.ajax
    ({
      url: "facilities.php",
      type: "POST",
      async: false,
      data: {
        select: 1,
        id: act
      },
      success: function(res)
      {
        $("#eid").html(res.id_fasilitas);
        $('#enama').val(res.nama);
        $('#eharga').val(res.harga);
        $('#edeskripsi').val(res.deskripsi);
      }
    });

  })

</script>

</body>

</html>
