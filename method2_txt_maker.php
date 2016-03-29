<?php
require '/require/db.php';
//CAN NOT PRINT NULL
$wtf = "@a! User
! Order# oid

EE Items
EE 
! Total                 $ total
! ddVAp0<x";
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$sql_orders = "select Order_id,o.cus_id,firstname as fname,lastname as lname,Date,Time,payed from orders as o LEFT JOIN customer_info as c ON o.cus_id = c.cus_id WHERE order_id = $id";
$result = $mysql->query($sql_orders);
$row_order = $mysql->fetch($result);

if(empty($row_order['lname']) && empty($row_order['fname'])) {
	$cusname='Unknown';
} else {
	$cusname=$row_order['fname']."&nbsp".$row_order['lname'];
}

$sql_item_detail = "SELECT Item_id,F.order_id,cus.lastname as lname,Cs.cata_name as Food_name,Cp.Cata_name,Quantity,Cs.price as Single_Price,(Cs.price*quantity)as Total_Price,F.food_id from order_food as F JOIN orders as O on F.order_id = O.order_id JOIN food_catalogue as Cs ON F.food_id = Cs.food_id JOIN food_catalogue as Cp ON Cp.food_id = Cs.catalog_id LEFT JOIN customer_info as cus ON cus.cus_id = O.cus_id WHERE F.order_id= $id";
$result_item_detail = $mysql->query($sql_item_detail);
$total_cost = 0;
while($row_item_detail = $mysql->fetch($result_item_detail)) {
	$total_cost = $total_cost + $row_item_detail['Total_Price'];
	//do something to prepare the list of Items
}
/** Items is not replaced yet **/
$ary = array('User'=>$cusname,'oid'=>$id,'Items'=>
'Ultimate                                              4.00
Tuna Salad                                            3.50
Americano                                             1.00
Extra bacon                                           4.45',
'total'=>$total_cost);
$res = strtr($wtf,$ary);
file_put_contents('receipt.txt',$res);
if(file_exists('receipt.txt')){
	shell_exec('lpr -o raw -H localhost -P POS58 receipts/receipt.txt');
}
?>	