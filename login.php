<?php
include "function.php";
session_start();
// //cek cookei login
// if (isset($_COOKIE['login'])) {
//   //cek value
//   if ($_COOKIE['login'] == 'true') {
//     //set session true
//     $_SESSION['login'] = true;
//   }
// }
//kalo ada $_SESSION['login'] / kalo sudah login maka kembalikan ke index
//jika ada session[login]
if (isset($_SESSION["login"])) {
    echo '<script>window.location="user/index.php"</script>';
}
if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    //cek akun ada apa tidak
    $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '" . $email . "' AND password = '" . $password . "'");
    //cek validasi login
    if (mysqli_num_rows($cek) > 0) {
        $a = mysqli_fetch_object($cek);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $a->id_user;
        $_SESSION['nama'] = $a->nm_user;
        $_SESSION['email'] = $a->email;
        $_SESSION['foto'] = $a->foto;
        //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
        //ada waktu kadarulasa

        echo '<script>alert("Login Berhasil")</script>';
        echo '<script>window.location="user/index.php"</script>';
    } else {
        echo '<script>alert("Gagal, username atau password salah")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | Todo</title>
    <link rel="icon" type="image/x-icon" href="img/logotitle.png" />
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block">

                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>