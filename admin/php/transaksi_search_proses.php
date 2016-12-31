<?php
	require "../../php/connection.php";
	$no_nota = $_POST['no_nota'];
	$id = $_POST['id'];

	echo "<script language=javascript>document.location.href='../agen_transaksi.php?no_nota=$no_nota&id=$id'</script>";
	mysqli_close($connection);
?>