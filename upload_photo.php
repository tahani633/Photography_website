<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $targetDir = "../uploads/";
    $targetFile = $targetDir . $imageName;

    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        // حفظ الرابط في قاعدة البيانات
        $sql = "INSERT INTO gallery (image_path) VALUES ('$imageName')";
        mysqli_query($conn, $sql);
        echo "تم رفع الصورة بنجاح!";
    } else {
        echo "فشل في رفع الصورة!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>رفع صورة</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { background: #f5f5f5; padding: 20px; border-radius: 8px; width: 300px; }
        input[type="file"], input[type="submit"] { margin-top: 10px; }
    </style>
</head>
<body>
    <h2>رفع صورة جديدة</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <br>
        <input type="submit" value="رفع الصورة">
    </form>
</body>
</html>
