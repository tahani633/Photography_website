<?php
include 'config.php'; // يحتوي على session_start()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];        // اختياري للعرض فقط
            $_SESSION['user_id'] = $user['User_id'];      // المهم

            // كوكي إذا حبيتي تحفظي الاسم فقط
            setcookie("user", $user['username'], time() + 3600, "/");

            header("Location: index.php");
            exit();
        } else {
            $error = "كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "البريد الإلكتروني غير مسجل.";}
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to right, rgb(222, 233, 73), rgb(222, 233, 73));
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: white;
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 10px;
            height: 45px;
        }

        .btn-primary {
            background-color: #2196F3;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            height: 45px;
        }

        .btn-primary:hover {
            background-color: #1976D2;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>تسجيل الدخول</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post" action="">
        <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
        <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
        <button type="submit" class="btn btn-primary w-100">دخول</button>
    </form>

    <a href="register.php" class="register-link">ليس لديك حساب؟ أنشئ حساب</a>
</div>

</body>
</html>
