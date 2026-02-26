<?php
require_once("../db/dbconn.php");
require_once("../function/session.php");

?>

<?php
function getOrders($conn) {
    $stmt = $conn->prepare("SELECT * FROM transaction WHERE order_stat = 'ชำระเงินแล้ว'");
    $stmt->execute();
    $result = $stmt->get_result(); // ดึงผลลัพธ์จาก statement
    $orders = $result->fetch_all(MYSQLI_ASSOC); // ดึงข้อมูลทั้งหมดเป็นอาร์เรย์
}

function getOrderDetails($conn, $transaction_id) {
    $stmt = $conn->prepare("
        SELECT td.*, p.product_name, p.product_price 
        FROM transaction_detail td
        LEFT JOIN product p ON td.product_id = p.product_id
        WHERE td.transaction_id = :transaction_id
    ");
    $stmt->bindParam(':transaction_id', $transaction_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function formatMoney($number, $fractional = false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

$orders = getOrders($conn);
$totalAmount = 0;
?>

<div id="rightcontent" style="position:absolute; top:10%;">
    <div class="alert alert-info">
        <center><h2>ออเดอร์</h2></center>
    </div>
    <br />
    <div style='width:975px;' class="alert alert-info">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>รองเท้า</th>
                    <th>หมายเลขธุรกรรม</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <?php
                    $transaction_id = $order['transaction_id'];
                    $orderDetails = getOrderDetails($conn, $transaction_id);
                    foreach ($orderDetails as $detail):
                        $totalAmount += $detail['product_price'] * $detail['order_qty'];
                    ?>
                        <tr>
                            <td><?= $detail['product_name'] ?></td>
                            <td><?= $transaction_id ?></td>
                            <td><?= $detail['order_qty'] ?></td>
                            <td><?= formatMoney($detail['product_price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>รวมทั้งหมด:</strong></td>
                    <td><strong><?= formatMoney($totalAmount) ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
if (isset($_POST['add'])) {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $qty = $_POST['qty'];

    $code = rand(0, 98987787866533499);
    $name = $code . $_FILES["product_image"]["name"];
    $temp = $_FILES["product_image"]["tmp_name"];

    if ($_FILES["product_image"]["error"] > 0) {
        die("Error uploading file! Code " . $_FILES["product_image"]["error"]);
    }

    if ($_FILES["product_image"]["size"] > 30000000000) {
        die("File size is too big!");
    }

    move_uploaded_file($temp, "../photo/" . $name);

    try {
        $conn->beginTransaction();

        // เพิ่มสินค้า
        $stmt1 = $conn->prepare("
            INSERT INTO product (product_id, product_name, product_price, product_size, product_image, brand, category)
            VALUES (:product_code, :product_name, :product_price, :product_size, :product_image, :brand, :category)
        ");
        $stmt1->bindParam(':product_code', $product_code);
        $stmt1->bindParam(':product_name', $product_name);
        $stmt1->bindParam(':product_price', $product_price);
        $stmt1->bindParam(':product_size', $product_size);
        $stmt1->bindParam(':product_image', $name);
        $stmt1->bindParam(':brand', $brand);
        $stmt1->bindParam(':category', $category);
        $stmt1->execute();

        // เพิ่มสต็อก
        $stmt2 = $conn->prepare("INSERT INTO stock (product_id, qty) VALUES (:product_code, :qty)");
        $stmt2->bindParam(':product_code', $product_code);
        $stmt2->bindParam(':qty', $qty);
        $stmt2->execute();

        $conn->commit();
        header("Location: admin_product.php");
    } catch (PDOException $e) {
        $conn->rollBack();
        die("เกิดข้อผิดพลาด: " . $e->getMessage());
    }
}
?>

<div id="header" style="position:fixed;">
  <img src="../img/logo.jpg"width=50,height 40>
    <label>ร้านขายรองเท้าผ้าใบออนไลน์</label>
    <ul>
        <li><a href="../function/admin_logout.php"><i class="icon-off icon-white"></i>ล็อกเอาท์</a></li>
        <li>ยินดีต้อนรับ&nbsp;&nbsp;&nbsp;<i class="icon-user icon-white"></i><?php echo $fetch['username']; ?></a></li>
			</ul>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>


