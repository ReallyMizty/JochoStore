<?php
// รับค่าจากฟอร์ม
$name = $_POST['name'];
$product = $_POST['product'];
$amount = $_POST['amount'];

// สร้างหมายเลขสั่งซื้ออัตโนมัติ เช่น ORD202507291234
$order_prefix = "ORD";
$order_date = date("Ymd");
$order_random = rand(1000, 9999);
$order_id = $order_prefix . $order_date . $order_random;

// อัปโหลดสลิป
$uploadOk = 1;
$targetDir = "uploads/";
$slipName = basename($_FILES["slip"]["name"]);
$slipType = strtolower(pathinfo($slipName, PATHINFO_EXTENSION));
$targetFile = $targetDir . $order_id . "." . $slipType;

// ตรวจสอบว่าเป็นภาพ
$check = getimagesize($_FILES["slip"]["tmp_name"]);
if ($check === false) {
    echo "ไฟล์ไม่ใช่ภาพ.";
    $uploadOk = 0;
}

// ขนาดไม่เกิน 5MB
if ($_FILES["slip"]["size"] > 5 * 1024 * 1024) {
    echo "ไฟล์ใหญ่เกิน 5MB";
    $uploadOk = 0;
}

// ประเภทไฟล์ที่อนุญาต
if (!in_array($slipType, ["jpg", "jpeg", "png"])) {
    echo "อนุญาตเฉพาะ JPG, JPEG, PNG เท่านั้น";
    $uploadOk = 0;
}

// อัปโหลดไฟล์
if ($uploadOk) {
    if (move_uploaded_file($_FILES["slip"]["tmp_name"], $targetFile)) {
        // เชื่อมต่อฐานข้อมูล (แก้ไขค่าตรงนี้ให้ตรงกับของคุณ)
        $conn = mysqli_connect("localhost", "root", "", "shoe");
        if (!$conn) {
            die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
        }

        // บันทึกข้อมูลคำสั่งซื้อ
        $sql = "INSERT INTO orders (order_id, customer_name, product_name, quantity, slip_filename)
                VALUES ('$order_id', '$name', '$product', $amount, '" . basename($targetFile) . "')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<h3>สั่งซื้อสำเร็จ!</h3>";
            echo "หมายเลขสั่งซื้อ: <strong>$order_id</strong><br>";
            echo "ชื่อลูกค้า: $name<br>";
            echo "สินค้า: $product<br>";
            echo "จำนวน: $amount<br>";
            echo "สลิป: <a href='$targetFile' target='_blank'>ดูสลิป</a>";
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "เกิดข้อผิดพลาดในการอัปโหลดสลิป.";
    }
} else {
    echo "<br>ไม่สามารถอัปโหลดสลิปได้.";
}
?>
