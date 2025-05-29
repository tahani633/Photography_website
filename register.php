<?php
include 'config.php'; // تأكدي أن config يحتوي على session_start مرة واحدة فقط

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        $error = "البريد الإلكتروني مستخدم من قبل.";
    } else {
        $insert = $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
        if ($insert) {
            $_SESSION['user'] = $username;
            setcookie("user", $username, time() + 3600, "/");
            header("Location: index.php");
            exit();
        } else {
            $error = "حدث خطأ أثناء التسجيل.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل مستخدم جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(222, 233, 73),rgb(222, 233, 73));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
        }

        .register-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #5e35b1;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #4527a0;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>تسجيل جديد</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <label class="form-label">اسم المستخدم</label>
        <input type="text" name="username" class="form-control" required>

        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" required>

        <label class="form-label">كلمة المرور</label>
        <input type="password" name="password" class="form-control" required>

        <button type="submit" class="btn btn-primary w-100">تسجيل</button>
    </form>

    <a href="login.php" class="login-link">لديك حساب؟ قم بتسجيل الدخول</a>
</div>

</body>
</html>
