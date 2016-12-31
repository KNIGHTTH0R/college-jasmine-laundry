<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$namacucian = $_POST['namacucian'];
	$harga = $_POST['harga'];
			
	$strQuery = "UPDATE jeniscucian SET jeniscucian_nama = '$namacucian', jeniscucian_harga = '$harga' WHERE jeniscucian_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){			
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
		mysqli_close($connection);
	}
?>