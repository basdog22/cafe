<?php

require __DIR__ . '/require/db.php';
require __DIR__ . '/printer/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

/* Fill in your own connector here */
$connector = new FilePrintConnector("php://stdout");

/* Start the printer */
$printer = new Printer($connector);

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

// Select customer info
$sql_orders = "select Order_id,o.cus_id,firstname as fname,lastname as lname,Date,Time,payed from orders as o LEFT JOIN customer_info as c ON o.cus_id = c.cus_id WHERE order_id = $id";
$result = $mysql->query($sql_orders);
$row_order = $mysql->fetch($result);

if(empty($row_order['lname']) && empty($row_order['fname'])) {
	$cusname='Unknown';
} else {
	$cusname=$row_order['fname']."&nbsp".$row_order['lname'];
}

/* Name of customer & order# */
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("$cusname\n");
$printer -> selectPrintMode();
$printer -> text("Order# ". $row_order['Order_id'] . "\n");
$printer -> feed();

//echo $cusname . "<br/>";
//echo "Order#" . $row_order['Order_id'] . "<br/><br/>";

$total_cost = 0;

/* Information for the receipt */
$items = array();

$sql_item_detail = "SELECT Item_id,F.order_id,cus.lastname as lname,Cs.cata_name as Food_name,Cp.Cata_name,Quantity,Cs.price as Single_Price,(Cs.price*quantity)as Total_Price,F.food_id from order_food as F JOIN orders as O on F.order_id = O.order_id JOIN food_catalogue as Cs ON F.food_id = Cs.food_id JOIN food_catalogue as Cp ON Cp.food_id = Cs.catalog_id LEFT JOIN customer_info as cus ON cus.cus_id = O.cus_id WHERE F.order_id= $id";
$result_item_detail = $mysql->query($sql_item_detail);
while($row_item_detail = $mysql->fetch($result_item_detail)) {
	// print row and quantity
	//echo $row_item_detail['Food_name'] . " (" . $row_item_detail['Quantity'] . ")";
	//echo "&#165;" . $row_item_detail['Total_Price'] . "<br/>";
	
	/* Information for the receipt */	
	array_push($items, new item($row_item_detail['Food_name'], $row_item_detail['Total_Price']));
	
	$total_cost = $total_cost + $row_item_detail['Total_Price'];
}

//echo "&#165; " . $total;

// Print all lines
$printer -> setEmphasis(false);
foreach($items as $item) {
        $printer -> text($item);
}

// Total cost
$total = new item('Total', $total_cost, true);

/* Total */
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text($total);
$printer -> selectPrintMode();





/* Date is kept the same for testing */
// $date = date('l jS \of F Y h:i:s A');
//$date = "Monday 6th of April 2015 02:56:25 PM";

/* Title of receipt */
//$printer -> setEmphasis(true);
//$printer -> text("SALES INVOICE\n");
//$printer -> setEmphasis(false);

/* Items */
//$printer -> setJustification(Printer::JUSTIFY_LEFT);
//$printer -> setEmphasis(true);
//$printer -> text(new item('', '$'));


//$printer -> setEmphasis(true);
//$printer -> text($subtotal);
//$printer -> setEmphasis(false);
//$printer -> feed();



/* Footer */
$printer -> feed(2);
//$printer -> setJustification(Printer::JUSTIFY_CENTER);
//$printer -> text("Thank you for shopping at ExampleMart\n");
//$printer -> text("For trading hours, please visit example.com\n");
//$printer -> feed(2);
//$printer -> text($date . "\n");
$printer -> feed(2);

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

$printer -> close();

/* A wrapper to do organise item names & prices into columns */
class item {
        private $name;
        private $price;
        private $dollarSign;

        public function __construct($name = '', $price = '', $dollarSign = false) {
                $this -> name = $name;
                $this -> price = $price;
                $this -> dollarSign = $dollarSign;
        }

        public function __toString() {
                $rightCols = 20;
                $leftCols = 38;
                if($this -> dollarSign) {
                        $leftCols = $leftCols / 2 - $rightCols / 2;
                }
                $left = str_pad($this -> name, $leftCols) ;

                $sign = ($this -> dollarSign ? '$ ' : '');
                $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
                return "$left$right\n";
        }
}
?>