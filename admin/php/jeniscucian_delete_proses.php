<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "UPDATE jeniscucian SET jeniscucian_deleted = 'true' WHERE jeniscucian_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Jenis Cucian');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
	mysqli_close($connection);
?>