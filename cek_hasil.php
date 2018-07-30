<?php
    require('php/connection.php');
    if(isset($_GET['no_nota']) && is_numeric($_GET['no_nota'])) {
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
                                    $statement = $connection->prepare("SELECT n.nota_id, n.nota_status
                                                                    FROM transaksi n
                                                                    INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                                    INNER JOIN agen a ON p.agen_id = a.agen_id
                                                                    WHERE n.nota_id = ? AND n.nota_deleted = 'false'");
                                    $statement->bind_param('s', $no_nota);
                                    $statement->execute();
                                    $result = $statement->get_result();
                                    $row = $result->fetch_assoc();
                                    if($row['nota_status'] == "Belum Bayar"){
                                ?>
                                        <a href="#" class="btn btn-danger btn-fill pull-right" style="pointer-events: none;cursor: default;">Belum Bayar</a>
                                <?php
                                    } else if($row['nota_status'] == "Sudah Bayar"){
                                ?>
                                        <a href="#" class="btn btn-success btn-fill pull-right" style="pointer-events: none;cursor: default;">Sudah Bayar</a>
                                <?php
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
                                            $statement = $connection->prepare("SELECT n.nota_id, p.pelanggan_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                                                                                FROM transaksi n
                                                                                INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                                                INNER JOIN agen a ON p.agen_id = a.agen_id
                                                                                WHERE n.nota_id = ? AND n.nota_deleted = 'false'");
                                                    $statement->bind_param('s', $no_nota);
                                                    $statement->execute();
                                                    $result = $statement->get_result();
                                                    while($row = $result->fetch_assoc()){
                                                        echo "<tr>";
                                                        echo "<td>$row[nota_id]</td>";
                                                        echo "<td>$row[pelanggan_nama]</td>";
                                                        echo "<td>$row[nota_tgl_masuk]</td>";
                                                        echo "<td>$row[nota_tgl_selesai]</td>";
                                                        $strSubQuery = "SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                                            FROM nota_jeniscucian njc
                                                            INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                                            INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                                            WHERE njc.nota_id = $row[nota_id] AND n.nota_deleted = 'false'";
                                                        $subQuery = mysqli_query($connection, $strSubQuery);
                                                        $total = 0;
                                                        while($subResult = mysqli_fetch_assoc($subQuery)){
                                                            $total += $subResult['nota_jeniscucian_subtotal'];
                                                        }
                                                        echo "<td>$total</td>";
                                                        echo "<td>$row[nota_status]</td>";
                                                        echo "</tr>";
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
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $statement = $connection->prepare("SELECT njc.nota_jeniscucian_id, jc.jeniscucian_nama, jc.jeniscucian_harga, njc.nota_jeniscucian_jumlah, njc.nota_jeniscucian_subtotal
                                                                                FROM nota_jeniscucian njc
                                                                                INNER JOIN jeniscucian jc ON njc.jeniscucian_id = jc.jeniscucian_id
                                                                                INNER JOIN transaksi n ON njc.nota_id = n.nota_id
                                                                                WHERE njc.nota_id = ? AND n.nota_deleted = 'false'");
                                            $statement->bind_param('s', $no_nota);
                                            $statement->execute();
                                            $result = $statement->get_result();
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<td>$row[jeniscucian_nama]</td>";
                                                echo "<td>$row[jeniscucian_harga]</td>";
                                                echo "<td>$row[nota_jeniscucian_jumlah]</td>";
                                                echo "<td>$row[nota_jeniscucian_subtotal]</td>";
                                                echo "</tr>";
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