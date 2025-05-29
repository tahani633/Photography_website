<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "photography");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>أنواع جلسات التصوير</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background:rgb(222, 233, 73);
            margin: 0;
            padding: 0;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 28px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .session-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .session-price {
            font-size: 18px;
            color: #e67e22;
        }

        footer {
            text-align: center;
            background: #ecf0f1;
            padding: 15px;
            color: #555;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<header>
    أنواع جلسات التصوير
</header>

<div class="container">
<?php
// قراءة الجلسات من قاعدة البيانات
$result = $conn->query("SELECT * FROM sessions ORDER BY created_at DESC");

while ($row = $result->fetch_assoc()) {
    echo '<div class="card">';
    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="">';
    echo '<div class="card-content">';
    echo '<div class="session-title">' . htmlspecialchars($row['title']) . '</div>';
    echo '<div class="session-price">' . htmlspecialchars($row['price']) . ' ريال</div>';
    echo '</div>';
    echo '</div>';
}
?>
</div>

<footer>
    &copy; 2025 جميع الحقوق محفوظة - توته للتصوير
</footer>

</body>
</html>
