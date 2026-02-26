<?php
	include("function/login.php");
	include("function/customer_signup.php");
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
			<ul>
				<li><a href="#signup"   data-toggle="modal">สมัครสมาชิก</a></li>
				<li><a href="#login"   data-toggle="modal">ล็อกอิน</a></li>
			</ul>
	</div>
		<div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">ล็อกอิน</h3>
			</div>
				<div class="modal-body">
					<form method="post">
					<center>
						<input type="email" name="email" placeholder="Email" style="width:250px;">
						<input type="password" name="password" placeholder="Password" style="width:250px;">
					</center>
				</div>
			<div class="modal-footer">
				<input class="btn btn-primary" type="submit" name="login" value="ล็อกอิน">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ออก</button>
					</form>
			</div>
		</div>

		<div id="login1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">โปรดล็อกอินเพื่อชำระเงิน</h3>
			</div>
				<div class="modal-body">
					<form method="post">
					<center>
						<input type="email" name="email" placeholder="Email" style="width:250px;">
						<input type="password" name="password" placeholder="Password" style="width:250px;">
					</center>
				</div>
			<div class="modal-footer">
				<p style="float:left;">ไม่มีผู้ใช้งาน <a href="#signup" data-toggle="modal">สมัครสมาชิก</a></p>
				<input class="btn btn-primary" type="submit" name="login" value="Login">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ออก</button>
					</form>
			</div>
		</div>

		<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">สมัครสมาชิก</h3>
				</div>
					<div class="modal-body">
						<center>
					<form method="post">
						<input type="text" name="firstname" placeholder="ชื่อจริง" required>
						
						<input type="text" name="lastname" placeholder="นามสกุล" required>
						<input type="text" name="address" placeholder="ที่อยู๋" style="width:430px;"required>
						<input type="text" name="country" placeholder="ประเทศ" required>
						<input type="text" name="zipcode" placeholder="รหัสไปรษณีย์" required maxlength="6">
						<input type="text" name="mobile" placeholder="เบอร์โทร" maxlength="11">
						
						<input type="email" name="email" placeholder="อีเมล์" required>
						<input type="password" name="password" placeholder="รหัสผ่าน" required>
						</center>
					</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" name="signup" value="สมัครสมาชิก">
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ออก</button>
				</div>
					</form>
			</div>
	<br>
<div id="container">
	<div class="nav">

			 <ul>
				<li><a href="index.php"><i class="icon-home"></i>หน้าแรก</a></li>
				<li><a href="product.php"><i class="icon-th-list"></i>หมวดหมู๋สินค้า</a>
				<li><a href="kuychamp_Express_track.php"><i class="icon-th-list"></i>เช็คสถานะพัสดุ</a>
				
	<div class="nav1">
		<ul>
			<li><a href="product.php" class="active" style="color:#111;">รองเท้าบาส</a></li>
			<li>|</li>
			<li><a href="football.php">รองเท้าฟุตบอล</a></li>
			<li>|</li>
			<li><a href="running1.php">รองเท้าวิ่ง</a></li>
		</ul>

	</div>

	<div id="content">
		<br />
		<br />
		<div id="product">

			<?php
			include ('function/addcart.php');

				$query = $conn->query("SELECT *FROM product WHERE category='basketball' ORDER BY product_id DESC") or die (mysqli_error());

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
