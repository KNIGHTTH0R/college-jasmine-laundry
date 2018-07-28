<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
	
	mysqli_query($connection, "SET AUTOCOMMIT=0");
	mysqli_query($connection, "START TRANSACTION");

	$strQuery = "INSERT INTO login VALUES(null, '$username', '$encPassword', '1')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
    	$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO admin VALUES($login_id, '$nama')";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			mysqli_query($connection, "COMMIT");
		}else {
			mysqli_query($connection, "ROLLBACK");
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Admin');</script>";
		}
	}else{
		mysqli_query($connection, "ROLLBACK");
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Menambahkan Data Login Admin');</script>";
	}
	
	
	mysqli_query($connection, "SET AUTOCOMMIT=1");
	echo "<script language=javascript>document.location.href='../admin.php'</script>";
	mysqli_close($connection);
?>