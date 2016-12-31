<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$id = $_POST['id'];

	echo "<script language=javascript>document.location.href='../agen_pelanggan.php?nama=$nama&id=$id'</script>";
	mysqli_close($connection);
?>