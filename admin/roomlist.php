<?php
include "connect.php";
if (!isset($_SESSION['nama'])){
	header("Location: index.php");
}
$cekdata = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS jml FROM kamar"));
$_SESSION['page'] = "roomlist";
?>

<?php

if (isset($_POST['showtable']))
{
	if ($cekdata['jml'] == 0)
	{
		echo "<center><h6>No list of room list.</h6></center>";
	}
	else
	{	
		echo "
		<table class='table table-hover' id='myTable' style='width: 100%;''>
			<thead>
				<tr>
					<th>Room ID</th>
					<th>Type</th>
					<th class='text-right';>Action</th>
				</tr>
			</thead>
			<tbody>";
				$datarev = mysqli_query($con, "SELECT * FROM kamar JOIN tipe on kamar.id_tipe = tipe.id_tipe");
				while ($row = mysqli_fetch_assoc($datarev))
				{
					echo "<tr>";
					echo "<td class='col-md-3'>".$row['id_kamar']."</td>";
					echo "<td class='col-md-4'>".$row['nama']."</td>";
					echo "<td class='col-md-2 text-right'><a class='btn btn-success btn-sm' style='margin-right:5px;' data-target='#mEdit' data-toggle='modal' data-act='".$row['id_kamar']."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
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
		$qselect = mysqli_query($con,"SELECT * FROM kamar JOIN tipe on kamar.id_tipe = tipe.id_tipe WHERE id_kamar = '".$id."'");
		$qselect = mysqli_fetch_array($qselect);
		header("Content-type: text/x-json");
		echo json_encode($qselect);
		exit();
	}

	if(isset($_POST['insert']))
	{
		$id=$_POST['id'];
		$tipe=$_POST['tipe'];
		$qselect = mysqli_query($con,"INSERT INTO kamar(id_kamar,id_tipe) values('$id', '$tipe')");
		exit();
	}

	if(isset($_POST['edit']))
	{
		$id=$_POST['id'];
		$tipe=$_POST['tipe'];
		$qselect = mysqli_query($con,"UPDATE kamar SET id_tipe='$tipe' where id_kamar = '".$id."'");
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
		var listid = document.getElementById("listid").value;
    	if (listid == "")
    	{
        	alert("Room ID must be filled out");
        	return false;
    	}

    	var listtipe = document.getElementById("listtipe");
        var val1 = listtipe.options[listtipe.selectedIndex].value;
        if(val1==0)
        {
            alert("Room type must be selected");
            return false;
        }
        return true;
	}
	function editcheckvalid()
	{
    	var edittipe = document.getElementById("edittipe");
        var val1 = edittipe.options[edittipe.selectedIndex].value;
        if(val1==0)
        {
            alert("Room type must be selected");
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
						<h4 class="page-title">Room List</h4> </div>
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<!-- <li><a href="dashboard.php">Dashboard</a></li> -->
								<li>Room</li>
								<li class="active">Room List</li>
							</ol>
						</div>
						<!-- /.col-lg-12 -->
					</div>
					<!-- /row -->
					<div class="row">
						<div class="col-sm-12">
							<div class="white-box">
								<h3 class="box-title">Room List<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i>Add</button></h3>
								<div id="myModal" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Add New Room</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-5">
														<div class="row">
															<div class="col-md-3 text-right"> 
																<label style="margin-top: 8px;" for="id">ID</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" id="listid" name="id" placeholder="Room ID" style="width:200px;">
															</div>
														</div>
													</div>
													<div class="col-md-7">
														<div class="row">
															<div class="col-md-3 text-right">
																<label style="margin-top: 8px;" for="type">Type</label>
															</div>
															<div class="col-md-9">
																<select id="listtipe" class="form-control" style="width:200px;">
																	<?php
																	$tipe = mysqli_query($con, "SELECT * FROM tipe");
																	while ($row = mysqli_fetch_assoc($tipe))
																	{
																		echo "<option value=".$row['id_tipe'].">".$row['nama']."</option>";
																	}


																	?>
																</select>
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
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Edit Room</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-5">
														<div class="row">
															<div class="col-md-3 text-right"> 
																<label style="margin-top: 8px;" for="id">ID</label>
															</div>
															<div class="col-md-9">
																<label style="margin-top: 8px;" for="id" id="editid"></label>
															</div>
														</div>
													</div>
													<div class="col-md-7">
														<div class="row">
															<div class="col-md-3 text-right">
																<label style="margin-top: 8px;" for="type">Type</label>
															</div>
															<div class="col-md-9">
																<select id="edittipe" class="form-control" style="width:200px;">
																	<?php
																	$tipe = mysqli_query($con, "SELECT * FROM tipe");
																	while ($row = mysqli_fetch_assoc($tipe))
																	{
																		echo "<option value=".$row['id_tipe'].">".$row['nama']."</option>";
																	}


																	?>
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
			$( document ).ready(function()
			{
				$("#<?php echo $_SESSION['page'];?>").addClass("active"); 
				showdata();

				function showdata()
				{
					$.ajax({
						url     : "roomlist.php",
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
							url: "roomlist.php",
							type: "POST",
							async: false,
							data:
							{
								insert: 1,
								id:$('#listid').val(),
								tipe:$('#listtipe').val()
							},
							success: function(res)
							{
								alert("Success!");
								showdata();
								$('#listid').val("");
								$('#listtipe').val("");
							}
						});
					}
				});

				$('#edit').on('click', function (event)
				{
					var bisa = editcheckvalid();
      				if(bisa == true)
      				{
      					$.ajax
						({
							url: "roomlist.php",
							type: "POST",
							async: false,
							data: {
								edit: 1,
								id:$('#editid').html(),
								tipe:$('#edittipe').val()
							},
							success: function(res)
							{
								alert("Updated!");
								showdata();
								$('#editid').val("");
								$('#edittipe').val("");
							}
						});
					}
				});
			});
		</script>

		<script type="text/javascript">

			$('#mEdit').on('show.bs.modal', function (event)
			{
				var button = $(event.relatedTarget);
				var act = button.data('act');
				
				$.ajax
				({
					url: "roomlist.php",
					type: "POST",
					async: false,
					data: {
						select: 1,
						id: act
					},
					success: function(res)
					{
						$("#editid").html(res.id_kamar);
						$("#edittipe").val(res.id_tipe);
					}
				});

			})

		</script>
	</body>

	</html>
