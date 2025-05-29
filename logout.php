<?php
session_start();

// حذف الجلسة والكوكيز
session_unset();
session_destroy();
setcookie("user", "", time() - 3600, "/");

// العودة للصفحة الرئيسية أو تسجيل الدخول
header("Location: login.php");
exit();