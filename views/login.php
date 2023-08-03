<?php
include_once '../includes/koneksi.php';

$config = new Koneksi();
$db = $config->getConnection();

if ($_POST) {
    include_once 'includes/login.inc.php';
    $login = new Login($db);
    $login->userid = $_POST['username'];
    $login->passid = md5($_POST['password']);
    if ($login->login()) {
        echo "<script>location.href='index.php'</script>";
    } else {
        $msg = "Username / Password tidak sesuai!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="bg-login">
        <img src="../assets/images/bg-login.jpg" alt="">
    </div>
    <div class="container-login">
        <div class="welcome">
            <img src="../assets/images/set-login.png" alt="">
        </div>
        <form action="" method="POST">
            <div class="kotak-login">
                <div class="judul">
                    <h1>LOGIN</h1>
                </div>
                <div class="input">
                    <div class="input-username">
                        <input type="text" name="username" id="username" placeholder="Username" autofocus>
                    </div>
                    <div class="input-password">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="btn-login">
                    <button type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>