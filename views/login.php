<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}

include_once '../includes/koneksi.php';

$config = new Koneksi();
$db = $config->getConnection();

if ($_POST) {
    include_once '../includes/login.inc.php';
    $login = new Login($db);
    $login->userid = $_POST['username'];
    $login->passid = md5($_POST['password']);
    if ($login->login()) {
        $_SESSION["login"] = true;
        header("Location: dashboard.php");
    } else {
        $error = true;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="bg-login">
        <img src="../assets/images/bg-login.jpg" alt="">
    </div>
    <div class="container-login">
        <div class="welcome">
            <img src="../assets/images/set-login.png" alt="">
        </div>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="kotak-login">
                <div class="kotak-isi">
                    <div class="judul">
                        <h1>LOGIN</h1>
                    </div>
                    <?php if (isset($error)) : ?>
                        <div class="error-login">
                            <p>Username atau Password Salah!</p>
                        </div>
                    <?php endif; ?>
                    <div class="input">
                        <div class="input-username">
                            <i class="fa-solid fa-user icon"></i>
                            <input type="text" name="username" id="username" placeholder="Username" autofocus>
                        </div>
                        <div class="input-password">
                            <i class="fa-solid fa-lock icon"></i>
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="btn-login">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>