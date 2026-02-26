<?php
      include('db/dbconn.php');
	  include("function/payment2.php");

?>
<!DOCTYPE html>
<!-- saved from url=(0040)https://www.allnewstep.com/informpayment -->
<html lang="th" class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=1200">
<title>ร้านขายรองเท้าผ้าใบออนไลน์</title>
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

</script>
	

	<script type="text/javascript" async="" src="./แจ้งชำระเงิน "></script><script type="text/javascript" async="" src="./แจ้งชำระเงิน "></script><script type="text/javascript" async="" src="./แจ้งชำระเงิน - ArduinoAll ขาย Arduino ซื้อ Arduino อุปกรณ์ Arduino Sensor ส่งฟรี_files/f(2).txt"></script><style type="text/css" media="screen">#comodoTL {display:block;font-size:8px;padding-left:18px;}</style></head>
<body class="scrollFixed">



                                                     
<center><div class="payment_notice">แจ้งการชำระเงิน</div></center>
<center><div class="LHEADER"><h2 class="headerText">รายละเอียดการโอนเงิน</h2></div><form id="inform_payment_form" onsubmit="return inform_payment_submit();">
<table width="500" cellspacing="0" cellpadding="0" align="center" class="paymentForm FORMTABLE">
<tbody><c/center>
<tr>

<td class="nameTD">หลักฐานการโอน :</td>
<td class="inputTD"><div id="inform_fileupload_container"><input type="file" name="uploadfile" id="inform_fileupload"><span class="uploaded_file"></span><input type="hidden" name="file" value=""><br><div class="file_progress"></div><span><span>การแนบหลักฐานจะช่วยทำให้ตรวจสอบได้เร็วขึ้น [ ไฟล์ jpg,gif,png,pdf ไม่เกิน2MB]<!-- span--></span></span></div></td>
</tr>
</tbody>
</table>
<div class="LHEADER"><h2 class="headerText">กรอกเลขที่การสั่งซื้อที่ต้องการชำระ</h2></div><div class="informorder-input"><div class="nameTD">เลขที่ใบสั่งซื้อ* : </div><input type="text" name="order_id" value="" placeholder="เลขที่ใบสั่งซื้อ"></div><br><br>
<div class="LHEADER"><h2 class="headerText">รายละเอียดอื่นๆ</h2></div><div align="center" class="detailLayout">
<div class="layoutLeft">รายละเอียดเพิ่มเติม</div>
<div class="layoutRight"><textarea name="detail" placeholder="รายละเอียดเพิ่มเติม"></textarea></div>
</div>

<div class="LHEADER"><h2 class="headerText">รายละเอียดผู้แจ้งชำระเงิน</h2></div><table width="500" cellspacing="0" cellpadding="0" align="center" class="paymentForm FORMTABLE">
<tbody>
<tr class="nameTR">
<td class="nameTD">ชื่อผู้แจ้ง*</td>
<td class="inputTD"><input type="text" name="name" class="width_full" placeholder="ชื่อผู้แจ้ง"></td>
</tr>
<tr class="emailTR">
<td class="nameTD">อีเมล</td>
<td class="inputTD"><input type="text" name="email" class="width_full" placeholder="อีเมล"></td>
</tr>
<tr class="mobileTR">
<td class="nameTD">เบอร์มือถือ</td>
<td class="inputTD"><input type="text" name="mobile" class="width_full" placeholder="เบอร์มือถือ"></td>
</tr>
</tbody>
</table>
<br>
<div class="note">*กรุณาตรวจทานรายละเอียดให้ถูกต้องอีกครั้ง ก่อนยืนยันการแจ้งชำระเงิน</div><br>
<div class="buttonContainer">
<div class="alignCenter">
<button type="submit" class="b-inform LBUTTON"><span class="buttonText">แจ้งชำระเงิน</span></button>
    </div>
</div>






