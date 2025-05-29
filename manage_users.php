<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// جلب بيانات المستخدمين
$result = $conn->query("SELECT * FROM users ORDER BY User_id DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body { background-color:rgb(222, 233, 73); font-family: 'Cairo', sans-serif; }
        .container { margin-top: 50px; }
        .table-container {
            background-color: #fff; padding: 20px; border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; margin-bottom: 30px; color: #333; }
        .btn-edit, .btn-delete {
            border: none; color: #fff; border-radius: 5px; padding: 5px 10px;
        }
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete:hover { background-color: #c82333; }
        .btn-add { margin-bottom: 20px; }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>

<div class="container">
    <h2>إدارة المستخدمين</h2>

    <!-- إشعارات -->
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">تم حذف المستخدم بنجاح.</div>
    <?php elseif (isset($_GET['updated'])): ?>
        <div class="alert alert-success">تم تعديل بيانات المستخدم بنجاح.</div>
    <?php elseif (isset($_GET['added'])): ?>
        <div class="alert alert-success">تم إضافة المستخدم بنجاح.</div>
    <?php endif; ?>

    <!-- زر إضافة مستخدم -->
    <a href="add_user.php" class="btn btn-primary btn-add">+ إضافة مستخدم جديد</a>

    <div class="table-container">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['User_id']; ?></td>
                            <td><?= htmlspecialchars($user['username']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $user['User_id']; ?>" class="btn btn-edit">تعديل</a>
                                <a href="delete_user.php?id=<?= $user['User_id']; ?>" class="btn btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">لا يوجد مستخدمون مسجلون حالياً.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'include/footer.php'; ?>
</body>
</html>
