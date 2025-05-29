<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!empty($username) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            header("Location: manage_users.php?added=1");
            exit();
        } else {
            $message = "حدث خطأ أثناء الإضافة: " . $conn->error;
        }
        $stmt->close();
    } else {
        $message = "جميع الحقول مطلوبة.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body { background-color:rgb(222, 233, 73); font-family: 'Cairo', sans-serif; }
        .form-container {
            background: #fff; padding: 30px; margin-top: 50px;
            border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; margin-bottom: 30px; color: #333; }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>

<div class="container">
    <div class="col-md-6 offset-md-3 form-container">
        <h2>إضافة مستخدم جديد</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?= $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">اسم المستخدم</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة المستخدم</button>
            <a href="manage_users.php" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
