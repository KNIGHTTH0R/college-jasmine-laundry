<?php
	require "../../php/connection.php";
	$no_nota = $_GET['no_nota'];
	$id = $_GET['id'];
			
	$strQuery = "DELETE FROM nota_jeniscucian WHERE nota_jeniscucian_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../transaksi_detail.php?no_nota=$no_nota'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../transaksi_detail.php?no_nota=$no_nota'</script>";
		mysqli_close($connection);
	}
?>