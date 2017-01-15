<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "DELETE from login WHERE login_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Admin');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../admin.php'</script>";
	mysqli_close($connection);
?>