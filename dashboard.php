<?php
session_start();
include 'config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// إحصائيات
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$imageCount = $conn->query("SELECT COUNT(*) AS total FROM gallery")->fetch_assoc()['total'];
$bookingCount = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
$messageCount = $conn->query("SELECT COUNT(*) AS total FROM messages")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/images/6.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding: 30px;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #007bff;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }
        ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        ul li:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>أهلاً، <?php echo $_SESSION['admin']; ?></h1>
    <h2>لوحة التحكم</h2>

    <h3 class="text-center mt-4">إحصائيات النظام</h3>
    <div class="row text-center my-4">
        <div class="col-md-6">
            <div class="alert alert-primary">عدد المستخدمين: <strong><?php echo $userCount; ?></strong></div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-success">عدد الصور: <strong><?php echo $imageCount; ?></strong></div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-info">عدد الحجوزات: <strong><?php echo $bookingCount; ?></strong></div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning">عدد الرسائل: <strong><?php echo $messageCount; ?></strong></div>
        </div>
    </div>

    <ul>
        <li><a href="manage_users.php">إدارة المستخدمين</a></li>
        <li><a href="manage_gallery.php">إدارة الصور</a></li>
        <a href="manage_booking.php" class="btn btn-info w-100 mb-2">الحجوزات</a>
        <li><a href="manage_messages.php">الرسائل</a></li>
        <a href="logout.php" class="btn btn-danger">تسجيل الخروج</a>
    </ul>
</div>

</body>
</html>
