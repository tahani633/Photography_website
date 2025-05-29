<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // جلب اسم الصورة
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($image);
        $stmt->fetch();

        $filePath = 'uploads/' . $image;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $deleteStmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $deleteStmt->bind_param("i", $id);
        if ($deleteStmt->execute()) {
            echo 'تم الحذف بنجاح';
        } else {
            echo 'فشل في حذف السجل';
        }
    } else {
        echo 'الصورة غير موجودة';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'طلب غير صالح';
}
