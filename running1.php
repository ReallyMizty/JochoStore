<?php
	include("function/session.php");
	include("db/dbconn.php");
?>
<!DOCTYPE html>
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
				<li>ยินดีต้อนรับ&nbsp;&nbsp;&nbsp;<a href="#profile" href  data-toggle="modal"><i class="icon-user icon-white"></i><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname'];?></a></li>
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
									<td class="profile">นามสกุล</td><td class="profile"><?php echo $fetch['address'];?></td>
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
				<li><a href="home.php"><i class="icon-home"></i>หน้าแรก</a></li>
				<li><a href="product1.php"><i class="icon-th-list"></i>หมวดหมู่สินค้า</a>
				<li><a href="kuychamp_Express_track.php"><i class="icon-th-list"></i>เช็คสถานะพัสดุ</a>
			
			</ul>
		</div>

		<div class="nav1">
			<ul>
				<li><a href="product1.php">รองเท้าบาส</a></li>
				<li>|</li>
				<li><a href="football1.php">รองเท้าฟุตบอล</a></li>
				<li>|</li>
				<li><a href="running1.php" class="active" style="color:#111;">รองเท้าวิ่ง</a></li>
			</ul>
				<a href="cart.php"><button class="btn btn-inverse" style="right:1%; position:fixed; top:10%;"><i class="icon-shopping-cart icon-white"></i> ตะกร้าสืนค้า</button></a>
		</div>

	<div id="content">
		<br />
		<br />
		<div id="product">

			<?php

				$query = $conn->query("SELECT *FROM product WHERE category='running' ORDER BY product_id DESC") or die (mysqli_error());

					while($fetch = $query->fetch_array())
						{

						$pid = $fetch['product_id'];

						$query1 = $conn->query("SELECT * FROM stock WHERE product_id = '$pid'") or die (mysqli_error());
						$rows = $query1->fetch_array();

						$qty = $rows['qty'];
						if($qty <= 5){

						}else{
							echo "<div class='float'>";
							echo "<center>";
							echo "<a href='details.php?id=".$fetch['product_id']."'><img class='img-polaroid' src='photo/".$fetch['product_image']."' height = '300px' width = '300px'></a>";
							echo "".$fetch['product_name']."";
							echo "<br />";
							echo "Rs ".$fetch['product_price']."";
							echo "<br />";
							echo "<h3 class='text-info' style='position:absolute; margin-top:-90px; text-indent:15px;'> Size: ".$fetch['product_size']."</h3>";
							echo "</center>";
							echo "</div>";
						}

						}
			?>
		</div>




	</div>

	<br />
</div>
	<br />
	<div id="footer">
		<div class="foot">
			<label style="font-size:17px;"> Copyright &copy; </label>
			<p style="font-size:25px;">ร้านขายรองเท้าผ้าใบออนไลน์</p>
		</div>

			<div id="foot">
				<h4>Links</h4>
					<ul>
						<a href=" "><li>Facebook</li></a>
						<a href=" "><li>Twitter</li></a>
						<a href=" "><li>Pinterest</li></a>
						<a href=" "><li>Tumblr</li></a>
					</ul>
			</div>
	</div>
</body>
</html>