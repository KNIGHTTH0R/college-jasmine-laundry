<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
			
	$strQuery = "UPDATE pelanggan SET pelanggan_nama = '$nama', pelanggan_alamat = '$alamat', pelanggan_notelp = '$no_telp' WHERE pelanggan_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Pelanggan');</script>";
	}
	
	echo "<script language=javascript>document.location.href='../pelanggan.php'</script>";
	mysqli_close($connection);
?>