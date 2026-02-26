<?php
include('db/dbconn.php');

// เชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับหมายเลขติดตามจากฟอร์ม
$tracking_number = isset($_POST['tracking_number']) ? trim($_POST['tracking_number']) : '';

// กำหนดข้อความที่จะใช้อัปเดตหลังจากการส่งฟอร์ม
$status_message = "";

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
        $status_message = "<h2 class='text-center mb-4'>ข้อมูลพัสดุ</h2>
                           <div class='list-group'>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>หมายเลขติดตาม:</strong> " . htmlspecialchars($row['tracking_number']) . "
                               </div>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>ชื่อผู้ส่ง:</strong> " . htmlspecialchars($row['sender_name']) . "
                               </div>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>ชื่อผู้รับ:</strong> " . htmlspecialchars($row['receiver_name']) . "
                               </div>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>สถานะพัสดุ:</strong> " . htmlspecialchars($row['status']) . "
                               </div>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>ที่อยู่ปลายทาง:</strong> " . htmlspecialchars($row['delivery_address']) . "
                               </div>
                               <div class='list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
                                   <strong>พนักงานขนส่ง:</strong> " . htmlspecialchars($row['employee_name']) . "
                               </div>
                           </div>";
    } else {
        $status_message = "<p>ไม่พบข้อมูลพัสดุ</p>";
    }

    // ปิด statement
    $stmt->close();
} else {
    $status_message = "<p>กรุณากรอกหมายเลขติดตาม</p>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>



<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เช็คสถานะพัสดุ</title>

    <!-- เพิ่ม Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- เพิ่ม Icon (Font Awesome) สำหรับการใช้ไอคอน -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #343a40;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            background: linear-gradient(145deg, #ff6f61, #ff3b30);
            color: white;
            border-radius: 20px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.3);
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
        }

        .btn {
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #ff6f61;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff3b30;
        }

        .alert-custom {
            border-radius: 15px;
            background-color: #ff3b30;
            color: white;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Card Section -->
        <div class="card shadow-lg">
            <div class="card-header">
                เช็คสถานะพัสดุ
            </div>
            <div class="card-body">
                <!-- Form -->
                <form method="POST" action="check_status.php">
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">หมายเลขติดตาม</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number" placeholder="กรุณากรอกหมายเลขติดตาม" required>
                    </div>
                    <button type="submit" class="btn btn-primary">ค้นหาสถานะ <i class="fas fa-search"></i></button>
                </form>

                <!-- แสดงข้อความสถานะพัสดุ -->
                <div id="status_message" class="mt-3">
                    <?php 
                        echo $status_message; 
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- เพิ่ม Bootstrap 5 และ JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- JavaScript สำหรับการแสดงผล alert หลังจากการค้นหา -->
    <script>
        const form = document.querySelector('form');
        const statusMessageDiv = document.getElementById('status_message');

        form.addEventListener('submit', function(event) {

            const trackingNumber = document.getElementById('tracking_number').value;

            // กำหนดข้อความที่จะแสดงหลังจาก submit ฟอร์ม
            if (trackingNumber) {
                statusMessageDiv.innerHTML = `<div class="alert alert-custom text-center">กำลังค้นหาสถานะพัสดุหมายเลข: <strong>${trackingNumber}</strong></div>`;   
            } else {
                statusMessageDiv.innerHTML = `<div class="alert alert-custom text-center">กรุณากรอกหมายเลขติดตาม</div>`;
            }
        });
    </script>
</body>

</html>
