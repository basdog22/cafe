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
			echo "<div class='forms'>
					<fieldset class='alert alert-success'>
					<legend class='fat'>";
            if(isset($_SESSION['food__quantity']) && !isset($_POST['fname']) && !isset($_POST['isCata'])){
				if(isset($_SESSION['order_id'])){
/**To edit an order, first need to DELETE previous order*/
					$sql_del="DELETE FROM orders WHERE order_id={$_SESSION['order_id']}";
					$mysql->query($sql_del);
					unset($_SESSION['order_id']);
				}
/**save new order info into array, create new order and INSERT each food item*/
				$food__quantity=$_SESSION['food__quantity'];
	            $cus_id = $_SESSION['cus_id'];	
				unset($_SESSION['cus_id']);
				unset($_SESSION['food__quantity']);
				session_destroy();
				if(isset($_POST['time']) && !empty($_POST['time'])){
					$time = "'{$_POST['time']}'";	
				}else{
					$time = 'curtime()';
				}
                $itemnum = count($food__quantity);
                $sql_inserto = "INSERT orders(cus_id,date,time) VALUE($cus_id,curdate(),$time)";
                $mysql->query($sql_inserto);
				$order_id = mysql_insert_id();
                for ($itemcount=0;$itemcount<$itemnum;$itemcount++) {
					$food_id = array_keys($food__quantity)[$itemcount];
					$quantity = $food__quantity[$food_id];
                    $sql_insertf = "INSERT order_food(order_id,food_id,quantity) VALUE(".$order_id.",".$food_id.",".$quantity.")";
                    $mysql->query($sql_insertf);
                }
                echo "Create Order Successfully";  
                header("refresh:1;url='index.php?page=current_orders'");		
            }else if(isset($_POST['fname'])){
/**chaeck info and create a new customer*/				
				if(!empty(preg_replace("/\s/","",(string)$_POST['fname']))){
					$sql_newcus= "INSERT customer_info (firstname,lastname,tel) VALUE ('".preg_replace("/\s/","",(string)$_POST['fname'])."','".preg_replace("/\s/","",(string)$_POST['lname'])."','{$_POST['tel']}')";
					$mysql->query($sql_newcus);
					echo "Add Customer Successfully";
					header("refresh:1;url='index.php?page=customer&action=info'");
				}else{
					echo "<script> history.back(-1)</script>";
				}
            }else if(isset($_POST['isCata'])){
				$foodname = preg_replace("/\s/","",(string)$_POST['foodName']);
				$foodPrice = preg_replace("/\s/","",(string)$_POST['price']);
				if(!empty($foodname)){
					if($_POST['isCata']=='food'){
						$foodCata = $_POST['foodCata'];
						if(isset($_POST['origId'])){
							$foodId = $_POST['origId'];
							$sql_newfood = "UPDATE food_catalogue SET cata_name = '$foodname',Price = $foodPrice,catalog_id = $foodCata WHERE food_id = $foodId";
						}else{
							$sql_newfood = "INSERT food_catalogue (cata_name,Price,catalog_id) VALUES ('$foodname',$foodPrice,$foodCata)";
						}
					}else if($_POST['isCata']=='cata'){
						$cataId = $_POST['cataId'];
						$sql_newfood = "INSERT food_catalogue (cata_name,catalog_id) VALUES ('$foodname',$cataId)";
					}
					$mysql->query($sql_newfood);
					echo "Add New Food Successfully";
					header("refresh:1;url='index.php?page=food&action=detail'");
				}else{
					echo "Wrong!<script>history.go(-1);</script>";
				}
			}
			echo "		</legend>
						<p>Back to Home Page in 1 seconds...</p>
						<a href='index.php'>Back to Homepage immdiately</a>
					</fieldset>
				</div>";
        ?>
        </column>
        </row>
    </body>
</html>