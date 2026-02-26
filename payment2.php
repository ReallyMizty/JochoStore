<?php
require 'pay/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Response\QrCodeResponse;

// ข้อมูลการชำระเงิน
$amount = 100.00; // จำนวนเงิน
$merchantName = "ร้านขายรองเท้าออนไลน์"; // ชื่อร้านค้า
$merchantId = "1234567890"; // รหัสผู้ขาย (PromptPay ID)
$currency = "THB"; // สกุลเงิน

// สร้างข้อมูลสำหรับ QR Code (ตามมาตรฐาน Thai QR Payment)
$qrData = "00020101021129370016A000000677010111011300660000000005802TH53037646304" . strlen($merchantName) . $merchantName . "5802TH5406" . number_format($amount, 2, '.', '') . "6304";

// สร้าง QR Code
$qrCode = new QrCode($qrData);
$qrCode->setSize(300); // ขนาด QR Code
$qrCode->setMargin(10); // ระยะขอบ
$qrCode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)); // ระดับการแก้ไขข้อผิดพลาด

// บันทึก QR Code เป็นไฟล์ภาพ
$qrCode->writeFile('assets/images/qrcode.png');

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงินด้วย QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">ชำระเงินด้วย QR Code</h1>
        <div class="text-center">
            <p>สแกน QR Code ด้านล่างเพื่อชำระเงิน</p>
            <img src="assets/images/qrcode.png" alt="QR Code" class="img-fluid">
            <p class="mt-3"><strong>จำนวนเงิน: <?php echo number_format($amount, 2); ?> บาท</strong></p>
            <a href="index.php" class="btn btn-secondary">กลับไปหน้ารายการสินค้า</a>
        </div>
    </div>
</body>
</html>