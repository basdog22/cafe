<?php
require("db.php");
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'default';
}
include("header.php");
if ($page == 'default') {
	include ("current_orders.php");
} else if ($page == 'food_cata') {
	include ("food_cata.php");
} else if ($page == 'food_detail') {
	include ("food_detail.php");
} else if ($page == 'order_info') {
	include ("order_info.php");
}else if ($page == 'order_detail') {
	include ("order_detail.php");
}else if ($page == 'food_sold') {
	include ("food_sold.php");
}else if ($page == 'customer_info') {
	include ("cus_info.php");
}else if ($page == 'new_customer') {
	include ("new_customer.php");
}else if ($page == 'current_orders') {
	include ("current_orders.php");
}else if ($page == 'create_order') {
	include ("create_order.php");
}
include("footer.php");

?>