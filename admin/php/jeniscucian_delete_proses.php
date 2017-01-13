<?php
	require "../../php/connection.php";
	$id = $_GET['id'];
			
	$strQuery = "UPDATE jeniscucian SET jeniscucian_deleted = 'true' WHERE jeniscucian_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
		mysqli_close($connection);
	}
?>