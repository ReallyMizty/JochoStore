<?php
	include("../function/session.php");
	include("../db/dbconn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>ร้านขายรองเท้าผ้าใบออนไลน์</title>
	<link rel = "stylesheet" type = "text/css" href="../css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery-1.7.2.min.js"></script>
	<script src="../js/carousel.js"></script>
	<script src="../js/button.js"></script>
	<script src="../js/dropdown.js"></script>
	<script src="../js/tab.js"></script>
	<script src="../js/tooltip.js"></script>
	<script src="../js/popover.js"></script>
	<script src="../js/collapse.js"></script>
	<script src="../js/modal.js"></script>
	<script src="../js/scrollspy.js"></script>
	<script src="../js/alert.js"></script>
	<script src="../js/transition.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../javascripts/filter.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<div id="header" style="position:fixed;">
		<img src="../img/logo.jpg">
		<label>ร้านขายรองเท้าผ้าใบออนไลน์</label>

			<?php
				$id = (int) $_SESSION['id'];

					$query = $conn->query ("SELECT * FROM admin WHERE adminid = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>

			<ul>
				<li><a href="../function/admin_logout.php"><i class="icon-off icon-white"></i>ล็อกเอาท์</a></li>
				<li>ยินดีต้อนรับ&nbsp;&nbsp;&nbsp;<a><i class="icon-user icon-white"></i><?php echo $fetch['username']; ?></a></li>
			</ul>
	</div>

	<br>

	<div id="leftnav">
		<ul>
			<li><a href="admin_home.php" style="color:#333;">ตารางสถิติ</a></li>
			<li><a href="admin_home.php">สินค้า</a>
				<ul>
					<li><a href="admin_feature.php "style="font-size:15px; margin-left:15px;">คุณสมบัติ</a></li>
					<li><a href="admin_product.php "style="font-size:15px; margin-left:15px;">รองเท้าบาส</a></li>
					<li><a href="admin_football.php" style="font-size:15px; margin-left:15px;">รองเท้าฟุตบอล</a></li>
					<li><a href="admin_running.php"style="font-size:15px; margin-left:15px;">รองเท้าวิ่ง</a></li>
				</ul>
			</li>
			<li><a href="transaction.php">การทำธุรกรรม</a></li>
			<li><a href="customer.php">รายชื่อลูกค้า</a></li>
			<li><a href="message.php">แชท</a></li>
			<li><a href="order.php">ออเดอร์</a></li>
		</ul>
	</div>

	<div id="rightcontent" style="position:absolute; top:10%;">
			<div class="alert alert-info"><center><h2>รายชื่อลูกค้า</h2></center></div>
			<br />
				<label  style="padding:5px; float:right;"><input type="text" name="filter" placeholder="ค้นหาชื่อลูกค้า" id="filter"></label>
			<br />

		<div class="alert alert-info">
			<table class="table table-hover" style="background-color:;">
				<thead>
				<tr style="font-size:20px;">
					<th>ชื่อ</th>
					<th>ที่อยู่</th>
					<th>ประเทศ</th>
					<th>รหัสไปรษณีย์</th>
					<th>เบอร์โทร</th>
					
					<th>อีเมล์</th>
				</tr>
				</thead>
				<?php
					$query = $conn->query("SELECT * FROM `customer`") or die(mysqli_error());
					while($fetch = $query->fetch_array())
						{
				?>
				<tr>
					<td><?php echo $fetch['firstname'];?>&nbsp;&nbsp;<?php echo  $fetch['lastname'];?></td>
					<td><?php echo $fetch['address']?></td>
					<td><?php echo $fetch['country']?></td>
					<td><?php echo $fetch['zipcode']?></td>
					<td><?php echo $fetch['mobile']?></td>
					
					<td><?php echo $fetch['email']?></td>
				</tr>
				<?php
					}
				?>
			</table>
		</div>

	</div>



</body>
</html>
