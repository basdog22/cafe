<?php
$page='index.php?page=order_info';
include "timecond.php";
$sql = "select Order_id,o.customer_id,firstname as fname,lastname as lname,Date,Time from orders as o LEFT JOIN customer_info as c ON o.customer_ID = c.customer_id ".$condition." ORDER BY order_id DESC";
	    $result = $mysql->query($sql);
        echo "<table class ='table-stripped'>"; 
        echo "<th colspan='7'>All Orders:</th>";
        echo "<tr><td class='bold'>Order ID</td><td class='bold'>Customer ID</td><td class='bold'>Customer</td><td class='bold'>Order Price</td><td class='bold'>Date</td><td class='bold'>Time</td><td></td></tr>";
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
<script>
function firm(text,url) {  
       if (confirm(text)) {
			alert('Delete OK');		   
			window.open(url);
         }  
    }  
</script>
		<td>
			<a href="" onclick="confirm('Do you want to Edit this?')"><samp>o</samp></a>
			<a onclick="firm('Do you want to delete this order and its detail information?','sql.php?sql=delete from orders where order_id = <?php echo $row['Order_id'];?>')"><kbd>x</kbd></a>
		</td>
	</tr>
<?php } ?> 
</table>
