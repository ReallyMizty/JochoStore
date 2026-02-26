<?php
include('db/dbconn.php');

// เชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับหมายเลขติดตามจากฟอร์ม
$tracking_number = isset($_POST['tracking_number']) ? trim($_POST['tracking_number']) : '';

// ตรวจสอบว่ามีการกรอกหมายเลขติดตามหรือไม่
if (!empty($tracking_number)) {
    // เตรียมคำสั่ง SQL โดยใช้ Prepared Statement
    $stmt = $conn->prepare("SELECT * FROM packages WHERE tracking_number = ?");
    if ($stmt === false) {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
        exit;
    }
    
    $stmt->bind_param("s", $tracking_number);  // "s" คือ string สำหรับการจับคู่กับ $tracking_number
    
    // Execute statement
    $stmt->execute();
    
    // รับผลลัพธ์
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // แสดงข้อมูลพัสดุ
        $row = $result->fetch_assoc();
        echo "<div class='container'>";
        
        echo "<div class='card'>";
        echo "<div class='card-header'>";
        echo "ข้อมูลพัสดุหมายเลข: " . htmlspecialchars($row['tracking_number']);
        echo "</div>";
        
        echo "<div class='card-body'>";
        echo "<p><strong>ขนส่ง:</strong> " . htmlspecialchars($row['employee_name']) . "</p>";
        echo "<p><strong>สถานะพัสดุ:</strong> " . htmlspecialchars($row['status']) . "</p>";
        echo "<p><strong>เวลา:</strong> " . htmlspecialchars($row['created_at'] . " น.") . "</p>";
        echo "<p><strong>ชื่อผู้รับ:</strong> " . htmlspecialchars($row['recipient_name']) . "</p>";
        echo "<p><strong>ที่อยู่ปลายทาง:</strong> " . htmlspecialchars($row['delivery_address']) . "</p>";
        echo "<p><strong>หมายเลขติดต่อ:</strong> " . htmlspecialchars($row['recipient_number']) . "</p>";
        echo "</div>";
        echo "</div>";
        
        echo "</div>";  // ปิด container
        
    } else {
        
        echo "<div class='container'>";
        echo "<div class='card'>";

        echo "<div class='card-header'>";
        echo "ข้อมูลพัสดุหมายเลข: " . $tracking_number;
        echo "</div>";
        
        echo "<div class='card-body'>";
        echo "<p><strong>ไม่พบหมายเลขพัสดุ</strong></p>";
        echo "</div>";

        echo "</div>";
        echo "</div>";  // ปิด container
    }

    // ปิด statement
    $stmt->close();
} else {
    echo "<h2 class='text-center mb-4'>กรุณากรอกหมายเลขพัสดุ!!!</h2>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?> 

<!-- เพิ่ม Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- เพิ่ม Icon (Font Awesome) สำหรับการใช้ไอคอน -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* Custom Styles */
    body {
        background-color: #f7f7f7;
        font-family: 'Arial', sans-serif;
        color: #333;
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
        color:rgb(251, 133, 122);
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card {
        background: linear-gradient(145deg,rgb(255, 124, 112),rgb(255, 78, 69));
        color: white;
        border-radius: 12px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.3);
        margin-bottom: 20px;
    }

    .card-header {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    .card-body {
        text-align: left;
        font-size: 16px;
    }

    .card-body p {
        margin-bottom: 10px;
    }

    .alert-custom {
        background-color: #ff3b30;
        color: white;
        font-size: 18px;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-top: 20px;
    }

    /* สำหรับการพิมพ์ */
    @media print {
        body {
            padding: 0;
            background-color: white;
        }

        .container {
            max-width: none;
            box-shadow: none;
            padding: 15px;
        }

        .card {
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .card-body {
            text-align: left;
        }

        h2 {
            font-size: 24px;
        }

        .btn {
            display: none;
        }
    }

</style>
