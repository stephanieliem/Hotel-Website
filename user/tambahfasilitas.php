<?php
	include "connect.php";
	$max = $_SESSION['max'];
	$idfasil = $_POST['idfasil'];
	$current = $_SESSION['current'];
	$_SESSION['fasilitas'][$current] = $idfasil;
	$next = $current+1;
	if ($next > $max) {
		$cek = True;
		for ($i = 1; $i <= $max; $i++) {
			if (isset($_SESSION['kamar'][$i]) || isset($_SESSION['fasilitas'][$i])) {

			}
			else {
				$cek = False;
				header("Location: available.php?room=".$i);
				break;
			}
		}
		if ($cek == True) {
			header("Location: available.php?room=1");
		}
	} else {
		header("Location: available.php?room=".$next);	
	}
?>