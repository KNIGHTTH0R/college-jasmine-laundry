<?php
	require "../../php/connection.php";
    session_start();
    $strQuery = "SELECT n.nota_id, p.pelanggan_nama, a.agen_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                    FROM transaksi n
                    INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                    INNER JOIN agen a ON p.agen_id = a.agen_id
                    WHERE p.agen_id = $_SESSION[agen_id] AND n.nota_id = $_GET[no_nota] AND n.nota_deleted = 'false'";
    $query = mysqli_query($connection, $strQuery);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>
	<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Jasmine Laundry</title>
	</head>
		<body>
        <br/>
		<?php
		echo "<h1>Jasmine Laundry</h1>"; 
		echo '<table border="0">
		  <tr>
		    <td width="100">No. Nota</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['nota_id'].'</td>
		  </tr>
		</table>';
        echo '<table border="0">
		  <tr>
		    <td width="100">Nama</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['pelanggan_nama'].'</td>
		  </tr>
		</table>';
        echo '<table border="0">
		  <tr>
		    <td width="100">Tanggal Masuk</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['nota_tgl_masuk'].'</td>
		  </tr>
		</table>';
        echo '<table border="0">
		  <tr>
		    <td width="100">Tanggal Selesai</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['nota_tgl_selesai'].'</td>
		  </tr>
		</table>';
        echo '<table border="0">
		  <tr>
		    <td width="100">Status</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['nota_status'].'</td>
		  </tr>
		</table>';

        ?>
        <br/>
        <table border="1">
            <tr>
                <td colspan="4" style="text-align:center;"><b>Detail Transaksi</b></td>
            </tr>
            <tr>
                <td width="100"><b>Jenis Cucian</b></td>
                <td width="100"><b>Harga</b></td>
                <td width="100"><b>Jumlah</b></td>
                <td width="100"><b>Subtotal</b></td>
            </tr>
            <tbody>
                <?php
                $strSubQuery = "SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, jc.jeniscucian_harga, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                    FROM nota_jeniscucian njc
                                    INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                    INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                    WHERE njc.nota_id = $_GET[no_nota] AND n.nota_deleted = 'false'";
                $subQuery = mysqli_query($connection, $strSubQuery);
                while($subResult = mysqli_fetch_assoc($subQuery)){
                    echo "<tr>";
                    echo "<td>$subResult[jeniscucian_nama]</td>";
                    echo "<td>Rp. $subResult[jeniscucian_harga]</td>";
                    echo "<td>$subResult[nota_jeniscucian_jumlah]</td>";
                    echo "<td>$subResult[nota_jeniscucian_subtotal]</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
            $strSubQuery2 = "SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                                        FROM nota_jeniscucian njc
                                                        INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                                        INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                                        WHERE njc.nota_id = $_GET[no_nota] AND n.nota_deleted = 'false'";
            $subQuery2 = mysqli_query($connection, $strSubQuery2);
            $total = 0;
            while($subResult2 = mysqli_fetch_assoc($subQuery2)){
                $total += $subResult2['nota_jeniscucian_subtotal'];
            }
            echo '<table border="0">
                <tr>
                    <td width="100">Total Bayar</td>
                    <td width="10">:</td>
                    <td width="250">Rp. '.$total.'</td>
                </tr>
            </table>';
		    echo "<p align='right' style=\"margin-top: 72px;\">".$result['agen_nama']."<br/>".date("Y-m-d")."</p>";
        ?>
		</body>
	</html>
	<!-- Akhir halaman HTML yang akan di konvert -->
	
	<?php
		$filename="".$result[nota_id].".pdf";
		$content = ob_get_clean();
		$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
		 require_once('../../html2pdf/html2pdf.class.php');
		 try
		 {
		  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		  $html2pdf->setDefaultFont('Arial');
		  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		  $html2pdf->Output($filename);
		 }
		 catch(HTML2PDF_exception $e) { echo $e; }
	?>