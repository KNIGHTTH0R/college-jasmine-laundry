<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "UPDATE agen SET agen_deleted = 'true' WHERE agen_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Agen');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../agen.php'</script>";
	mysqli_close($connection);
?>