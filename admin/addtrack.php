<?php
include("../db/db_connection.php");  // นำเข้าไฟล์เชื่อมต่อฐานข้อมูล  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $tracking_number = $_POST['tracking_number'];
    $recipient_name = $_POST['recipient_name'];
    $delivery_address = $_POST['delivery_address'];
    $employee_name  = $_POST['employee_name'];
    $recipient_number = $_POST['recipient_number'];

    $status = 'ลงทะเบียนแล้ว'; // สถานะเริ่มต้น

    // Prepare the SQL query
    $sql = "INSERT INTO packages (tracking_number, recipient_name, status, delivery_address, employee_name, recipient_number) 
            VALUES (:tracking_number, :recipient_name, :status, :delivery_address, :employee_name, :recipient_number)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . implode(" ", $conn->errorInfo()));
    }

    // Bind parameters
    $stmt->bindParam(':tracking_number', $tracking_number);
    $stmt->bindParam(':recipient_name', $recipient_name);
    $stmt->bindParam(':delivery_address', $delivery_address);
    $stmt->bindParam(':employee_name', $employee_name);
    $stmt->bindParam(':recipient_number', $recipient_number);
    $stmt->bindParam(':status', $status);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo '<div class="alert alert-success mt-3" role="alert">อัพเดทเรียบร้อยแล้ว</div>';
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">เกิดข้อผิดพลาด: ' . implode(" ", $stmt->errorInfo()) . '</div>';
    }
}
?>

<!-- เพิ่ม Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- เพิ่ม Icon (Font Awesome) สำหรับการใช้ไอคอน -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-box-open"></i> เพิ่มข้อมูลพัสดุ</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="tracking_number" class="form-label">หมายเลขติดตาม</label>
                    <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
                </div>
                <div class="mb-3">
                    <label for="recipient_name" class="form-label">ชื่อผู้รับ</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
                </div>
                <div class="mb-3">
                    <label for="delivery_address" class="form-label">ที่อยู่จัดส่ง</label>
                    <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                </div>
                <div class="mb-3">
                    <label for="employee_name" class="form-label">ขนส่ง</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" required>
                </div>
                <div class="mb-3">
                    <label for="recipient_number" class="form-label">เบอร์โทร</label>
                    <input type="text" class="form-control" id="recipient_number" name="recipient_number" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
            </form>
        </div>
    </div>
</div>
<input type="submit" name="Submit2" value="ย้อนกลับ" onclick='location.replace("admin_home.php")'>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    .card-body {
        padding: 30px;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
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
</style>