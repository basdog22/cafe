<form action="<?php $page?>" method='post'>
<select name="timestamp" class="select-small" id='timestamp'>
	<option value='today'>Today</option>
	<option value='all'>All</option>
	<option value='this_7_day'>In 7 Day</option>
	<option value='this_month'>This Month</option>
	<option value='this_week'>This Week</option>
	<option value='this_hour'>This Hour</option>
</select>
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
}?>