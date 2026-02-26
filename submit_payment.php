<?php
include('db/db_connection.php'); // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $order_id = $_POST['order_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $detail = $_POST['detail'];

    // ตรวจสอบไฟล์ที่อัปโหลด
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // โฟลเดอร์สำหรับเก็บไฟล์
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
        }

        $file_name = basename($_FILES['uploadfile']['name']);
        $file_path = $upload_dir . $file_name;

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)) {
            // บันทึกข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO payments (order_id, name, email, mobile, detail, file_path) 
                    VALUES (:order_id, :name, :email, :mobile, :detail, :file_path)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mobile', $mobile);
            $stmt->bindParam(':detail', $detail);
            $stmt->bindParam(':file_path', $file_path);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถอัปโหลดไฟล์ได้']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'กรุณาแนบไฟล์หลักฐานการโอน']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'วิธีการร้องขอไม่ถูกต้อง']);
}
?>