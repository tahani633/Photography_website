<?php include 'include/header.php'; ?>
<?php include 'include/nav.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-5">من نحن</h2>

    <!-- نبذة عن المصورة -->
    <div class="row mb-5">
        <div class="col-md-6">
            <img src="assets/images/photographer.jpg" class="img-fluid rounded shadow" alt="المصورة">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h4>نبذة تعريفية</h4>
                <p>
                    أنا مصورة فوتوغرافية محترفة متخصصة في توثيق أجمل اللحظات والذكريات. أقدم تجربة فريدة لكل عميل باستخدام أسلوبي الإبداعي وعدستي المميزة.
                </p>
                <p>
                    هدفي هو تقديم صور تنبض بالحياة وتخلّد اللحظة، سواء كانت جلسة تصوير بسيطة أو مناسبة كبيرة.
                </p>
            </div>
        </div>
    </div>

    <!-- أنواع الجلسات -->
    <h4 class="mb-4">أنواع جلسات التصوير</h4>
    <div class="row mb-5">
        <?php
        $sessions = [
            ['title' => 'تصوير أطفال', 'img' => 'child.jpg'],
            ['title' => 'تصوير زفاف', 'img' => 'wedding.jpg'],
            ['title' => 'تصوير بورتريه', 'img' => 'portrait.jpg'],
            ['title' => 'تصوير منتجات', 'img' => 'product.jpg']
        ];
        foreach ($sessions as $s):
        ?>
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <img src="assets/images/<?= $s['img'] ?>" class="card-img-top" alt="<?= $s['title'] ?>">
                <div class="card-body text-center">
                    <h6><?= $s['title'] ?></h6>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- الأسعار -->
    <h4 class="mb-4">الأسعار التقريبية</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>نوع الجلسة</th>
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>جلسة أطفال</td>
                    <td>ابتداءً من 200 ريال</td>
                </tr>
                <tr>
                    <td>جلسة زفاف</td>
                    <td>ابتداءً من 1000 ريال</td>
                </tr>
                <tr>
                    <td>بورتريه</td>
                    <td>ابتداءً من 300 ريال</td>
                </tr>
                <tr>
                    <td>منتجات</td>
                    <td>ابتداءً من 150 ريال</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p class="text-muted mt-2 text-center">*الأسعار قابلة للتعديل حسب عدد الصور والموقع.</p>
</div>

<?php include 'include/footer.php'; ?>
