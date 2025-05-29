<form action="upload_photo.php" method="POST" enctype="multipart/form-data">
    <label>عنوان الصورة:</label>
    <input type="text" name="title" required><br><br>

    <label>اختر صورة:</label>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit" name="upload">رفع الصورة</button>
</form>