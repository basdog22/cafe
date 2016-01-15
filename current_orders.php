<?php
include 'timecond.php';
	$sql = "select Order_id,o.customer_id,firstname as fname,lastname as lname,Date,Time from orders as o LEFT JOIN customer_info as c ON o.customer_ID = c.customer_id $condition ORDER BY order_id DESC";
	$result = $mysql->query($sql);
	while($row = $mysql->fetch($result)) {
?>
<div class='order_block'>
  <div class='ob_nav' id='obnav<?php echo $row[0];?>'>
	<table class ='table-stripped' id='ob_tbl'>
		<tr>
			<?php
			$sql1 = "select sum(f.price * quantity) as order_price, count(*) as num from order_food inner join food_catalogue as f ON order_food.food_id = f.food_id where order_id = {$row['Order_id']}";
			$res=$mysql->query($sql1);
			$row1=$mysql->fetch($res);
			$num=$row1['num'];
			echo "<th colspan='2'>".$row['fname']." ".$row['lname']."</th>";
			echo "<th class='text-right' colspan='2'>".$row['Date']."&nbsp".$row['Time']."</th>";
			?>
		</tr>
		<tr id='ob_tbl_th'>
			<td contenteditable="true">Food Name</td>
			<td>Quantity</td>
			<td>Single Price</td>
			<td>Total Price</td>
		</tr>
		<?php
		$sql_de = "SELECT Item_id,F.order_id,cus.lastname as lname,Cs.cata_name as Food_name,Cp.Cata_name,Quantity,Cs.price as Single_Price,(Cs.price*quantity)as Total_Price from order_food as F JOIN orders as O on F.order_id = O.order_id JOIN food_catalogue as Cs ON F.food_id = Cs.food_id JOIN food_catalogue as Cp ON Cp.food_id = Cs.catalog_id LEFT JOIN customer_info as cus ON cus.customer_id = O.customer_id WHERE F.order_id= ".$row['Order_id']." limit 3";
			$result_de = $mysql->query($sql_de);
			while($row_de = $mysql->fetch($result_de)) {
				echo "<tr id='ob_tbl_tb'>";
				echo "<td>".$row_de['Food_name']." </td>";
				echo "<td>".$row_de['Quantity']." </td>";
				echo "<td>&#165;".$row_de['Single_Price']." </td>";
				echo "<td>&#165;".$row_de['Total_Price']." </td></tr>";
			}				
			for($n=$num;$n<3;$n++){
				echo "<tr id='ob_tbl_tb'><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td></tr>";
			}		
	echo "<tr id='ob_tbl_tb'><th colspan='2' id='paid'><span id='paid$row[0]'>Paid</span></th><th class='text-right' colspan='2'>{$row1['order_price']}&nbspRMB</th></tr>";
		?>
	</table>
		<nav id='paybtn'>
			<span id="btn2<?php echo $row[0];?>">
			<button type="primary" onclick="paid('<?php echo $row[0];?>')">Pay</button>
			<button onclick="">Edit</button>
			</span>
			<?php
			if($num > 3){	
				echo "<div id='more$row[0]' class='morerow' onclick=\"confirm('lal')\">&nbsp&nbsp&nbsp;<a>More</a>&nbsp &nbsp &nbsp;</div>";
			}
			?>
		</nav>
  </div>
</div>
<?php
	} 
	if(empty($row1)){
		echo "No orders for $timestamp yet";
	}
?>
<script>
	function paid(orid){
			var a=a;
			if(confirm('Paid?')){
				document.getElementById('obnav'+orid).style.border='2px solid #0ab159';
				document.getElementById('obnav'+orid).style.boxShadow='0px 0px 5px #0ab159';
				document.getElementById('paid'+orid).style.visibility='visible';
				document.getElementById('btn2'+orid).style.display='none';
				document.getElementById('more'+orid).style.wordSpacing='37px';
				}
			}
</script>