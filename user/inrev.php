<?php
include "connect.php";
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$name_oncard = $_POST['name_oncard'];
$ccnumber = $_POST['ccnumber'];
$ccexmonth = $_POST['ccexmonth'];
$ccexyear = $_POST['ccexyear'];
$ccex = $ccexmonth."/".$ccexyear;
$tglpesan = explode(" - ", $_SESSION['tgl']);
$grandtotal = $_SESSION['grandtotal'];
$_SESSION['card'] = $_POST['typecard'];

$_SESSION['fnama'] = $first_name;
$_SESSION['lnama'] = $last_name;
$_SESSION['email'] = $email;

if ($_POST['typecard'] == "mastercard")
{
	$typecard = 0;
}
else if ($_POST['typecard'] == "visa")
{
	$typecard = 1;
}
$time1 = strtotime($tglpesan[0]);

$newformat1 = date('Y-m-d',$time1);
$time2 = strtotime($tglpesan[1]);

$newformat2 = date('Y-m-d',$time2);
$result = mysqli_query($con,"INSERT INTO reservasi values(NULL, now(), '$first_name', '$last_name', '$mobile', '$email', '$name_oncard', '$ccnumber', '$ccex', '$newformat1', '$newformat2',$grandtotal, $typecard, NULL, 0, 0)");
$maxid = mysqli_fetch_assoc(mysqli_query($con, "SELECT MAX(id_reservasi) as max FROM reservasi"));
for ($i = 1; $i <= $_SESSION['max']; $i++) {
	$gethargakamar = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe = ".$_SESSION['kamar'][$i]));
	$gethargafasilitas = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM fasilitas WHERE id_fasilitas = ".$_SESSION['fasilitas'][$i]));
	$result = mysqli_query($con,"INSERT INTO detail values(NULL, ".$gethargakamar['harga'].", ".$gethargafasilitas['harga'].", ".$maxid['max'].", ".$_SESSION['kamar'][$i].", ".$_SESSION['fasilitas'][$i].")");
}


header("Location: pdf.php")
?>