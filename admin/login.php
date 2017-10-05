<?php
	include '../connect.php';
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$check = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as jml FROM staff WHERE user LIKE '".$user."' AND pass LIKE '".$pass."'"));
	if ($check['jml'] == 1) {
		$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM staff WHERE user LIKE '".$user."' AND pass LIKE '".$pass."'"));
		$_SESSION['stat'] = $data['status'];
		if ($_SESSION['stat'] != 0) {
			$_SESSION['user'] = $user;
			$_SESSION['nama'] = $data['nama'];
			header("Location: reservation.php");
		} else {
			header("Location: logout.php");
		}
	} else {
		header("Location: index.php?stat=1");
	}
?>