</form>
<script type="text/javascript">
function upload_init(){
$('#inform_fileupload').fileupload({
dataType: 'json',
acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
maxFileSize: 4194304,
sequentialUploads: true,
done: function (e, data) {
var jdata = data.result;
if(jdata.status=='error'){
$('#inform_fileupload_container .file_progress').html('Upload Error.');
alert(jdata.error_message);
}else{
$('#inform_fileupload_container .file_progress').html('Upload Done.');
        var xxx = '';
        if(jdata.url.match(/\.pdf$/i)) {
        xxx = jdata.url;
        }else{
        xxx = '<img src="'+jdata.url+'" />';
        }
$('#inform_fileupload_container .uploaded_file').html('<a href="'+jdata.url+'" target="_blank">'+xxx+'</a>');
$('#inform_fileupload_container input[name="file"]').val(jdata.url);
}
//upload_finish();
},
add: function (e, data) {
var file = data.files[0];
$('#inform_fileupload_container .file_progress').html('Loading...');
data.submit();
//upload_processing();
},
url: file_upload_manage_url(),
progress: function (e, data) {
var progress = parseInt(data.loaded / data.total * 100, 10);
$('#inform_fileupload_container .file_progress').html('Loading...'+progress+'%');
},
formData: function (form) {
var xxxx = new Array();
xxxx.push({name:'ajaxtime',value:new Date().getTime()});
xxxx.push({name:'path',value:'payment'});
xxxx.push({name:'web_id',value:'62559'});
return xxxx;
},
fail: function(e, data){
$('#inform_fileupload_container .file_progress').html('Upload Fail.');
}
})

function inform_payment_submit(gresponse){
var form = $('#inform_payment_form');
var ajaxdata = {};
$('textarea,select,input[type="hidden"],input[type="date"],input[type="time"],input[type="email"],input[type="mobile"],input[type="text"],input[type="number"]',form).each(function(){
ajaxdata[$(this).attr('name')] = $(this).val();
})
$(':radio',form).each(function(){
if($(this).prop('checked')){
ajaxdata[$(this).attr('name')] = $(this).val();
}
})
}

$.lnwajax.run('inform_payment',true,{
type: 'POST',
url: 'https' + '://' + 'www.allnewstep.com/informpayment/submit_guest',
data: ajaxdata,
dataType: 'json',
start: function(){
button_wait($('.b-inform',form));
},
success: function(response){
lnwajax_response(response,function(rdata){
window.location.href = rdata;
},function(rkey,rdata){
button_normal($('.b-inform',form));
switch(rkey){
case 'INFORM-EMPTY_BANK':
alert('กรุณาเลือกบัญชีที่โอนไป');
break;
case 'INFORM-EMPTY_DATE':
alert('กรุณาเลือกวันที่ที่โอน');
break;
case 'INFORM-EMPTY_AMOUNT':
alert('กรุณากรอกจำนวนที่โอน');
break;
case 'INFORM-INVALID_AMOUNT':
alert('กรุณากรอกจำนวนที่โอนให้ถูกต้อง');
break;
case 'INFORM-EMPTY_TIME':
case 'INFORM-INVALID_TIME':
alert('กรุณาเลือกเวลาที่โอน');
break;
case 'INFORM-EMPTY_ORDER_ID':
alert('กรุณากรอกเลขที่การสั่งซื้อที่ต้องการชำระ');
break;
case 'INFORM-INVALID_ORDER_ID':
alert('กรุณากรอกเลขที่การสั่งซื้อที่ถูกต้อง');
break;
case 'INFORM-ORDER_NOT_YOURS':
alert('ใบสั่งซื้อนี้สั่งซื้อ โดยสมาชิก กรุณาลงชื่อเข้าสู่ระบบก่อนแจ้งชำระเงิน');
break;
case 'INFORM-ORDER_EXPIRED':
alert('รายการสั่งซื้อนี้หมดอายุแล้ว');
break;
case 'INFORM-ORDER_REMOVED':
alert('รายการสั่งซื้อนี้ถูกลบแล้ว');
break;
case 'INFORM-ORDER_INACTIVE':
alert('รายการสั่งซื้อนี้ไม่สามารถแจ้งชำระเงินได้ กรุณาตรวจสอบรายการสั่งซื้อก่อนแจ้งชำระเงิน');
break;
case 'INFORM-LESS_AMOUNT':
alert('จำนวนเงินที่แจ้งชำระน้อยกว่าราคาของรายการสั่งซื้อที่เลือก');
break;
case 'INFORM-INVALID_DATE':
alert('รูปแบบของวันที่ผิดพลาด กรุณาใส่วันที่ในรูปแบบ YYYY-MM-DD');
break;
case 'INFORM-EMPTY_FILE':
alert('กรุณาแนบหลักฐานการโอน');
break;
case 'CONTACTUS-EMPTY_NAME':
alert('กรุณากรอกชื่อ');
break;
case 'CONTACTUS-INVALID_EMAIL':
alert('อีเมลที่กรอกผิดรูปแบบ');
break;
case 'CONTACTUS-INVALID_MOBILE':
alert('รูปแบบเบอร์มือถือผิดพลาด');
break;
default:
alert('ขออภัย พบข้อผิดพลาดบางอย่าง ไม่สามารถดำเนินการต่อได้\n'+rkey);
break;
});
