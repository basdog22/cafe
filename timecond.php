<script>
var ifweek = function (){
	var weekNumInput = document.getElementById('weeknum');
	var timestamp = document.getElementById('timestamp');
	if(timestamp.value =='input_week'){
		weekNumInput.style.display='inline';
		timestamp.onchange = function(){
			weekNumInput.style.display='none';
			timestamp.onchange = ifweek;
		};
	}
};
</script>
<form action="<?php $page?>" method='GET'>
<select name="timestamp" class="select-small" id='timestamp' onchange='ifweek()'>
	<option value='today' selected>Today</option>
	<option value='all'>All Time</option>
	<option value='this_7_day'>In 7 Day</option>
	<option value='this_month'>This Month</option>
	<option value='this_week'>This Week</option>
	<option value='input_week'>Input Week...</option>
</select>
<!--
<style>
input[type=range]:before { content: attr(min); padding-right: 5px; }
input[type=range]:after { content: attr(max); padding-left: 5px;}
</style>-->
<?php
$thisWeekNum = $mysql->fetch($mysql->query('select week(now(),1)'))[0];
?>
<input type='number' name='weeknum' id='weeknum' placeholder='WeekNumber' min='0' max='53' value='<?php echo $thisWeekNum;?>' style='display:none;' />
<!--<input type="range" name="weeknum" id='weeknum' step='1' min="0" max="53" value='' style='width:50%;display:none;' onchange='rangeres.value = weeknum.value;'/>
<output name="rangeres" style='font-size:3em;display:inline;'></output>-->
<button type='submit' value='OK'>OK</button>
</form>
<?php
$all = '';
$today ="where date =(current_date())";
$this_7_day = "where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date";
$this_month = "where month(date) = month(now())";
$this_week = "where week(date,1) = week(now(),1)";
//$this_hour = "where hour(time) = hour(now()) and date =(current_date())";
if(isset($_GET['timestamp'])){
	if(isset($_GET['weeknum']) && $_GET['timestamp']=='input_week'){
		$timestamp = 'this_week';
		$condition = $this_week;
		echo "<script>document.getElementById('timestamp').value = '$timestamp'</script>";
		if($_GET['weeknum']!=''){
			if($_GET['weeknum'] > $thisWeekNum){
				echo "<script>alert('It\'s week $thisWeekNum now! Please input a smaller number');</script>";
				$_GET['weeknum'] = $thisWeekNum;
			}
			$timestamp = 'week '.$_GET['weeknum'];
			$condition = "where week(date,1) = ".$_GET['weeknum'];
			echo "<script>document.getElementById('timestamp').value = 'input_week';ifweek();$('#weeknum').val('{$_GET['weeknum']}');</script>";
		}
	}else{
		$timestamp=$_GET['timestamp'];
		$condition = $$timestamp;
		echo "<script>document.getElementById('timestamp').value = '$timestamp'</script>";
	}
}else {
	$condition=$today;
	$timestamp='today';
}
?>
