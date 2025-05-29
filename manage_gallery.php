<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "photography");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// رفع صورة جديدة
if (isset($_POST['upload'])) {
    $title = trim($_POST['title']);
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        $uniqueName = time() . "_" . basename($image); //   اسم فريد حتي لا تتكرر الاسماء
        $target = "../uploads/" . $uniqueName;// مجلد الحفظ

        if (move_uploaded_file($tmp, $target)) {
            $stmt = $conn->prepare("INSERT INTO gallery (title, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $uniqueName);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// حذف صورة
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $getImg = $conn->query("SELECT image_path FROM gallery WHERE id = $id");

    if ($getImg && $getImg->num_rows > 0) {
        $row = $getImg->fetch_assoc();
        $path = "../uploads/" . $row['image_path'];

        if (is_file($path)) {
            unlink($path);
        }

        $conn->query("DELETE FROM gallery WHERE id = $id");
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الصور</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color:rgb(222, 233, 73);
            margin: 30px;
            direction: rtl;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        input[type="text"], input[type="file"], button {
            display: block;
            width: 90%;
            margin: 10px auto;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .image-box {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            width: 220px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .image-box:hover {
            transform: scale(1.03);
        }

        .image-box img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .image-box p {
            margin: 10px 0;
            font-weight: bold;
        }

        .delete-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #b52a37;
        }
    </style>
</head>
<body>

<h2>إضافة صورة جديدة</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="عنوان الصورة" required>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit" name="upload">رفع الصورة</button>
</form>

<h2>المعرض</h2>
<div class="gallery">
<?php
$result = $conn->query("SELECT * FROM gallery ORDER BY uploaded_at DESC");
while ($row = $result->fetch_assoc()) {
    echo '<div class="image-box">';
    echo '<img src="../uploads/' . htmlspecialchars($row['image_path']) . '" alt="">';
    echo '<p>' . htmlspecialchars($row['title']) . '</p>';
    echo '<a class="delete-btn" href="?delete=' . $row['id'] . '" onclick="return confirm(\'هل تريد حذف الصورة؟\')">حذف</a>';
    echo '</div>';
}
?>
</div>

</body>
</html>
