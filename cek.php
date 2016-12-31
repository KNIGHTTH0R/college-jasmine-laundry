<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-text">
            <h3><a href="cek.php" style="color: #C0C0C0;" onMouseOver="this.style.color='#68B3C8'" onMouseOut="this.style.color='#C0C0C0'">Halaman Cek Transaksi</a></h3>
            <p>
                <font size="2">Silahkan masukkan nomer nota anda</font>
            </p>
        </div>
        <form class="form-signin" method="POST" action="php/cek_proses.php">
            <!--<img src="img/logo.png" width="90px" style="margin-bottom: 20px;"/>-->
            <input class="form-control" type="text" name="no_nota" placeholder="No. Nota" required/>
            <input class="btn btn-primary" type="submit" value="Cek" style="padding: 14px 20px; margin-top: 20px;"
                required/>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>