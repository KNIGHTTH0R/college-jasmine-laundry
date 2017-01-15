<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		echo "<script language=javascript>document.location.href='../index.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'admin')
		    echo "<script language=javascript>document.location.href='../index.php'</script>";
	}

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Jasmine Laundry</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/themify-icons.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="info">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <!--<img src="../img/logo.png" width="60px" />-->
                        <a href="#" class="simple-text">
                        Jasmine Laundry
                    </a>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="dashboard.php">
                                <i class="ti-dashboard"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="agen.php">
                                <i class="ti-user"></i>
                                <p>Agen</p>
                            </a>
                        </li>
                        <li>
                            <a href="jeniscucian.php">
                                <i class="ti-package"></i>
                                <p>Jenis Cucian</p>
                            </a>
                        </li>
                        <li>
                            <a href="admin.php">
                                <i class="ti-user"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                            <a class="navbar-brand" href="#">Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="profil_edit.php">
                                        <p>
                                            <i class="fa fa-user-circle" style="font-size: 18px;"></i> Hallo,
                                            <?php echo $_SESSION['admin_nama'];?>
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="../php/logout.php">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                       <a href="php/transaksi_cetak_agen.php?id=<?php echo $_GET['id'];?>" target="_blank" class="btn btn-info pull-right" style="margin-right: 8px;"><i class="fa fa-print"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#search" class="btn btn-info pull-right" style="margin-right: 8px;"><i class="fa fa-search"></i></a>
                                        <!-- Modal Search -->
                                        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <form method="GET" action="agen_transaksi.php">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Masukkan No. Nota</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>No. Nota</label>
                                                                <input type="text" class="form-control border-input" name="no_nota" placeholder="No. Nota" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?php echo $id;?>">
                                                            <button type="submit" class="btn btn-primary btn-fill">Search</button>
                                                            <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                        <a href="agen.php" class="btn btn-info pull-right" style="margin-right: 8px;"  ><i class="fa fa-arrow-left"></i></a>                                        
                                        <h4 class="title">Data Transaksi</h4>
                                        <p class="category">List dari semua transaksi per agen</p>
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
                                                    if(isset($_GET['no_nota'])){
                                                        $strQuery = "SELECT n.nota_id, p.pelanggan_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                                                        FROM transaksi n
                                                        INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                        INNER JOIN agen a ON p.agen_id = a.agen_id
                                                        WHERE p.agen_id = $id AND n.nota_id = $_GET[no_nota] AND n.nota_deleted = 'false'
                                                        ORDER BY n.nota_tgl_masuk DESC";
                                                    }else {
                                                        $strQuery = "SELECT n.nota_id, p.pelanggan_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_status
                                                        FROM transaksi n
                                                        INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                        INNER JOIN agen a ON p.agen_id = a.agen_id
                                                        WHERE p.agen_id = $id AND n.nota_deleted = 'false'
                                                        ORDER BY n.nota_tgl_masuk DESC";
                                                    }
                                                    $query = mysqli_query($connection, $strQuery);
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
                                                ?>
                                                    <!-- Modal Delete -->
                                                    <div class="modal fade " id="delete<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Apakah Anda Yakin ?</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="../php/agen_delete.php?id=<?php echo " $result[agen_id] ";?>" class="btn btn-primary btn-fill">Yes</a>
                                                                    <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">No</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                <?php
                                                        $i++;
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
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, made with <i class="fa fa-heart heart"></i> by <a href="#">Jasmine Laundry</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!--  Modal  -->
        <script>
            <?php
            for($j= 0 ; $j <= $i; $j++){
        ?>
            $('#delete<?php echo $j;?>').appendTo("body")
            <?php
            }
        ?>
            $('#search').appendTo("body")
        </script>
    </body>

    </html>