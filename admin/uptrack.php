<?php
include("../db/db_connection.php"); // นำเข้าไฟล์เชื่อมต่อฐานข้อมูล

// ดึงข้อมูล package_id จากตาราง packages
$stmt = $conn->query("SELECT id FROM packages");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_id = $_POST['package_id'];
    $status = $_POST['status'];

    // เพิ่มข้อมูลในตาราง status_updates
    $stmt = $conn->prepare("INSERT INTO status_updates (package_id, status) VALUES (:package_id, :status)");
    $stmt->bindParam(':package_id', $package_id, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    if ($stmt->execute()) {
        echo '<div class="alert alert-custom mt-3" role="alert">สถานะอัพเดทสำเร็จ</div>';
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
            <h2 class="mb-0"><i class="fas fa-sync-alt"></i> อัพเดทสถานะพัสดุ</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="package_id" class="form-label">อันดับเลขติดตามพัสดุ</label>
                    <select class="form-select" id="package_id" name="package_id" required>
                        <?php foreach ($packages as $package): ?>
                            <option value="<?php echo $package['id']; ?>"><?php echo $package['id']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">อัพเดทสถานะ</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> อัพเดทสถานะ</button>
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
        background-color: #28a745;
        color: white;
        font-size: 18px;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        margin-top: 20px;
    }
</style>