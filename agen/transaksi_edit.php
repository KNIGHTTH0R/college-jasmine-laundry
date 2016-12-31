<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		echo "<script language=javascript>document.location.href='../index.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'agen')
		    echo "<script language=javascript>document.location.href='../index.php'</script>";
	}

    if(isset($_GET['no_nota'])) {
        $no_nota = $_GET['no_nota'];
        $pelanggan_id = "";
        $pelanggan_nama = "";
        $tgl_masuk = "";
        $tgl_keluar = "";
        $total = 0;
        $status = "";
        $strQuery = "SELECT n.nota_id, p.pelanggan_id, p.pelanggan_nama, n.nota_tgl_masuk, n.nota_tgl_selesai, n.nota_total, n.nota_status
                                                    FROM nota n
                                                    INNER JOIN pelanggan p ON n.pelanggan_id = p.pelanggan_id
                                                    INNER JOIN agen a ON p.agen_id = a.agen_id
                                                    WHERE p.agen_id = $_SESSION[agen_id] AND n.nota_id = $no_nota AND n.nota_deleted = 'false'";
        $query = mysqli_query($connection, $strQuery);
        if($query){
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $no_nota = $result['nota_id'];
            $pelanggan_id = $result['pelanggan_id'];
            $pelanggan_nama = $result['pelanggan_nama'];
            $tgl_masuk = $result['nota_tgl_masuk'];
            $tgl_selesai = $result['nota_tgl_selesai'];
            $total = $result['nota_total'];
            $status = $result['nota_status'];
        }
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
                        <li>
                            <a href="pelanggan.php">
                                <i class="ti-heart"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="transaksi.php">
                                <i class="ti-receipt"></i>
                                <p>Transaksi</p>
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
                            <a class="navbar-brand" href="#">Transaksi</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="profil_edit.php">
                                        <p>
                                            <i class="fa fa-user-circle" style="font-size: 18px;"></i> Hallo,
                                            <?php echo $_SESSION['agen_nama'];?>
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
                    <form method="POST" action="php/transaksi_edit_proses.php">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Edit Transaksi</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>No. Nota</label>
                                                        <input type="text" class="form-control border-input" name="no_nota" placeholder="No. Nota" value="<?php echo $no_nota;?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Pelanggan</label>
                                                        <select class="form-control border-input" name="pelanggan_id">
                                                            <?php
                                                                $strQuery = "SELECT pelanggan_id, pelanggan_nama FROM pelanggan WHERE agen_id = '$_SESSION[agen_id]' AND pelanggan_deleted = 'false'";
                                                                $query = mysqli_query($connection, $strQuery);
                                                                while($result = mysqli_fetch_assoc($query)){
                                                                    if($result['pelanggan_id'] == $pelanggan_id) {
                                                                        echo "<option value=$result[pelanggan_id] selected>$result[pelanggan_nama]</option>";
                                                                    }else {
                                                                        echo "<option value=$result[pelanggan_id]>$result[pelanggan_nama]</option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                        <a href="pelanggan_tambah.php" class="pull-right" style="margin-top: 4px;">Tambah Pelanggan</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tanggal Masuk</label>
                                                        <input type="date" class="form-control border-input" name="tgl_masuk" placeholder="Tanggal Masuk" value="<?php echo $tgl_masuk;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label>
                                                        <input type="date" class="form-control border-input" name="tgl_selesai" placeholder="Tanggal Selesai" value="<?php echo $tgl_selesai;?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 34px;">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control border-input" name="status">
                                                            <?php
                                                                if($status == "Sudah Bayar") {
                                                                    echo "<option value=1 selected>Sudah Bayar</option>";
                                                                    echo "<option value=2>Belum Bayar</option>";
                                                                }else {
                                                                    echo "<option value=1>Sudah Bayar</option>";
                                                                    echo "<option value=2 selected>Belum Bayar</option>";
                                                                }
                                                            ?>                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-center" style="margin-bottom: 34px;">
                                                    <input type="hidden" name="no_nota" value="<?php echo $no_nota?>" />
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Submit Data</button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
        <script src="../js/dashboard.js" type="text/javascript"></script>
        <!--  Modal  -->
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