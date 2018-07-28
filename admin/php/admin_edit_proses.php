<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$login_id = $_POST['login_id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
			
	mysqli_query($connection, "SET AUTOCOMMIT=0");
	mysqli_query($connection, "START TRANSACTION");

	$strQuery = "UPDATE admin SET admin_nama = '$nama' WHERE admin_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){		
		if(!empty($password)){
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
		}else {
			$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
		}		
		$query = mysqli_query($connection, $strQuery);
		if($query){
			mysqli_query($connection, "COMMIT");
		}else {
			mysqli_query($connection, "ROLLBACK");
			echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Login Admin');</script>";
		}
	}else{
		mysqli_query($connection, "ROLLBACK");
		echo "<script language=javascript>alert('Terjadi Kesalahan Saat Mengupdate Data Admin');</script>";
	}
	
	mysqli_query($connection, "SET AUTOCOMMIT=1");
	echo "<script language=javascript>document.location.href='../admin.php'</script>";
	mysqli_close($connection);
?>