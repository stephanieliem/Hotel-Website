<?php

include "connect.php";

if((isset($_FILES["file1"]["type"])) && (isset($_FILES["file2"]["type"])) && (isset($_FILES["file3"]["type"])))
{
	$validextensions1 = array("jpeg", "jpg", "png");
	$validextensions2 = array("jpeg", "jpg", "png");
	$validextensions3 = array("jpeg", "jpg", "png");

	$temporary1 = explode(".", $_FILES["file1"]["name"]);
	$temporary2 = explode(".", $_FILES["file2"]["name"]);
	$temporary3 = explode(".", $_FILES["file3"]["name"]);
	
	$file_extension1 = end($temporary1);
	$file_extension2 = end($temporary2);
	$file_extension3 = end($temporary3);

	if (((($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/jpg") || ($_FILES["file1"]["type"] == "image/jpeg")) && ($_FILES["file1"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension1, $validextensions1)) 
		|| ((($_FILES["file2"]["type"] == "image/png") || ($_FILES["file2"]["type"] == "image/jpg") || ($_FILES["file2"]["type"] == "image/jpeg")) && ($_FILES["file2"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension2, $validextensions2))
		|| ((($_FILES["file3"]["type"] == "image/png") || ($_FILES["file3"]["type"] == "image/jpg") || ($_FILES["file3"]["type"] == "image/jpeg")) && ($_FILES["file3"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension3, $validextensions3))) 
	{
		if (($_FILES["file1"]["error"] > 0) || ($_FILES["file2"]["error"] > 0) || ($_FILES["file3"]["error"] > 0))
		{
			echo "Return Code: " . $_FILES["file1"]["error"] . "<br/><br/>";
			echo "Return Code: " . $_FILES["file2"]["error"] . "<br/><br/>";
			echo "Return Code: " . $_FILES["file3"]["error"] . "<br/><br/>";
		}
		else
		{
			$sourcePath1 = $_FILES['file1']['tmp_name']; // Storing source path of the file in a variable
			$targetPath1 = "/home/m26415039/public_html/tekweb/uploadimages/".$_FILES['file1']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath1,$targetPath1) ; // Moving Uploaded file
			//echo "<span id='success'>Image 1 Uploaded Successfully...!!</span><br/>";

			$sourcePath2 = $_FILES['file2']['tmp_name']; // Storing source path of the file in a variable
			$targetPath2 = "/home/m26415039/public_html/tekweb/uploadimages/".$_FILES['file2']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath2,$targetPath2) ; // Moving Uploaded file
			//echo "<span id='success'>Image 2 Uploaded Successfully...!!</span><br/>";

			$sourcePath3 = $_FILES['file3']['tmp_name']; // Storing source path of the file in a variable
			$targetPath3 = "/home/m26415039/public_html/tekweb/uploadimages/".$_FILES['file3']['name']; // Target path where file is to be stored
			move_uploaded_file($sourcePath3,$targetPath3) ; // Moving Uploaded file
			//echo "<span id='success'>Image 3 Uploaded Successfully...!!</span><br/>";



			$nama = $_POST['name'];
			$desc = $_POST['desc'];
			$price = $_POST['price'];
			$size = $_POST['size'];
			$imname1 = "uploadimages/".$_FILES['file1']['name'];
			$imname2 = "uploadimages/".$_FILES['file2']['name'];
			$imname3 = "uploadimages/".$_FILES['file3']['name'];

			$qselect = mysqli_query($con,"INSERT INTO tipe(id_tipe, ukuran, nama, deskripsi, image1, image2, image3, harga) values(null, '$size', '$nama','$desc', '$imname1', '$imname2', '$imname3', '$price')");  
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