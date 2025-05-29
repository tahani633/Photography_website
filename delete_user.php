<?php
session_start();
include 'config.php';

// التحقق من أن المدير مسجل الدخول
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    
}

// التأكد من أن معرف المستخدم موجود وصالح
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // تنفيذ الحذف
    $stmt = $conn->prepare("DELETE FROM users WHERE  user_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // إعادة التوجيه بعد الحذف
        header("Location: manage_users.php?deleted=1");
        exit();
    } else {
        echo "حدث خطأ أثناء الحذف: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "طلب غير صالح.";
    exit();
}
?>
