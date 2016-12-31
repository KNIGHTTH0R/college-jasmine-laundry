<?php
	require "../../php/connection.php";
	session_start();
	$id = $_POST['id'];
	$login_id = $_POST['login_id'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
			
	$strQuery = "UPDATE admin SET admin_nama = '$nama' WHERE admin_id = $id";
	$query = mysqli_query($connection, $strQuery);
	if($query){		
		$_SESSION['admin_nama'] = $nama;
		if(!empty($password)){
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username', login_password = '$encPassword' WHERE login_id = $login_id";
			$query = mysqli_query($connection, $strQuery);
		}else {
			$encPassword = md5($password);
			$strQuery = "UPDATE login SET login_username = '$username' WHERE login_id = $login_id";
			$query = mysqli_query($connection, $strQuery);
		}		
		echo "<script language=javascript>document.location.href='../profil_edit.php'</script>";
		mysqli_close($connection);
	}else{
		echo "<script language=javascript>document.location.href='../profil_edit.php'</script>";
		mysqli_close($connection);
	}
?>