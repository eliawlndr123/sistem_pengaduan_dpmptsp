<?php

session_start();

require 'config/database.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM users
              WHERE username = ?
              AND password = ?
              AND role = 'admin'";

    $stmt = $conn->prepare($query);

    $stmt->bind_param(
        "ss",
        $username,
        $password
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $data = $result->fetch_assoc();

        $_SESSION["user_id"] = $data["id"];
        $_SESSION["nama"] = $data["nama"];
        $_SESSION["role"] = $data["role"];

        header("Location: admin/dashboard.php");
        exit();

    } else {

        $error = "Username atau password salah.";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - DPMPTSP Langkat</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background:
                linear-gradient(
                    135deg,
                    #163b63,
                    #23456d,
                    #3975a8
                );

            position: relative;

            overflow: hidden;
        }


        /* BULATAN BACKGROUND */

        body::before {
            content: "";

            width: 350px;
            height: 350px;

            background: rgba(255,255,255,0.08);

            border-radius: 50%;

            position: absolute;

            top: -120px;
            left: -100px;
        }

        body::after {
            content: "";

            width: 400px;
            height: 400px;

            background: rgba(255,255,255,0.07);

            border-radius: 50%;

            position: absolute;

            bottom: -180px;
            right: -120px;
        }


        /* LOGIN CARD */

        .login-card {

            width: 420px;

            background: rgba(255,255,255,0.97);

            padding: 40px;

            border-radius: 20px;

            box-shadow:
                0 20px 50px rgba(0,0,0,0.25);

            position: relative;

            z-index: 2;

        }


        /* LOGO / ICON */

        .logo {

            width: 75px;
            height: 75px;

            margin: 0 auto 20px;

            background: #23456d;

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            color: white;

            font-size: 32px;

            font-weight: bold;

            box-shadow:
                0 8px 20px rgba(35,69,109,0.3);

        }


        .login-card h1 {

            text-align: center;

            color: #23456d;

            font-size: 27px;

            margin-bottom: 8px;

        }


        .login-card .subtitle {

            text-align: center;

            color: #777;

            font-size: 14px;

            margin-bottom: 30px;

        }


        /* ERROR */

        .error {

            background: #ffe5e5;

            color: #c0392b;

            padding: 12px;

            border-radius: 8px;

            margin-bottom: 20px;

            text-align: center;

            font-size: 14px;

        }


        /* FORM */

        .form-group {

            margin-bottom: 20px;

        }


        .form-group label {

            display: block;

            margin-bottom: 8px;

            color: #333;

            font-weight: bold;

            font-size: 14px;

        }


        .input-box {

            position: relative;

        }


        .input-box span {

            position: absolute;

            left: 14px;

            top: 50%;

            transform: translateY(-50%);

            color: #777;

            font-size: 18px;

        }


        .input-box input {

            width: 100%;

            padding: 14px 14px 14px 45px;

            border: 1px solid #ddd;

            border-radius: 10px;

            outline: none;

            font-size: 15px;

            transition: 0.3s;

        }


        .input-box input:focus {

            border-color: #3975a8;

            box-shadow:
                0 0 0 3px rgba(57,117,168,0.12);

        }


        /* BUTTON */

        .btn-login {

            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #23456d,
                    #3975a8
                );

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;

            margin-top: 5px;

        }


        .btn-login:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(35,69,109,0.3);

        }


        /* FOOTER */

        .footer {

            text-align: center;

            margin-top: 25px;

            color: #888;

            font-size: 12px;

            line-height: 1.6;

        }


        @media (max-width: 500px) {

            .login-card {

                width: 90%;

                padding: 30px 25px;

            }

        }

    </style>

</head>


<body>


<div class="login-card">


    <!-- LOGO -->

    <div class="logo">
        A
    </div>


    <!-- JUDUL -->

    <h1>
        Login Admin
    </h1>

    <p class="subtitle">
        Sistem Informasi Pengaduan & Konsultasi
        <br>
        DPMPTSP Kabupaten Langkat
    </p>


    <!-- ERROR -->

    <?php if ($error != "") { ?>

        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>

    <?php } ?>


    <!-- FORM -->

    <form method="POST">


        <div class="form-group">

            <label>
                Username
            </label>

            <div class="input-box">

                <span>👤</span>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >

            </div>

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <div class="input-box">

                <span>🔒</span>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>

        </div>


        <button
            type="submit"
            class="btn-login"
        >
            Masuk sebagai Admin
        </button>
<button>
    <a href="index.php" class="btn-beranda">
    ← Kembali ke Beranda
</a>
           
</button>

    </form>


    <div class="footer">

        Sistem Informasi Pengaduan dan Konsultasi

        <br>

        DPMPTSP Kabupaten Langkat © 2026

    </div>


</div>


</body>

</html>