<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
	
	mysqli_query($connection, "SET AUTOCOMMIT=0");
	mysqli_query($connection, "START TRANSACTION");

	$strQuery = "INSERT INTO login VALUES(null, '$username', '$encPassword', '2')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
    	$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO agen VALUES($login_id, '$nama', 'false')";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			mysqli_query($connection, "COMMIT");
		}else {
			mysqli_query($connection, "ROLLBACK");
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Agen');</script>";
		}
	}else{
		mysqli_query($connection, "ROLLBACK");
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Login Agen');</script>";
	}
	
	
	mysql_query("SET AUTOCOMMIT=1");
	echo "<script language=javascript>document.location.href='../agen.php'</script>";
	mysqli_close($connection);
?>