<?php
	require "../../php/connection.php";
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$encPassword = md5($password);
			
	$strQuery = "INSERT INTO login VALUES(null, '$username', '$password', '2')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
    	$login_id = mysqli_insert_id($connection);
		$strQuery = "INSERT INTO agen VALUES(null, '$nama', 'false', $login_id)";
		$query = mysqli_query($connection, $strQuery);
		if($query){
			echo "<script language=javascript>document.location.href='../agen.php'</script>";
			mysqli_close($connection);
		}else{
			echo "<script language=javascript>document.location.href='../agen.php'</script>";
			mysqli_close($connection);
		}
	}else{
		echo "<script language=javascript>document.location.href='../agen.php'</script>";
		mysqli_close($connection);
	}
?>