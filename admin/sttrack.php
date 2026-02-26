<?php
include("../db/db_connection.php"); // นำเข้าไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่า tracking_number มีอยู่ใน $_GET หรือไม่
if (isset($_GET['tracking_number'])) {
    $tracking_number = $_GET['tracking_number'];

    // ค้นหาพัสดุในฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM packages WHERE tracking_number = :tracking_number");
    $stmt->bindParam(':tracking_number', $tracking_number);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($package) {
        echo "หมายเลขพัสดุ: " . $package['tracking_number'] . "<br>";
        echo "ชื่อผู้รับ: " . $package['recipient_name'] . "<br>";
        echo "สถานะ: " . $package['status'] . "<br>";

        // แสดงประวัติสถานะ
        $stmt = $conn->prepare("SELECT * FROM status_updates WHERE package_id = :package_id ORDER BY updated_at DESC");
        $stmt->bindParam(':package_id', $package['id']);
        $stmt->execute();
        $status_updates = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>ประวัติสถานะ</h3>";
        foreach ($status_updates as $update) {
            echo "สถานะ: " . $update['status'] . " at " . $update['updated_at'] . "<br>";
        }
    } else {
        echo "Package not found!";
    }
} else {
    echo "กรุณากรอกหมายเลขติดตาม";
}
?>

<form method="GET">
    
หมายเลขติดตาม: <input type="text" name="tracking_number" required><br>
    <input type="submit" value="ติดตามพัสดุ">
</form>

