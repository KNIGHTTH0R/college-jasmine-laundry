<?php
	require "../../php/connection.php";
	$namacucian = $_POST['namacucian'];
	$harga = $_POST['harga'];
			
	$strQuery = "INSERT INTO jeniscucian VALUES(null,'$namacucian','$harga', 'false')";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
		mysql_close();
	}else{
		echo "<script language=javascript>document.location.href='../jeniscucian.php'</script>";
	}
?>