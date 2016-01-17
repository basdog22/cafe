		<?php
			date_default_timezone_set('PRC'); 
            $sql_foodinfo = "select s.food_id,s.cata_name as food_name,s.price,p.cata_name from food_catalogue as s join food_catalogue as p where p.food_id = s.catalog_id and  s.food_id != s.catalog_id;";
            $result = $mysql->query($sql_foodinfo);
            $food_cata_info = array();
            echo "<form id='order_submit' action ='submit.php' method = 'post'>";
            echo "<table class ='table-bordered'>"; 
            while($row = $mysql->fetch($result)) {
	            $food_cata_info['name'][$row['food_id']] = $row['food_name'];
	            $food_cata_info['price'][$row['food_id']] = $row['price'];
	            $food_cata_info['cata'][$row['food_id']] = $row['cata_name'];
            }
			$datetime = date('m-d-y h:i:s',time());
			if(isset($_POST['cus_id'])){
				if(!empty($_POST['cus_id'])){
					$cus_id = (int)$_POST['cus_id'];
					$sql_cusinfo = "SELECT firstname,lastname,tel,address from customer_info where customer_id = $cus_id;";
					$result_cus = $mysql->query($sql_cusinfo);  
					$row_cus = $mysql->fetch($result_cus);
					$cusname=$row_cus[0]."&nbsp".$row_cus[1];
				}else{
					$cus_id = '0';
					$cusname='Unknown';
				}
			}else{
				$cus_id='0';
				$cusname='New Order';
			}
			echo "<tr class='bold'>
			<td style='font-size: 26px;border-right:0;' onmousemove='document.getElementById('cusid').style.display= \'inline\'' onmouseout='document.getElementById('cusid').style.display= \'none\''>".$cusname."&nbsp<span id='cusid' style='display:none;position: absolute;font-size:16px;font-weight:normal;'>@$cus_id</span></td>
			<td colspan='2' style='border-left:0;text-align:right;'>$datetime</td></tr>";
            echo "<tr class='fat'><td>Food Name</td><td>Price</td><td>Quantity</td></tr>"; 
		    $create_res = array();
			$totalp = 0;
			if(isset($_POST['odfood'])){
				$food__quantity=array_filter($_POST['odfood']);
				if(!empty($food__quantity)){
					for ($i=0;$i < count($food__quantity);$i++) {
						$f_id = array_keys($food__quantity)[$i];
						$f_quantity = $food__quantity[$f_id];
						if(!empty($f_quantity)) {
							echo "<tr><td><b>".$food_cata_info['name'][$f_id]."</b></td>";
							echo "<td>&#165;".$food_cata_info['price'][$f_id]."</td>";
							echo "<td>".$f_quantity."</td></tr>";
							$totalp += $food_cata_info['price'][$f_id] * $f_quantity;
						}
					}	
					$_SESSION['food__quantity'] = $food__quantity;
					$_SESSION['cus_id']= $cus_id;
				}
			}
		    echo "<tr><td colspan='2' class='fat'>Total Price</td><td colspan='2' class='text-centered'>&#165;  ".$totalp."</td></tr></table></form>";
	        if ($totalp > 0) {
				echo "<script>document.getElementById('createbtn').style.display= 'none'</script>";
		?>
			<script> 
				function printdiv(printpage) { 
					var headstr = "<html><head><title></title></head><body>"; 
					var footstr = "</body>"; 
					var newstr = document.all.item(printpage).innerHTML; 
					var oldstr = document.body.innerHTML; 
					document.body.innerHTML = headstr+newstr+footstr; 
					window.print(); 
					document.body.innerHTML = oldstr; 
					return false; 
				} 
				function reset() {  
					if (confirm("Do you want to reset?")) {  
						window.location.href='index.php?page=create_order';
					}  
				}
			</script>
			<nav id='submitbtn'>
				<ul>
					<li><button type="primary" onclick="document.getElementById('order_submit').submit()">Submit</button></li>
					<li><button onclick="printdiv('create_page')">Print</button></li>
					<li><button onclick ="history.go(-1)" outline>Modify</button></li>
					<li><button onclick ="reset()" outline>Reset</button></li>
				</ul>
			</nav>
		    <?php
            }
        ?>
		
