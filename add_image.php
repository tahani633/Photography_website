<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $file = $_FILES['image'];

    if ($file['error'] == 0 && !empty($title)) {
        $filename = time() . '_' . basename($file['name']);
        $uploadPath1 = "../uploads/" . $filename;
        $uploadPath2 = "../assets/" . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath1)) {
            copy($uploadPath1, $uploadPath2);

            $stmt = $conn->prepare("INSERT INTO gallery (title, filename) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $filename);
            $stmt->execute();

            header("Location: manage_gallery.php?added=1");
            exit();
        } else {
            $msg = "فشل في رفع الصورة!";
        }
    } else {
        $msg = "يرجى ملء جميع الحقول واختيار صورة صالحة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة صورة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; font-family: 'Cairo', sans-serif; }
        .container { margin-top: 50px; max-width: 600px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>

<div class="container">
    <h2>إضافة صورة جديدة</h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?= $msg; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">عنوان الصورة</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">اختر الصورة</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success w-100">رفع الصورة</button>
    </form>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
