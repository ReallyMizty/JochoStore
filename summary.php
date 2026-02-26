<?php
	include("function/session.php");
	include("db/dbconn.php");
?>
<html>
<head>
	<title>ร้านขายรองเท้าผ้าใบออนไลน์</title>
	<link rel="icon" href="img/logo.jpg" />
	<link rel = "stylesheet" type = "text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/button.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/tab.js"></script>
	<script src="js/tooltip.js"></script>
	<script src="js/popover.js"></script>
	<script src="js/collapse.js"></script>
	<script src="js/modal.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/alert.js"></script>
	<script src="js/transition.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>

	<div id="header">
		<img src="img/logo.jpg">
		<label>ร้านขายรองเท้าผ้าใบออนไลน์</label>

			<?php
				$id = (int) $_SESSION['id'];

					$query = $conn->query ("SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_error());
					$fetch = $query->fetch_array ();
			?>

			<ul>
				<li><a href="function/logout.php"><i class="icon-off icon-white"></i>ล็อกเอาท์</a></li>
				<li>ยินดีต้อนรับ&nbsp;&nbsp;&nbsp;<a href="#profile"  data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
			</ul>
	</div>

	<div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">ผู้ใช้งาน</h3>
				</div>
					<div class="modal-body">                                                                    
						<?php                                                                                                                                                                                                                                                                                                                                                            
							$id = (int) $_SESSION['id'];

								$query = $conn->query ("SELECT * FROM customer WHERE customerid = '$id' ") or die (mysqli_error());
								$fetch = $query->fetch_array ();
						?>
						<center>
					<form method="post">
						<center>
							<table>
								<tr>
									<td class="profile">ชื่อจริง</td><td class="profile"><?php echo $fetch['firstname'];?>&nbsp;&nbsp;<?php echo $fetch['lastname'];?></td>
								</tr>
								<tr>
									<td class="profile">ที่อยู่</td><td class="profile"><?php echo $fetch['address'];?></td>
								</tr>
								<tr>
									<td class="profile">ประเทศ</td><td class="profile"><?php echo $fetch['country'];?></td>
								</tr>
								<tr>
									<td class="profile">รหัสไปรษณีย์</td><td class="profile"><?php echo $fetch['zipcode'];?></td>
								</tr>
								<tr>
									<td class="profile">เบอร์โทร</td><td class="profile"><?php echo $fetch['mobile'];?></td>
								</tr>
								
								<tr>
									<td class="profile">อีเมล์</td><td class="profile"><?php echo $fetch['email'];?></td>
								</tr>
							</table>
						</center>
					</div>
				<div class="modal-footer">
					<a href="account.php?id=<?php echo $fetch['customerid']; ?>"><input type="button" class="btn btn-success" name="edit" value="แก้ไขผู้ใช้งาน"></a>
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ออก</button>
				</div>
					</form>
			</div>



	<br>
<div id="container">
	<div class="nav">
			 <ul>
				<li><a href="home.php">   <i class="icon-home"></i>หน้าแรก</a></li>
				<li><a href="product1.php"> <i class="icon-th-list"></i>หมวดหมู๋สินค้า</a></li>
				<li><a href="kuychamp_Express_track.php"><i class="icon-th-list"></i>เช็คสถานะพัสดุ</a>
			
			</ul>
	</div>

	<form method="post" class="well"  style="background-color:#fff; overflow:hidden;">
	<table class="table" style="width:50%;">
	<label style="font-size:25px;">หน้าออเดอร์สินค้า</label>
		<tr>
			<th><h5>จำนวน</h5></td>
			<th><h5>ชื่อสินค้า</h5></td>
			<th><h5>ไซต์</h5></td>
			<th><h5>ราคา</h5></td>
		</tr>


		<?php
		$t_id = $_GET['tid'];
		$query = $conn->query("SELECT * FROM transaction WHERE transaction_id = '$t_id'") or die (mysqli_error());
		$fetch = $query->fetch_array();

		$amnt = $fetch['amount'];
		$t_id = $fetch['transaction_id'];

		$query2 = $conn->query("SELECT * FROM transaction_detail LEFT JOIN product ON product.product_id = transaction_detail.product_id WHERE transaction_detail.transaction_id = '$t_id'") or die (mysqli_error());
		while($row = $query2->fetch_array()){

		$pname = $row['product_name'];
		$psize = $row['product_size'];
		$pprice = $row['product_price'];
		$oqty = $row['order_qty'];

		echo "<tr>";
		echo "<td>".$oqty."</td>";
		echo "<td>".$pname."</td>";
		echo "<td>".$psize."</td>";
		echo "<td>".$pprice."</td>";
		echo "</tr>";
		}
		?>



	</table>
	<h4> เก็บปลายทาง</h4>
	<input type="checkbox" name="chkColor1" value="Red"  >ยืนยัน<br>
	<legend></legend>


	<h4>ราคารวม <?php echo $amnt; ?></h4>
	</form>

	<input type="submit" name="Submit2" value="ชำระเงิน" onclick='location.replace("payment_form.php")'>

</div>
	</div>

		<br />
		<br />
</div>
<br />
	<div id="footer">
		<div class="foot">
			<label style="font-size:17px;"> ยินดีต้อนรับ &copy; </label>
			<p style="font-size:25px;">ร้านขายรองเท้าผ้าใบออนไลน์</p>
		</div>

			<div id="foot">
				<h4>ลิงค์</h4>
					<ul>
						<a href=""><li>Facebook</li></a>
						<a href=""><li>Twitter</li></a>
						<a href=""><li>Pinterest</li></a>
						<a href=""><li>Tumblr</li></a>
					</ul>
			</div>
	</div>
</body>
</html>


