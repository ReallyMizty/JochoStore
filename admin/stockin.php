<!--Add Administrator facebox-->
  <div >
  <?php
  include("../db/dbconn.php");
  $id = $_GET['id'];
  ?>
	<div class="login_title"><span>เพื่มจำนวนสินค้า</span></div>
	<br>
		<form method="post" >
			<table class="login">
				<tr><td><input type="hidden" name="pid" autocomplete="off" class="input-large number" id="text" value="<?php echo $id; ?>" required/></td></tr>
				<tr><td><input type="number" name="new_stck" autocomplete="off" class="input-large number" id="text" placeholder="กรอกเลขเพื่มสินค้า" required/></td></tr>
				<tr><td><button name="stockin" type="submit" class="btn btn-block btn-large btn-info"><i class="icon-ok-sign icon-white"></i> บันทึกข้อมูล</button></td></tr>
			</table>
		</form>
  </div><!--/end facebox-->	
