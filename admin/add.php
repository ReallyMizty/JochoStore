<?php
// PHP Logic
include("../db/db_connection.php");

if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$tracking_number = isset($_POST['tracking_number']) ? trim($_POST['tracking_number']) : '';

if (!empty($tracking_number)) {
    $stmt = $conn->prepare("SELECT * FROM packages WHERE tracking_number = ?");
    if ($stmt === false) {
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
        exit;
    }
    
    $stmt->bind_param("s", $tracking_number);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!-- HTML Output -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาพัสดุ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
    <div class="container">
        <h2>ค้นหาพัสดุ</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="tracking_number">หมายเลขติดตาม:</label>
                <input type="text" class="form-control" id="tracking_number" name="tracking_number" required>
            </div>
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </form>

        <?php if (!empty($tracking_number)): ?>
            <?php if (isset($package)): ?>
                <div class="card">
                    <div class="card-header">
                        หมายเลขติดตาม:: <?php echo htmlspecialchars($package['tracking_number']); ?>
                    </div>
                    <div class="card-body">
                        <p><strong>ขนส่ง:</strong> <?php echo htmlspecialchars($package['employee_name']); ?></p>
                        <p><strong>สถานะพัสดุ:</strong> <?php echo htmlspecialchars($package['status']); ?></p>
                        <p><strong>เวลา:</strong> <?php echo htmlspecialchars($package['created_at'] . " น."); ?></p>
                        <p><strong>ชื่อผู้รับ:</strong> <?php echo htmlspecialchars($package['recipient_name']); ?></p>
                        <p><strong>ที่อยู่ปลายทาง:</strong> <?php echo htmlspecialchars($package['delivery_address']); ?></p>
                        <p><strong>หมายเลขติดต่อ:</strong> <?php echo htmlspecialchars($package['recipient_number']); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header">
                        ข้อมูลพัสดุหมายเลข: <?php echo htmlspecialchars($tracking_number); ?>
                    </div>
                    <div class="card-body">
                        <p><strong>ไม่พบหมายเลขพัสดุ</strong></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h2 class="text-center mb-4">กรุณากรอกหมายเลขพัสดุ!!!</h2>
        <?php endif; ?>
    </div>
</body>
</html>