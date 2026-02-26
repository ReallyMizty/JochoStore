<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สำเร็จ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            color: #28a745;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h1>แจ้งชำระเงินสำเร็จ!</h1>
        <p>ขอบคุณที่ใช้บริการของเรา เราจะตรวจสอบการชำระเงินและแจ้งผลให้คุณทราบภายใน 24 ชั่วโมง</p>
        <a href="send_line_notify.php" class="btn btn-success">ชำระเงินเสร๊จสิน</a>
    </div>
</body>
</html>