<?php
include "connect.php";
$username = $_POST['user'];
$password = $_POST['pass'];

// if ($_SESSION['code'] != NULL)
// {
// 	$promo = $_SESSION['code'];
// 	$result = mysqli_query($con,"INSERT INTO reservasi values(NULL, now(), '$first_name', '$last_name', '$mobile', '$email', '$name_oncard', $ccnumber, '$ccex', '$tglpesan[0]','$tglpesan[1]',$grandtotal, $typecard, $promo, 0, 0)");
// }
// else
// {
	$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as c FROM member where username = '$username' and password = '$password'"));
	if($result['c'] > 0)
	{
		$result1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM member where username = '$username' and password = '$password'"));
	
		$_SESSION['userid'] = $result1['id_member'];

		header("Location:index.php?status=1");	
	}else
	{
		header("Location:index.php?status=2");
	}
	

//}
// if($result)
// 	header("Location: available.php");
?>