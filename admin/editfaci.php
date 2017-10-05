<?php

include "connect.php";

if(isset($_FILES["file"]["type"]))
{
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else
		{
			$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
			$targetPath = "/home/m26415039/public_html/tekweb/uploadimages/".$_FILES['file']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			//echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";

			$nama = $_POST['name'];
			$desc = $_POST['desc'];
			$price = $_POST['price'];
			$id = $_POST['id'];
			$imname = "uploadimages/".$_FILES['file']['name'];

			$qselect = mysqli_query($con,"UPDATE fasilitas SET nama='$nama', deskripsi = '$desc', image = '$imname', harga= '$price' WHERE id_fasilitas = '".$id."'");  
			//echo 'success';
		}
	}
	else
	{
		echo "Invalid file Size or Type";
	}
	exit();
}
else
{
	// $nama = $_POST['nama'];
	// $desc = $_POST['deskripsi'];
	// $harga = $_POST['harga'];
	// $imname = $_FILES['file']['name'];
	echo "Failed to add";
	exit();
}
?>