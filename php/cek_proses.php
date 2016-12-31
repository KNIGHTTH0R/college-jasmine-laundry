<?php
	$no_nota = $_POST['no_nota'];

	echo "<script language=javascript>document.location.href='../cek_hasil.php?no_nota=$no_nota'</script>";
	mysqli_close($connection);
?>