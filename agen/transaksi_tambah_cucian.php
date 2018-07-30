<?php
	require "../php/connection.php";
    session_start();
    if(!isset($_SESSION['login_role'])){
		echo "<script language=javascript>document.location.href='../login.php'</script>";
	}

    if(isset($_SESSION['login_role'])){
        if($_SESSION['login_role'] != 'agen')
		    echo "<script language=javascript>document.location.href='../login.php'</script>";
	}


    if(isset($_GET['no_nota'])) {
        $no_nota = $_GET['no_nota'];
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
                    <form method="POST" action="php/transaksi_tambah_cucian_proses.php">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Tambah Transaksi Cucian</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Jenis Cucian</label>
                                                        <select class="form-control border-input" name="jeniscucian_id">
                                                            <?php
                                                                $strQuery = "SELECT jeniscucian_id, jeniscucian_nama, jeniscucian_harga FROM jeniscucian WHERE jeniscucian_deleted = 'false'";
                                                                $query = mysqli_query($connection, $strQuery);
                                                                while($result = mysqli_fetch_assoc($query)){
                                                                    echo "<option value=$result[jeniscucian_id]>$result[jeniscucian_nama] - Rp. $result[jeniscucian_harga]</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Jumlah</label>
                                                        <input type="number" id="jumlah" class="form-control border-input" name="jumlah" placeholder="Jumlah" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 34px;">
                                                </div>
                                                <div class="text-center" style="margin-bottom: 34px;">
                                                    <input type="hidden" name="no_nota" value="<?php echo $no_nota;?>" />
                                                    <button type="submit" name="tambah" value="tambah" class="btn btn-warning btn-fill btn-wd" style="margin-right: 8px;">Tambah Lagi Transaksi Cucian</button>
                                                    <button type="submit" name="selesai" value="selesai" class="btn btn-info btn-fill btn-wd">Submit Data</button>
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