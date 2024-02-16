<?php
include 'config.php';
include 'database.php';
session_unset();
session_destroy();

$setPass = false;
$setReg = true;
$url = "https://member.argajaladri.or.id/bot.php";
$message = null;

// session_start();

// if (isset($_SESSION['username'])) {
//     header("Location: index.php");
//     exit();
// }



if (isset($_GET['keys'])) {

    if ($_GET['keys'] != '') {
        $setPass = true;
        $setReg = false;
        $url = "https://member.argajaladri.or.id/register.php";
        $keys = $_GET['keys'];
        $ad = new resultset('member');
        $ver = $ad->toWhere(array('verifikasi' => $keys));
        if ($ver == null) {
            header("Location: index.php");
            exit();
        }

    } else {
        header("Location: index.php");
        exit();
    }

}
if (isset($_POST['keys'])) {

    $keys = $_POST['keys'];
    $adm = new resultset('member');
    $ver = $adm->toWhere(array('verifikasi' => $keys));


    if ($ver != null) {
        $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
        $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256
        $quest = $_POST['quest'];
        if ($ver[0]['quest'] != $quest)
            $message .= $quest . " Jawaban Salah <br>";
        if ($password != $cpassword)
            $message .= "Password tidak sama <br>";


        if ($ver[0]['quest'] == $quest && $password == $cpassword) {
            $data = array(
                'password' => $password,
                'verifikasi' => '',
                'status' => 'valid'
            );
            $q = $adm->toUpdate($data, array('id_member' => $ver[0]['id_member']));
            // session_start();
            $_SESSION['username_member'] = $ver[0]['username'];
            header("Location: index.php");
            exit();
            // $message .= $q;
            // $message .= "Berhasil Disimpan";
        } else {
            $message .= "Ada kesalahan !!";
        }
    }
    //     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
//     $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256

    //     if ($password == $cpassword) {
//         $sql = "SELECT * FROM users WHERE email='$email'";
//         $result = mysqli_query($conn, $sql);
//         if (!$result->num_rows > 0) {
//             $sql = "INSERT INTO users (username, email, password)
//                     VALUES ('$username', '$email', '$password')";
//             $result = mysqli_query($conn, $sql);
//             if ($result) {
//                 echo "<script>alert('Selamat, registrasi berhasil!')</script>";
//                 $username = "";
//                 $email = "";
//                 $_POST['password'] = "";
//                 $_POST['cpassword'] = "";
//             } else {
//                 echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
//             }
//         } else {
//             echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
//         }
//     } else {
//         echo "<script>alert('Password Tidak Sesuai')</script>";
//     }
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register Member</title>
</head>

<body>
    <?php
    if ($setPass == true) {

        // var_dump($setPass);
        ?>
        <div class="container">
            <form action="<?php echo $ur; ?>" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register Password</p>
                <?php
                if ($message != null)
                    echo '<p class="login-text" style="font-size: 1rem; font-weight: 800;">' . $message . '</p>';
                ?>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="hidden" name="keys" value="<?php echo $keys; ?>">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                </div>

                <div class="input-group">
                    <input type="text" placeholder="Answer" name="quest" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Registrasi</button>
                </div>
            </form>
        </div>
    <?php } else {
        ?>
        <div class="container">
            <form action="https://member.argajaladri.or.id/bot.php" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800; text-align:center;">Register</p>
                <p class="reg" style="font-size: .7rem; font-weight: 600; color:red">Pastikan anda mempunyai Telegram</p>
                <div class="input-group">
                    <input type="text" placeholder="No Anggota" name="username" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <!--
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword"
                    value="<?php //echo $_POST['cpassword'];                                   ?>" required>
            </div> -->
                <div class="input-group">
                    <button name="submit" class="btn"
                        style="display: flex;  justify-content: space-between; align-items: center;"><span></span><span>
                            Verifikasi Telegram </span><img
                            src="https://rahman115.github.io/argajaladri.or.id/resource/images/telegram.jpg" width="10%"
                            height="auto" style="border-radius:45%;display:flex; float:left;"></button>
                </div>
                <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login</a></p>
            </form>
        </div>
    <?php } ?>
</body>

</html>