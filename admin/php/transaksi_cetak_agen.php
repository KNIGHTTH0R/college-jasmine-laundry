<?php
	require "../../php/connection.php";
    session_start();
    $strQuery = "SELECT n.nota_id, p.pelanggan_nama, a.agen_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                        FROM transaksi n
                        INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                        INNER JOIN agen a ON p.agen_id = a.agen_id
                        WHERE p.agen_id = $_GET[id] AND n.nota_deleted = 'false'
                        ORDER BY n.nota_tgl_masuk DESC";
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
		    <td width="100">Agen</td>
		    <td width="10">:</td>
		    <td width="250">'.$result['agen_nama'].'</td>
		  </tr>
		</table>';
        ?>
        <br/>
        <table border="1">
            <tr>
                <td width="65"><b>No Nota</b></td>
                <td width="85"><b>Pelanggan</b></td>
                <td width="85"><b>Masuk</b></td>
                <td width="85"><b>Selesai</b></td>
                <td width="85"><b>Total</b></td>
                <td width="85"><b>Status</b></td>
            </tr>
            <tbody>
                <?php
                $query = mysqli_query($connection, $strQuery);
                $total_dari_segala_total = 0;
                while($result = mysqli_fetch_assoc($query)){
                    echo "<tr>";
                        echo "<td>$result[nota_id]</td>";
                        echo "<td>$result[pelanggan_nama]</td>";
                        echo "<td>$result[nota_tgl_masuk]</td>";
                        echo "<td>$result[nota_tgl_selesai]</td>";
                        $strSubQuery = "SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                            FROM nota_jeniscucian njc
                                            INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                            INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                            WHERE njc.nota_id = $result[nota_id] AND n.nota_deleted = 'false'";
                        $subQuery = mysqli_query($connection, $strSubQuery);
                        $total = 0;
                        while($subResult = mysqli_fetch_assoc($subQuery)){
                            $total += $subResult['nota_jeniscucian_subtotal'];
                        }
                        $total_dari_segala_total += $total;
                        echo "<td>Rp. $total</td>";
                        echo "<td>$result[nota_status]</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
            echo '<table border="0">
                <tr>
                    <td width="100">Total</td>
                    <td width="10">:</td>
                    <td width="250">Rp. '.$total_dari_segala_total.'</td>
                </tr>
            </table>';
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