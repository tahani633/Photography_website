<?php
session_start();
include 'config.php';

// التحقق من وجود كعكة ترحيبية
if (!isset($_COOKIE['welcome'])) {
    setcookie('welcome', 'true', time() + (86400 * 30), "/"); // 30 يوم
    $firstVisit = true;
} else {
    $firstVisit = false;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>موقع توته للتصوير الفوتوغرافي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #1e1e7a;
        }

        .navbar a {
            color: #fff !important;
            margin-left: 15px;
            font-weight: bold;
        }

        .hero {
            background-image: url('assets/images/nur.png');
            background-size: cover;
            background-position: center;
            padding: 120px 20px;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .welcome-message {
            color: #dff0d8;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 10px;
            margin-top: 15px;
            display: inline-block;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin: 40px 0 20px;
            color: #333;
            font-weight: bold;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 0 20px 50px;
        }

        .card {
            width: 280px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #fff;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-text {
            font-weight: bold;
            color: #555;
        }

        footer {
            background: #222;
            color: #ccc;
            padding: 20px;
            text-align: center;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>
 
<div class="hero">
    <h1>مرحباً بك في موقع توته للتصوير الفوتوغرافي</h1>
    <?php if ($firstVisit): ?>
        <p class="welcome-message">أهلاً بك! هذه أول زيارة لك للموقع.</p>
    <?php endif; ?>
</div>

<h2>معرض الصور</h2>

<div class="gallery">
    <?php
    $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '  <img src="../uploads/' . htmlspecialchars($row['image_path']) . '" class="card-img-top" alt="صورة">';
            echo '  <div class="card-body">';
            echo '    <p class="card-text">' . htmlspecialchars($row['title']) . '</p>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo "<p class='text-center'>لا توجد صور في المعرض حالياً.</p>";
    }
    ?>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
