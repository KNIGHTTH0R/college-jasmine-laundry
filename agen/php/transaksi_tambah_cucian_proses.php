<?php
	require "../../php/connection.php";
	$no_nota = $_POST['no_nota'];
	$jeniscucian_id = $_POST['jeniscucian_id'];
	$jumlah = $_POST['jumlah'];

	$strQuery = "SELECT jeniscucian_id, jeniscucian_nama, jeniscucian_harga FROM jeniscucian WHERE jeniscucian_deleted = 'false' AND jeniscucian_id = $jeniscucian_id";
	$query = mysqli_query($connection, $strQuery);
	$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
	$subtotal = $result['jeniscucian_harga'] * $jumlah;			
		
	$strQuery = "INSERT INTO nota_jeniscucian(nota_jeniscucian_jumlah, nota_jeniscucian_subtotal, nota_id, jeniscucian_id) 
	VALUES('$jumlah', '$subtotal', '$no_nota', '$jeniscucian_id')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		if (isset($_POST['tambah'])) {
			echo "<script language=javascript>document.location.href='../transaksi_tambah_cucian.php?no_nota=$no_nota'</script>";
		} else {
			echo "<script language=javascript>document.location.href='../transaksi_detail.php?no_nota=$no_nota'</script>";
		}
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../transaksi.php'</script>";
		mysqli_close($connection);
	}
?>