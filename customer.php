<?php
if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action='info';
}
if($action == 'new'){
	/**query customers ID and show new customer form*/
	$sql_cusinfo = "SELECT cus_id from customer_info order by cus_id DESC;";
			$result = $mysql->query($sql_cusinfo); 
			$row = $mysql->fetch($result);
			$newnum = $row[0]+1;		
	echo "
	<form action='submit.php' method='post'>
	<table>
		<th colspan='4'>New Customer</th>
		<tr>
			<td class='bold' class='width-2'>Customer Number</td>
			<td class='width-2'>
				<input type='text' maxlength='6' value='$newnum' disabled='disabled'/>
			</td>
		</tr>
		<tr>
			<td class='bold'>First Name</td>
			<td>
				<input type='text' maxlength='10' name='fname'/>
			</td>
			<td class='bold'>Last Name<span class='req'> *</span></td>
			<td>
				<input type='text' maxlength='10' name='lname' required/>
			</td>
		</tr>
		<tr>
			<td class='bold'>Phone Number</td>
			<td>
				<input type='tel' maxlength='20' name='tel'/>
			</td>
		</tr>
	</table>
	<div class='text-right'>
		<button class='submit' type='primary' name='submit'>Submit</button>
	</div>
	</form>";	
}else if($action == 'info'){
	/**show all customer's information*/
		$sql_cusinfo = "SELECT * FROM customer_info;";
		$result = $mysql->query($sql_cusinfo);
		echo "<form action='require/index.php?page=customer_info' method='post'><table class ='table-stripped'>";
        echo "<th colspan='8'>Customer Information:</th>";
        echo "<tr><td class='bold'>Customer ID</td><td class='bold'>First Name</td><td class='bold'>Last Nmae</td><td class='bold'>Phone Number</td><td class='bold'>Credit</td></tr>";
		while($row = $mysql->fetch($result)) {
		    echo "<tr>";
			$sql_order="select order_id from orders where cus_id = {$row['cus_id']}";
			$res = $mysql->query($sql_order);
			$cond='';
				while($row_order=$mysql->fetch($res)) {
				$cond= $cond." or order_id= {$row_order['order_id']}";
				}
				$sql_sum="select sum(f.price * quantity) as credit from order_food inner join food_catalogue as f ON order_food.food_id = f.food_id where order_id =0 $cond";
				$res_cre=$mysql->query($sql_sum);
				$row_cre=$mysql->fetch($res_cre);
			echo "<td>".$row['cus_id']."</td>";
			echo "<td>".$row['FirstName']."</td>";
			echo "<td>".$row['LastName']."</td>";
			echo "<td>".$row['Tel']."</td>";
			echo "<td>&#165;".$row_cre['credit']."</td>";
			echo "</tr>";
	    }
		echo "</table>";
}	
?>
