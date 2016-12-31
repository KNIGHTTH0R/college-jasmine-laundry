<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "UPDATE pelanggan SET pelanggan_deleted = 'true' WHERE pelanggan_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../pelanggan.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../pelanggan.php'</script>";
		mysqli_close($connection);
	}
?>