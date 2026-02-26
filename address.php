<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ดึงข้อมูลที่ผู้ใช้กรอกจากฟอร์ม
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $phone = htmlspecialchars($_POST['phone']);
    
    // แสดงข้อมูลที่กรอกเข้ามา (คุณสามารถใช้ข้อมูลนี้ไปประมวลผลต่อได้)
    echo "<h3>ข้อมูลที่อยู่จัดส่ง:</h3>";
    echo "ชื่อ: $name<br>";
    echo "ที่อยู่: $address<br>";
    echo "เมือง: $city<br>";
    echo "รหัสไปรษณีย์: $zipcode<br>";
    echo "เบอร์โทรศัพท์: $phone<br>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มที่อยู่จัดส่ง</title>
</head>
<body>
    <h2>กรอกข้อมูลที่อยู่จัดส่ง</h2>

    <form method="POST" action="">
        <label for="name">ชื่อ:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="address">ที่อยู่:</label><br>
        <textarea id="address" name="address" rows="4" required></textarea><br><br>
        
        <label for="city">เมือง:</label><br>
        <input type="text" id="city" name="city" required><br><br>
        
        <label for="zipcode">รหัสไปรษณีย์:</label><br>
        <input type="text" id="zipcode" name="zipcode" required><br><br>
        
        <label for="phone">เบอร์โทรศัพท์:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <input type="submit" value="ส่งข้อมูล">
    </form>
</body>
</html>
