<?php
	require "../../php/connection.php";
	$no_nota = $_POST['no_nota'];
	$pelanggan_id = $_POST['pelanggan_id'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$tgl_selesai = $_POST['tgl_selesai'];
	$status = $_POST['status'];
			
	$strQuery = "UPDATE nota SET pelanggan_id = '$pelanggan_id', nota_tgl_masuk = '$tgl_masuk', nota_tgl_selesai = '$tgl_selesai', nota_status = '$status' WHERE nota_id = $no_nota";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../transaksi.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../transaksi.php'</script>";
		mysqli_close($connection);
	}
?>