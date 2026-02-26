<?php
// ตรวจสอบหากฟอร์มถูกส่งมา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $service_fee = $_POST['service_fee'];
    
    // คำนวณยอดรวม
    $total = ($quantity * $price) + $service_fee;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำนวณใบเสร็จ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6f61;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #ff6f61;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #ff3b30;
        }

        .receipt {
            background-color: #fff;
            padding: 20px;
            margin-top: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .receipt h4 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .receipt p {
            font-size: 16px;
        }

        .receipt .total {
            font-size: 20px;
            font-weight: bold;
            color: #ff6f61;
        }

        /* สำหรับการพิมพ์ */
        @media print {
            body {
                background-color: white;
            }
            .container {
                max-width: none;
                box-shadow: none;
                padding: 15px;
            }
            .receipt {
                box-shadow: none;
                padding: 15px;
            }
            .btn-primary {
                display: none;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h2>คำนวณใบเสร็จ</h2>

    <!-- ฟอร์มกรอกข้อมูลใบเสร็จ -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="product_name">ชื่อสินค้า:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="quantity">จำนวน:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="price">ราคาต่อหน่วย:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="service_fee">ค่าบริการ (หากมี):</label>
            <input type="number" class="form-control" id="service_fee" name="service_fee" value="0">
        </div>

        <button type="submit" class="btn btn-primary">คำนวณใบเสร็จ</button>
    </form>

    <?php if (isset($total)): ?>
        
        <!-- แสดงใบเสร็จ -->
        <div class="receipt">
            <h4>ใบเสร็จรับเงิน</h4>
            <p><strong>ชื่อสินค้า:</strong> <?php echo htmlspecialchars($product_name); ?></p>
            <p><strong>จำนวน:</strong> <?php echo htmlspecialchars($quantity); ?> ชิ้น</p>
            <p><strong>ราคาต่อหน่วย:</strong> ฿<?php echo number_format($price, 2); ?></p>
            <p><strong>ค่าบริการ:</strong> ฿<?php echo number_format($service_fee, 2); ?></p>
            <p class="total"><strong>ยอดรวม:</strong> ฿<?php echo number_format($total, 2); ?></p>
        </div>
    <?php endif; ?>
</div>

<!-- สคริปต์สำหรับการพิมพ์ -->
<script>
    function printReceipt() {
        window.print();
    }
</script>

<!-- ปุ่มพิมพ์ -->
<?php if (isset($total)): ?>
    <div class="text-center">
        <button onclick="printReceipt()" class="btn btn-primary mt-4">พิมพ์ใบเสร็จ</button>
    </div>
<?php endif; ?>

</body>
</html>
