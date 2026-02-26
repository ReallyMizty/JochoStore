<?php include('db/db_connection.php'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งชำระเงิน</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-text {
            color: #6c757d;
        }
    </style>
</head>
<body>

     
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="img/logo.jpg"width=50,height 40>
        <a class="navbar-brand" href="#">ร้านขายรองเท้าผ้าใบออนไลน์</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">สินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.facebook.com/jonut2000">ติดต่อเรา</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- ฟอร์มแจ้งชำระเงิน -->
    <div class="container">


    
        <h1 class="text-center">แจ้งชำระเงิน</h1>
        <form id="inform_payment_form" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(event)">
           
        
        <img src="img/ki.png"width=50,height 40>  <label for=""> กสิกรไทย 119-2-82207-2 นายฐานานันท์ สังฆะมณี</label>
        
        
        <!-- เลขที่ใบสั่งซื้อ -->
            <div class="form-group">
                <label for="order_id">เลขที่ใบสั่งซื้อ *</label>
                <input type="text" class="form-control" id="order_id" name="order_id" required>
            </div>

            <!-- ชื่อผู้แจ้ง -->
            <div class="form-group">
                <label for="name">ชื่อผู้แจ้ง *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- อีเมล -->
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <!-- เบอร์มือถือ -->
            <div class="form-group">
                <label for="mobile">เบอร์มือถือ</label>
                <input type="text" class="form-control" id="mobile" name="mobile">
            </div>

            <!-- รายละเอียดเพิ่มเติม -->
            <div class="form-group">
                <label for="detail">รายละเอียดเพิ่มเติม</label>
                <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
            </div>

            <!-- หลักฐานการโอน -->
            <div class="form-group">
                <label for="uploadfile">หลักฐานการโอน *</label>
                <input type="file" class="form-control-file" id="uploadfile" name="uploadfile" accept=".jpg,.jpeg,.png,.pdf" required>
                <small class="form-text text-muted">ไฟล์ jpg, png, pdf ขนาดไม่เกิน 2MB</small>
            </div>

            <!-- ปุ่มส่งข้อมูล -->
            <button type="submit" class="btn btn-primary">แจ้งชำระเงิน</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 ร้านขายรองเท้าผ้าใบออนไลน์ ยินดีต้อนรับ</p>
    </footer>

    <script>
        function submitForm(event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่
            var formData = new FormData(document.getElementById('inform_payment_form'));

            fetch('submit_payment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    window.location.href = 'success.php'; // เปลี่ยนหน้าเมื่อสำเร็จ
                }
            })
            .catch(error => {
                console.error('เกิดข้อผิดพลาด:', error);
            });
        }
    </script>
</body>
</html>