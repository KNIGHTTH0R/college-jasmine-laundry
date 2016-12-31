<?php
	require "../../php/connection.php";
	$no_nota = $_POST['no_nota'];
	$pelanggan_id = $_POST['pelanggan_id'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$tgl_selesai = $_POST['tgl_selesai'];
			
	$strQuery = "INSERT INTO nota(nota_id, pelanggan_id, nota_tgl_masuk, nota_tgl_selesai) 
	VALUES('$no_nota', '$pelanggan_id', '$tgl_masuk', '$tgl_selesai')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../transaksi_tambah_cucian.php?no_nota=$no_nota'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../transaksi.php'</script>";
		mysqli_close($connection);
	}
?>