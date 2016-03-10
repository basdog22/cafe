<!DOCTYPE html>
<html>
    <head>
        <title>Laowai Cafe</title>
        <link type="text/css" rel="stylesheet" href="static/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="static/css/kube.css"/>
    </head>
    <body><br/><br/><br/><br/>
        <row centered>
        <column cols="6">
        <?php
			session_start();
			include "require/db.php";
            if(isset($_SESSION['food__quantity'])){
				if(isset($_SESSION['order_id'])){
				/**DELETE order*/
					$sql_del="DELETE FROM orders WHERE order_id={$_SESSION['order_id']}";
					$mysql->query($sql_del);
					unset($_SESSION['order_id']);
				}
/**save new order info into array and INSERT each food item*/
				$food__quantity=$_SESSION['food__quantity'];
	            $cus_id = $_SESSION['cus_id'];	
				unset($_SESSION['cus_id']);
				unset($_SESSION['food__quantity']);
				session_destroy();
                $itemnum = count($food__quantity);
                $sql_inserto = "INSERT orders(cus_id,date,time) VALUE($cus_id,curdate(),curtime())";
                $mysql->query($sql_inserto);
				$order_id = mysql_insert_id();
                for ($itemcount=0;$itemcount<$itemnum;$itemcount++) {
					$food_id = array_keys($food__quantity)[$itemcount];
					$quantity = $food__quantity[$food_id];
                    $sql_insertf = "INSERT order_food(order_id,food_id,quantity) VALUE(".$order_id.",".$food_id.",".$quantity.")";
                    $mysql->query($sql_insertf);
                }
                echo "<div class='forms'><fieldset class='alert alert-success'><legend class='fat'>Create Order Successfully</legend>";  
                header("refresh:1;url='index.php?page=current_orders'");				
            }else if(isset($_POST['fname'])){
/**chaeck info and create a new customer*/				
				if(!empty(preg_replace("/\s/","",(string)$_POST['fname']))){
				$sql_newcus= "INSERT customer_info (firstname,lastname,tel) VALUE ('".preg_replace("/\s/","",(string)$_POST['fname'])."','".preg_replace("/\s/","",(string)$_POST['lname'])."','{$_POST['tel']}')";
					$mysql->query($sql_newcus);
					echo "<div class='forms'><fieldset class='alert alert-success'><legend class='fat'>Add Customer Successfully</legend>";
					header("refresh:1;url='index.php?page=customer&action=info'");
				}else{
					echo "<script> history.back(-1)</script>";
				}
            }
            echo "<p>Back to Home Page in 1 seconds...</p>";
            echo "<a href='index.php'>Back to Homepage immdiately</a></fieldset></div>";
        ?>
        </column>
        </row>
    </body>
</html>