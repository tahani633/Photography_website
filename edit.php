<?php
include 'config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$type = $_GET['type'] ?? 'user'; // default to user

if ($type === 'user') {
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    $data = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $conn->query("UPDATE users SET username='$name', email='$email' WHERE id=$id");
        header("Location: manage_users.php");
    }
} else {
    $result = $conn->query("SELECT * FROM gallery WHERE id = $id");
    $data = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $desc = $_POST['description'];
        $conn->query("UPDATE gallery SET description='$desc' WHERE id=$id");
        header("Location: manage_gallery.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>تعديل</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'include/nav.php'; ?>
<h2>تعديل <?= $type === 'user' ? 'مستخدم' : 'صورة' ?></h2>
<form method="post">
    <?php if ($type === 'user') { ?>
        <input type="text" name="username" value="<?= $data['username'] ?>" required><br>
        <input type="email" name="email" value="<?= $data['email'] ?>" required><br>
    <?php } else { ?>
        <textarea name="description" required><?= $data['description'] ?></textarea><br>
    <?php } ?>
    <button type="submit">حفظ التعديلات</button>
</form>
</body>
</html>
