<?php
	require "../../php/connection.php";
	$no_nota = $_GET['no_nota'];
	$status = $_GET['status'];
			
	$strQuery = "UPDATE nota SET nota_status = '$status' WHERE nota_id = $no_nota";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../transaksi_detail.php?no_nota=$no_nota'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../transaksi_detail.php?no_nota=$no_nota'</script>";
		mysqli_close($connection);
	}
?>