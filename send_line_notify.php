<?php

/**
 * ส่งข้อความแจ้งเตือนผ่าน Line Notify
 *
 * @param string $message ข้อความที่ต้องการส่ง
 * @param string $token Token ของ Line Notify
 * @return array ผลลัพธ์จากการส่งข้อความ
 */
function sendLineNotify($message, $token) {
    // URL ของ Line Notify API
    $url = 'https://notify-api.line.me/api/notify';

    // Headers สำหรับการส่ง request
    $headers = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token
    ];

    // ข้อมูลที่ต้องการส่ง (ข้อความ)
    $data = ['message' => $message];

    // เริ่มต้น cURL
    $ch = curl_init();

    // ตั้งค่า options สำหรับ cURL
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false, // ปิดการตรวจสอบ SSL (ไม่แนะนำสำหรับ production)
    ]);

    // ส่ง request และรับ response
    $response = curl_exec($ch);

    // ตรวจสอบข้อผิดพลาด
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ['status' => 'error', 'message' => $error_msg];
    }

    // ปิดการเชื่อมต่อ cURL
    curl_close($ch);

    // แปลง response เป็น array
    $response_data = json_decode($response, true);

    // ตรวจสอบสถานะการส่ง
    if (isset($response_data['status']) && $response_data['status'] == 200) {
        return ['status' => 'success', 'message' => 'ส่งข้อความสำเร็จ'];
    } else {
        return ['status' => 'error', 'message' => $response_data['message'] ?? 'เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุ'];
    }
}

// ตัวอย่างการใช้งาน
$token = 'CAcoK6vLTCd59bhlQqUV2MEGkZqcP0L6VOuszAPFXGA'; // แทนที่ด้วย Token ของคุณ
$message = 'สวัสดีครับ ลูกค้าได้ทำการชำระเงินมาเรียบร้อยแล้ว โปรดรอเลขพัสดุ ภายใน 24 ช.ม นะครับ';

// ส่งข้อความ
$result = sendLineNotify($message, $token);

// แสดงผลลัพธ์
if ($result['status'] === 'success') {
    echo "✅ สำเร็จ: " . $result['message'];
} else {
    echo "❌ ข้อผิดพลาด: " . $result['message'];
}

?>

<input type="submit" name="Submit2" value="กลับไปหน้าหลัก" onclick='location.replace("index.php")'>