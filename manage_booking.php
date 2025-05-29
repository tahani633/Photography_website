<?php
include 'config.php';

// تنفيذ الحذف عند وجود delete_id في الرابط
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM bookings WHERE id = $id";
    if ($conn->query($delete_query)) {
        echo "<script>alert('تم إلغاء الحجز بنجاح'); window.location='manage_booking.php';</script>";
    } else {
        echo "خطأ في الحذف: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الحجوزات</title>
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
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        a.cancel-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>إدارة الحجوزات</h2>

    <table>
        <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>رقم الجوال</th>
            <th>تاريخ الجلسة</th>
            <th>الرسالة</th>
            <th>تاريخ الحجز</th>
            <th>إلغاء الحجز</th>
        </tr>

        <?php
        $query = "SELECT * FROM bookings ORDER BY session_date DESC";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['session_date']}</td>
                    <td>{$row['message']}</td>
                    <td>{$row['created_at']}</td>
                    <td>{$row['User_id']}</td>

                    <td><a class='cancel-btn' href='manage_booking.php?delete_id={$row['id']}' onclick=\"return confirm('هل أنت متأكد من إلغاء هذا الحجز؟');\">إلغاء</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>لا توجد حجوزات حالياً</td></tr>";
        }
        ?>
    </table>

</body>
</html>
