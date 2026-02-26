<?php
require 'db/db_connection.php'; // นำเข้าไฟล์เชื่อมต่อฐานข้อมูล

// ดึงข้อมูล package_id จากตาราง packages
$stmt = $conn->query("SELECT id FROM packages");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_id = $_POST['package_id'];
    $status = $_POST['status'];

    // เพิ่มข้อมูลในตาราง status_updates
    $stmt = $conn->prepare("INSERT INTO status_updates (package_id, status) VALUES (:package_id, :status)");
    $stmt->bindParam(':package_id', $package_id);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    echo "สถานะอัพเดทสำเร็จ";
}
?>

<form method="POST">
    อันดับเลขติดตามพัสดุ 
    <select name="package_id" required>
        <?php foreach ($packages as $package): ?>
            <option value="<?php echo $package['id']; ?>"><?php echo $package['id']; ?></option>
        <?php endforeach; ?>
    </select><br>
    อัพเดทสถานะ <input type="text" name="status" required><br>
    <input type="submit" value="อัพเดทสถานะ">
</form>