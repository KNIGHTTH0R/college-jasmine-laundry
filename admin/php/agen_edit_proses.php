<?php
	require "../../php/connection.php";
	$id = $_POST['id'];
	$login_id = $_POST['login_id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
			
	$strQuery = "UPDATE agen SET agen_nama = '$nama' WHERE agen_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){		
		if(!empty($password)){
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
			$query = mysqli_query($connection, $strQuery);
		}else {
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
			$query = mysqli_query($connection, $strQuery);
		}		
		echo "<script language=javascript>document.location.href='../agen.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../agen.php'</script>";
		mysqli_close($connection);
	}
?>