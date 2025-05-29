<?php
include 'config.php'; // تأكدي إن هذا الملف فيه الاتصال بقاعدة البيانات

// بيانات الأدمن اللي تبغي تضيفيه
$name = "توته";
$email = "tota77@gmail.com";
$password_plain = "733363327"; // كلمة المرور الأصلية

// تشفير كلمة المرور
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

// استعلام لإدخال البيانات في جدول admins
$sql = "INSERT INTO admins (username, email, password) VALUES ('$name', '$email', '$password_hashed')";
if (mysqli_query($conn, $sql)) {
    echo "تمت إضافة الأدمن بنجاح.";
} else {
    echo "خطأ: " . mysqli_error($conn);
}
?>
