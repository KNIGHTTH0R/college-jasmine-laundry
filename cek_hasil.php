<?php
    require('php/connection.php');
    if(isset($_GET['no_nota'])) {
        $no_nota = $_GET['no_nota'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-text">
            <h3><a href="cek.php" style="color: #C0C0C0;" onMouseOver="this.style.color='#68B3C8'" onMouseOut="this.style.color='#C0C0C0'">Halaman Cek Transaksi</a></h3>
            <p>
                <font size="2">Berikut detail transaksi anda</font>
            </p>
        </div>
        <br/>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <?php
                                    $strQuery = "SELECT n.nota_id, n.nota_status
                                                    FROM transaksi n
                                                    INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                    INNER JOIN agen a ON p.agen_id = a.agen_id
                                                    WHERE n.nota_id = $no_nota AND n.nota_deleted = 'false'";
                                    $query = mysqli_query($connection, $strQuery);
                                    if($query) {
                                        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
                                        if($result['nota_status'] == "Belum Bayar"){
                                ?>
                                        <a href="#" class="btn btn-danger btn-fill pull-right" style="pointer-events: none;cursor: default;">Belum Bayar</a>
                                        <?php
                                        } else if($result['nota_status'] == "Sudah Bayar"){
                                        ?>
                                            <a href="#" class="btn btn-success btn-fill pull-right" style="pointer-events: none;cursor: default;">Sudah Bayar</a>
                                        <?php
                                        }
                                    }
                                        ?>
                                <h4 class="title">Data Transaksi</h4>
                                <p class="category">Detail data transaksi</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>No Nota</th>
                                        <th>Pelanggan</th>
                                        <th>Masuk</th>
                                        <th>Selesai</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                                    $strQuery = "SELECT n.nota_id, p.pelanggan_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                                                    FROM transaksi n
                                                    INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                    INNER JOIN agen a ON p.agen_id = a.agen_id
                                                    WHERE n.nota_id = $no_nota AND n.nota_deleted = 'false'";
                                                    $query = mysqli_query($connection, $strQuery);
                                                    if($query) {
                                                        $i = 0;
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
                                                            echo "<td>$total</td>";
                                                            echo "<td>$result[nota_status]</td>";
                                                            echo "</tr>";
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List Cucian</h4>
                                <p class="category">List dari cucian yang ada di transaksi</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Jenis Cucian</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                                    $strQuery = "SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                                    FROM nota_jeniscucian njc
                                                    INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                                    INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                                    WHERE njc.nota_id = $no_nota AND n.nota_deleted = 'false'";
                                                    $query = mysqli_query($connection, $strQuery);
                                                    if ($query) {
                                                        $i = 0;
                                                        while($result = mysqli_fetch_assoc($query)){
                                                            echo "<tr>";
                                                            echo "<td>$result[jeniscucian_nama]</td>";
                                                            echo "<td>$result[nota_jeniscucian_jumlah]</td>";
                                                            echo "<td>$result[nota_jeniscucian_subtotal]</td>";
                                                            echo "</tr>";
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php
    }
?>