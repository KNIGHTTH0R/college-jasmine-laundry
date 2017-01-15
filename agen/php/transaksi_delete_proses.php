<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "UPDATE transaksi SET nota_deleted = 'true' WHERE nota_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menghapus Data Transaksi');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../transaksi.php'</script>";
	mysqli_close($connection);
?>