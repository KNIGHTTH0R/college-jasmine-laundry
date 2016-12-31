<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$agen_id = $_POST['agen_id'];
			
	$strQuery = "INSERT INTO pelanggan(pelanggan_nama, pelanggan_alamat, pelanggan_notelp, agen_id) 
	VALUES('$nama', '$alamat', '$no_telp', '$agen_id')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../pelanggan.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../pelanggan.php'</script>";
		mysqli_close($connection);
	}
?>