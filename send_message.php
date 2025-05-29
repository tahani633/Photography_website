<?php
include 'config.php'; // تأكدي أن الملف يحتوي على الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $sql = "INSERT INTO messages (name, email, subject, message, sent_at)
                VALUES ('$name', '$email', '$subject', '$message', NOW())";

        if (mysqli_query($conn, $sql)) {
            header("Location: contact.php?sent=1");
            exit();
        } else {
            header("Location: contact.php?error=1");
            exit();
        }
    } else {
        header("Location: contact.php?error=1");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
