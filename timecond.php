<form action="<?php $page?>" method='post'>
<select name="timestamp" class="select-small" id='timestamp'>
	<option value='today' selected>Today</option>
	<option value='all'>All Time</option>
	<option value='this_7_day'>In 7 Day</option>
	<option value='this_month'>This Month</option>
	<option value='this_week'>This Week</option>
	<option value='this_hour'>This Hour</option>
</select>
<!--<input type="range" name="rowNum" id='rowNum' min="1" max="50" style='width:50%;' />-->
<button type='submit' value='OK'>OK</button>
</form>
<?php
$all = '';
$today ="where date =(current_date())";
$this_7_day = "where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date";
$this_month = "where month(date) = month(now())";
$this_week = "where week(date,0) = week(now())";
$this_hour = "where hour(time) = hour(now()) and date =(current_date())";
if(isset($_POST['timestamp'])){
	$timestamp=$_POST['timestamp'];
	$condition = $$timestamp;
echo "<script>document.getElementById('timestamp').value = '$timestamp'</script>";
}else {
	$condition=$today;
	$timestamp='today';
}
/*if(isset($_POST['rowNum'])){
	$rowNum = ' LIMIT '.$_POST['rowNum'];
	echo "<script>document.getElementById('rowNum').value = '$rowNum'</script>";
}else{
	$rowNum = ' LIMIT 20';
}*/
?>