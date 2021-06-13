  <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include 'barcode128.php';

if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{


?>          
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">           
<?php
	$cid=$_GET['vid'];
	$ret=mysqli_query($con,"select * from tblvehicle where ID='$cid'");
	$cnt=1;
	date_default_timezone_set('Asia/Kolkata');
	$date = date('d-m-yy h:i:s');
	while ($row=mysqli_fetch_array($ret)) {
?>

<div  id="exampl">
	<table border="1" class="table table-bordered mg-b-0" style="width: 40%; height: 10%;">
		<tr>
			<td style="text-align:center; cursor:pointer"><i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint(this.value)"  ></i></td>
		</tr>
		<tr>
			<th style="text-align: center; font-size:15px;">Vehicle Parking receipt</th>
        </tr>
		<tr>
			<th>
				<center>
					<img src="images/barcode.jpg" alt="barcode" style="display: block; height: 50%;">
				</center>
			</th>
		</tr>
		<tr>
			<td>
				<center>
					<b><p style="color: black;">Parking Number&nbsp;:&nbsp;<?php  echo $row['ParkingNumber'];?></p></b>
					<b><p style="color: black;">Vehicle Category&nbsp;:&nbsp;<?php  echo $row['VehicleCategory'];?></p></b>
					<b><p style="color: black;">Vehicle Plate No.&nbsp;:&nbsp;<?php  echo $row['RegistrationNumber'];?></p></b>
					<b><p style="color: black;">In Time&nbsp;:&nbsp;<?php  echo $row['InTime'];?></p></b>
					<b><p style="color: black;">Out Time&nbsp;:&nbsp;<?php  echo $row['OutTime'];?></p></b>
					<b><p style="color: black;">Printed on&nbsp;:&nbsp;<?php  echo $date;?></p></b>
					<b><p style="color: black;">Status&nbsp;:&nbsp;<?php  echo $row['Status'];?></p></b>
					<b><p style="color: black;">Fare&nbsp;:&nbsp;<?php  echo $row['ParkingCharge'];?></p></b>
					<hr>
					<b><p style="color: black;">### IT IS AN E-INVOICE. THANK YOU VISIT AGAIN. ###</p></b>
				</center>
			</td>
		</tr>
	</table>
    <?php }}  ?>
</div>
<script>
	function CallPrint(strid) {
	var prtContent = document.getElementById("exampl");
	var WinPrint = window.open('/', 'Token', 'left=0,top=0,width=500,height=500,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	}
</script> 