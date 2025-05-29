<?php
include 'config.php';

// حذف الرسالة عند الضغط على زر الحذف
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM messages WHERE id = $id";
    if ($conn->query($delete_query)) {
        echo "<script>alert('تم حذف الرسالة بنجاح'); window.location='manage_messages.php';</script>";
    } else {
        echo "خطأ في الحذف: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الرسائل</title>
    <style>
        body {
            font-family: Arial;
            background-color:rgb(222, 233, 73);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #008080;
            color: white;
        }
        a.delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>إدارة الرسائل</h2>

<table>
    <tr>
        <th>الرقم</th>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>الموضوع</th>
        <th>الرسالة</th>
        <th>تاريخ الإرسال</th>
        <th>حذف</th>
    </tr>

    <?php
    $query = "SELECT * FROM messages ORDER BY sent_at DESC";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['subject']) . "</td>
                <td>" . htmlspecialchars($row['message']) . "</td>
                <td>" . htmlspecialchars($row['sent_at']) . "</td>
                <td><a class='delete-btn' href='manage_messages.php?delete_id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('هل أنت متأكد من حذف هذه الرسالة؟');\">حذف</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>لا توجد رسائل حالياً</td></tr>";
    }
    ?>
</table>

</body>
</html>
