<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];

	echo "<script language=javascript>document.location.href='../agen.php?nama=$nama'</script>";
	mysqli_close($connection);
?>