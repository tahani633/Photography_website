<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>حجز جلسة تصوير</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(to right, rgb(222, 233, 73), rgb(222, 233, 73));
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Tahoma', sans-serif;
            direction: rtl;
        }

        .booking-box {
            background-color: #fff;
            padding: 20px 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .booking-box h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            color: #333;
        }

        .form-label {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .form-control {
            font-size: 14px;
            margin-bottom: 12px;
            border-radius: 8px;
            padding: 8px 10px;
        }

        .btn-primary {
            background-color: #673ab7;
            border: none;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #512da8;
        }

        .btn-secondary {
            background-color: #888;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            margin-top: 10px;
        }

        .alert {
            font-size: 14px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="booking-box">
    <h3>حجز جلسة تصوير</h3>

    <div id="responseMsg"></div>

    <form id="bookingForm">
        <label class="form-label">الاسم</label>
        <input type="text" name="name" class="form-control" required>

        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" required>

        <label class="form-label">رقم الهاتف</label>
        <input type="text" name="phone" class="form-control" required>

        <label class="form-label">تاريخ الجلسة</label>
        <input type="date" name="date" class="form-control" required>

        <label class="form-label">نوع الجلسة</label>
        <input type="text" name="type" class="form-control">

        <label class="form-label">ملاحظات</label>
        <textarea name="message" class="form-control" rows="3"></textarea>

        <button type="submit" class="btn btn-primary w-100">إرسال الحجز</button>
        <a href="logout.php" class="btn btn-secondary w-100">تسجيل الخروج</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#bookingForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'ajax_booking.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#responseMsg').html(response);
                $('#bookingForm')[0].reset();
            },
            error: function() {
                $('#responseMsg').html("<div class='alert alert-danger'>حدث خطأ أثناء الإرسال.</div>");
            }
        });
    });
</script>

</body>
</html>
