<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
	
	mysqli_begin_transaction($connection, MYSQLI_TRANS_START_READ_WRITE);
	mysqli_autocommit($connection, FALSE);

	$strQuery = "INSERT INTO login VALUES(null, '$username', '$encPassword', '2')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
    	$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO agen VALUES($login_id, '$nama', 'false')";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			mysqli_commit($connection);	
		}else {
			mysqli_rollback($connection);
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Agen');</script>";
		}
	}else{
		mysqli_rollback($connection);
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Login Agen');</script>";
	}
	
	
	mysqli_autocommit($connection, TRUE);
	echo "<script language=javascript>document.location.href='../agen.php'</script>";
	mysqli_close($connection);
?>