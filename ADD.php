<?php
include 'config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $conn->query("INSERT INTO gallery (image, description) VALUES ('$image', '$desc')");
        header("Location: manage_gallery.php");
    } else {
        $error = "فشل رفع الصورة.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>إضافة صورة</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'include/nav.php'; ?>
<h2>إضافة صورة جديدة</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" enctype="multipart/form-data">
    <label>الوصف:</label>
    <textarea name="description" required></textarea><br>
    <label>اختيار صورة:</label>
    <input type="file" name="image" required><br>
    <button type="submit">حفظ</button>
</form>
</body>
</html>
