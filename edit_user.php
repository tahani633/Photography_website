<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = intval($_GET['id']);

// جلب بيانات المستخدم
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "المستخدم غير موجود.";
    exit();
}

// تعديل البيانات
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $update = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
    $update->bind_param("ssi", $username, $email, $id);

    if ($update->execute()) {
        header("Location: manage_users.php?updated=1");
        exit();
    } else {
        $error = "حدث خطأ أثناء التعديل.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل مستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f9f9f9; }
        .container { max-width: 600px; margin-top: 50px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 30px; text-align: center; }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>

<div class="container">
    <h2>تعديل بيانات المستخدم</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">اسم المستخدم</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        <a href="manage_users.php" class="btn btn-secondary">رجوع</a>
    </form>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
