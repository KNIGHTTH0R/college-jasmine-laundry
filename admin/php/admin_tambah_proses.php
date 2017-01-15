<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
	
	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);

	$strQuery = "INSERT INTO login VALUES(null, '$username', '$encPassword', '1')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
    	$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO admin VALUES($login_id, '$nama')";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			mysqli_commit($connection);	
		}else {
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Admin');</script>";
		}
	}else{
		mysqli_rollback($connection);
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Login Admin');</script>";
	}
	
	
	mysqli_autocommit($connection, TRUE);
	echo "<script language=javascript>document.location.href='../admin.php'</script>";
	mysqli_close($connection);
?>