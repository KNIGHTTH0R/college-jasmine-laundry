<?php
	require "../../php/connection.php";
	$no_nota = $_POST['no_nota'];

	echo "<script language=javascript>document.location.href='../transaksi.php?no_nota=$no_nota'</script>";
	mysqli_close($connection);
?>