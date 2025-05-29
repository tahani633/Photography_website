<?php
session_start();

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // التأكد من وجود القيم قبل استخدامها
    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        // هنا تقدر تضيف تخزين البيانات في قاعدة البيانات أو إرسال إيميل
        $success = "تم إرسال رسالتك بنجاح!";
    } else {
        $error = "يرجى تعبئة جميع الحقول.";}
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تواصل معنا</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right,rgb(222, 233, 73),rgb(222, 233, 73));
            background-size: cover;
        }

        .contact-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 10px;
            height: 45px;
        }

        textarea.form-control {
            height: 100px;
        }

        .btn-primary {
            background-color: #673ab7;
            border: none;
            border-radius: 10px;
            height: 45px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #512da8;
        }

        .logout-btn {
            position: absolute;
            top: -50px;
            left: 0;
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>

<div class="contact-box">
    <!-- زر الخروج -->
    <a href="logout.php" class="logout-btn">خروج</a>

    <h2>تواصل معنا</h2>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <form  method="post">
        <input type="text" name="name" class="form-control" placeholder="اسمك" required>
        <input type="email" name="email" class="form-control" placeholder="بريدك الإلكتروني" required>
        <textarea name="message" class="form-control" placeholder="رسالتك" required></textarea>
        <button type="submit" class="btn btn-primary w-100">إرسال</button>
    </form>
</div>

</body>
</html>
