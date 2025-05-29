<?php
session_start();
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors',1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo "<div class='alert alert-danger'>يجب تسجيل الدخول أولاً.</div>";
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // استلام البيانات من النموذج
    $name         = mysqli_real_escape_string($conn, $_POST['name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $phone        = mysqli_real_escape_string($conn, $_POST['phone']);
    $session_date = mysqli_real_escape_string($conn, $_POST['date']);
    $message      = mysqli_real_escape_string($conn, $_POST['message']);

    // إدخال البيانات في جدول bookings
    $sql = "INSERT INTO bookings (User_id, name, email, phone, session_date, message, created_at)
            VALUES ('$user_id', '$name', '$email', '$phone', '$session_date', '$message', NOW())";

    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>تم إرسال الحجز بنجاح!</div>";
    } else {
        echo "<div class='alert alert-danger'>حدث خطأ أثناء الحجز: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>طلب غير صالح.</div>";
}
