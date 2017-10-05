<?php
	include "connect.php";
	$max = $_SESSION['max'];
	$idkamar = $_POST['idkamar'];
	$current = $_SESSION['current'];
	if (isset($_SESSION['kamar'][$current])) {
		$_SESSION['avaroom'][$_SESSION['kamar'][$current]]++;
	}
	$_SESSION['kamar'][$current] = $idkamar;
	$_SESSION['avaroom'][$idkamar]--;
	header("Location: package.php?facilities=".$current);
?>