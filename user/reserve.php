<?php
include "connect.php";

$_SESSION['max'] = $_POST['room'];
$_SESSION['tgl'] = $_POST['daterange'];
// $_SESSION['guest'] = $_POST['guest'];
$_SESSION['choose'] = 'k';
$tglpesan = explode(" - ", $_SESSION['tgl']);
$tglpesan[0] = explode("/", $tglpesan[0]);
$tglpesan[1] = explode("/", $tglpesan[1]);
$_SESSION['checkin'] = $tglpesan[0][2]."-".$tglpesan[0][0]."-".$tglpesan[0][1];
$_SESSION['checkout'] = $tglpesan[1][2]."-".$tglpesan[1][0]."-".$tglpesan[1][1];

$hariini = date('m/d/Y');
$tglhariini = explode("/", $hariini);
$tglhariini[0] = (int)$tglhariini[0];
$tglhariini[1] = (int)$tglhariini[1];
$tglhariini[2] = (int)$tglhariini[2];

$cin[0] = (int)$tglpesan[0][0];
$cin[1] = (int)$tglpesan[0][1];
$cin[2] = (int)$tglpesan[0][2];

$cout[0] = (int)$tglpesan[1][0];
$cout[1] = (int)$tglpesan[1][1];
$cout[2] = (int)$tglpesan[1][2];

$cek = true;

if($tglhariini[2] <= $cin[2])
{
	if($tglhariini[0] <= $cin[0])
	{
		if($tglhariini[1] <= $cin[1])
		{

		}
		else
		{
			// echo "tanggal 1";
			$cek = false;
		}
	}
	else
	{
		// echo "bulan 1";
		$cek = false;
	}
}
else
{
	// echo "tahun 1";
	$cek = false;
}

if($tglhariini[2] <= $cout[2])
{
	if($tglhariini[0] <= $cout[0])
	{
		if($tglhariini[1] <= $cout[1])
		{

		}
		else
		{
			// echo "tangal 2";
			$cek = false;
		}
	}
	else
	{
		// echo "bulan 2";
		$cek = false;
	}
}
else
{
	// echo "tahun 2";
	$cek = false;
}

//set nilai awal
$getcountroom = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM tipe"));
for ($i = 1; $i <= $getcountroom['count']; $i++) {
	$_SESSION['untipe'][$i] = 0;
	$gettotrom = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as tot FROM kamar WHERE id_tipe = ".$i));
	$_SESSION['totalroom'][$i] = $gettotrom['tot'];
	// echo $_SESSION['totalroom'][$i]."<br>";
}
// echo "<br>";
$query = mysqli_query($con, 'SELECT * FROM reservasi WHERE (tgl_in >= "'.$_SESSION['checkin'].'" AND tgl_out <= "'.$_SESSION['checkout'].'") OR (tgl_out >= "'.$_SESSION['checkin'].'" AND tgl_in <= "'.$_SESSION['checkout'].'")');
$getcountroom = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM tipe"));
while ($row = mysqli_fetch_assoc($query)) {
	for ($i = 1; $i <= $getcountroom['count']; $i++) {
		$getdetail = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM detail JOIN tipe ON (detail.id_kamar = tipe.id_tipe) WHERE id_reservasi = ".$row['id_reservasi']." AND id_tipe =".$i));
		$_SESSION['untipe'][$i] += $getdetail['count'];
	}
}
$getcountroom = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as count FROM tipe"));
for ($i = 1; $i <= $getcountroom['count']; $i++) {
	// echo $_SESSION['untipe'][$i]."<br>";
	$_SESSION['avaroom'][$i] = $_SESSION['totalroom'][$i] - $_SESSION['untipe'][$i];
}
if($cek == true)
	header("Location: available.php?room=1");
else
	header("Location: index.php?status=3");
?>