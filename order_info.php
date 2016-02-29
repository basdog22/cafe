<script>
function deleteOrder(orid){
	if(confirm('Do you want to delete '+orid+' order ?')){
		document.getElementById(orid).click();
	}
}
</script>
<?php
$page='index.php?page=order_info';
include "timecond.php";
$sql = "select Order_id,o.customer_id,firstname as fname,lastname as lname,Date,Time from orders as o LEFT JOIN customer_info as c ON o.customer_ID = c.customer_id ".$condition." ORDER BY order_id DESC";
	    $result = $mysql->query($sql);
        echo "<table class ='table-stripped'>"; 
        echo "<th colspan='7'>All Orders:</th>";
        echo "<tr><td class='bold'>Order ID</td><td class='bold'>Customer ID</td><td class='bold'>Customer</td><td class='bold'>Order Price</td><td class='bold'>Date</td><td class='bold'>Time</td><td></td></tr><form method='post' action=''>";
		while($row = $mysql->fetch($result)) {
			echo "<tr>";
			$sql1 = "select sum(f.price * quantity) as order_price from order_food inner join food_catalogue as f ON order_food.food_id = f.food_id where order_id = {$row['Order_id']}";
			$res=$mysql->query($sql1);
			$row1=$mysql->fetch($res);
            echo "<td>".$row['Order_id']." </td>";
			echo "<td>".$row['customer_id']." </td>";
			echo "<td>".$row['fname']." ".$row['lname']."</td>";
			echo "<td>&#165;".$row1['order_price']." </td>";
			echo "<td>".$row['Date']." </td>";
			echo "<td>".$row['Time']." </td>";
?>
		<td>
			<a onclick="deleteOrder('<?php echo $row['Order_id'];?>')"><kbd>x</kbd></a>
			<input id='<?php echo $row['Order_id'];?>' type='submit' name='nam' value='<?php echo $row['Order_id'];?>' style='display:none;'/>
		</td>
	</tr>
<?php 
		}
		echo '</form>';
		if(isset($_POST['nam'])){
			$delId = $_POST['nam'];
			$mysql->query("DELETE FROM orders WHERE order_id = $delId");
		}
?> 
</table>
