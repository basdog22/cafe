<script>
/**function of add,minus,show,hide and check input number*/
	function a(fid){ 
		var x=document.getElementById(fid).value; 
		if(x.length==0){ x=0; }
		if(x < 999){
			document.getElementById(fid).value = parseInt(x)+1;
		}
	}
	function m(fid){ 
		var x=document.getElementById(fid).value;
		if(x > 0){
			document.getElementById(fid).value = parseInt(x)-1;
		}
	}
	function vis(fid){
		document.getElementById('l'+fid).style.visibility = "visible";
		document.getElementById('r'+fid).style.visibility = "visible";
	}
	function check(fid){
		var q = document.getElementById(fid).value;
		if (q <= 0 || q > 999 || q != parseInt(q)){
			document.getElementById(fid).value = '';
			document.getElementById(fid).style.backgroundColor = "white";
		}else{
			document.getElementById(fid).style.backgroundColor = "rgba(10, 135, 84, 0.13)";
		}
	}
	function hide(fid){
		document.getElementById('l'+fid).style.visibility = "hidden";
		document.getElementById('r'+fid).style.visibility = "hidden";
	}
</script>
<?php
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
/**save food catalogue and customers full name into arrays*/
	$sql_fcata = "select catalog_id,cata_name from food_catalogue where food_id = catalog_id";
	$result_fcata = $mysql->query($sql_fcata);
	$sql_cusinfo = "SELECT cus_id,CONCAT(firstname,' ',lastname) FROM customer_info ORDER BY firstname, lastname";
	$result_cusinfo = $mysql->query($sql_cusinfo);
?>
		<form id='order_table' action='index.php?page=create_order' method ='post'>
			<div class='big'><b>Customer:</b>
				<select name='cus_id' id='cus'>
					<option value='0'>--</option>
				<?php 
					while($row = $mysql->fetch($result_cusinfo)) {
						echo "<option value=$row[0]>$row[1]</option>";
					}	
				?>
				</select>
				<button id='createbtn' type='primary'>Create New</button>
			</div>
			<div class='create_order'>
				<table class ='table-stripped'>
	<?php
/**output all the food items of each type of food*/
		while($row_fcata = $mysql->fetch($result_fcata)) {
			$cata_id = $row_fcata['catalog_id']; 
	        $sql_finfo = "select s.food_id,s.cata_name as food_name,s.price,s.catalog_id from food_catalogue as s join food_catalogue as p where p.food_id = s.catalog_id and s.price IS NOT NULL and s.catalog_id = $cata_id"; 
	        $result_finfo = $mysql->query($sql_finfo); 
            echo "<th colspan='5' id=".$row_fcata['cata_name'].">".$row_fcata['cata_name']."</th>";
            echo "<tr><td><b>Food ID</b></td><td><b>Food Name</b></td><td><b>Food Price</b></td><td class='text-centered'><b>Quantity</b></td></tr>";
            while($row_finfo = $mysql->fetch($result_finfo)) {
                echo "<tr>";
                echo "<td>".$row_finfo['food_id']."</td>";
                echo "<td>".$row_finfo['food_name']." </td>";
			    echo "<td>&#165;".$row_finfo['price']." </td>";
			    echo "<td onmousemove='vis({$row_finfo['food_id']})' onmouseout='hide({$row_finfo['food_id']});check({$row_finfo['food_id']})'>
				<button id='l{$row_finfo['food_id']}' class='bnum' type='button' onclick='m({$row_finfo['food_id']})' ><b>-</b></button>";
				echo "<input type='number' id='{$row_finfo['food_id']}' name='odfood[{$row_finfo['food_id']}]' min = '0' max = '999'/>";
				echo "<button id='r{$row_finfo['food_id']}' class='bnum' type='button' onclick='a({$row_finfo['food_id']})' ><b>+</b></button>";
	            echo "</td></tr>";
            }
		}		
	?>	
			</table>
		</form>
</div>
<div id='create_page'>
	<?php 
/**IT'S THE EDIT FUNCTION. When 'order_block.php' post this page,it can get the order data and write on the 'create order' input form;
session['times'] is a counter to make sure session['order_id'] directly comes from 'order_block.php', otherwise, if user refersh,
 go to other page or cancel order while editing order, the session['order_id'] is still here.*/	
		if(isset($_POST['fd_quan'])){
			$fd_quan=$_POST['fd_quan'];
			$od_cus=$_POST['od_cus'];
			$order_id=array_keys($od_cus)[0];
			$_SESSION['order_id']=$order_id;
			$cus_id=$od_cus[$order_id];
			echo "<script>document.getElementById('cus').value=$cus_id</script>";
			for($i=0;$i<count($fd_quan);$i++){
				$food_id=array_keys($fd_quan)[$i];
				$food_num=$fd_quan[$food_id];				
				echo "<script>document.getElementById($food_id).value=$food_num</script>";
			}
			unset($_POST['fd_quan']);
			$_SESSION['times']=0;
		}else{
			if(isset($_SESSION['times'])){
				$_SESSION['times']++;
			}
		}
		if(isset($_SESSION['times'])){
			if($_SESSION['times']>1){
				unset($_SESSION['order_id']);
			}	
		}			
	?>
		<script>
			function printTime(){
				var d = new Date();
				var year = d.getFullYear();
				var day = d.getDate();
				var month = d.getMonth()+1;
				var hours = d.getHours();
				var mins = d.getMinutes();
				var secs = d.getSeconds();
				document.getElementById('time').innerHTML=day+"/"+month+"/"+year+"&nbsp;"+hours+":"+mins+":"+secs;
			}
			setInterval(printTime,1000);
		</script>
		<?php
			date_default_timezone_set('PRC'); 
/**save food items detail information into array*/
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
			$datetime = date('d/m/y h:i:s',time());
/**Result part(right part) of create new order*/
/**get customer_id and search name*/
			if(isset($_POST['cus_id'])){
				if(!empty($_POST['cus_id'])){
					$cus_id = (int)$_POST['cus_id'];
					$sql_cusinfo = "SELECT firstname,lastname,tel from customer_info where cus_id = $cus_id;";
					$result_cus = $mysql->query($sql_cusinfo);  
					$row_cus = $mysql->fetch($result_cus);
					$cusname=$row_cus[0]."&nbsp".$row_cus[1];
				}else{
					$cus_id = '0';
					$cusname='Unknown';
				}
			}else{
				$cusname='New Order';
			}
			echo "<tr class='bold'>
			<td style='font-size: 26px;border-right:0px;' >".$cusname."&nbsp</td>
			<td colspan='2' style='border-left:0;text-align:right;' id='time'>$datetime</td></tr>";
            echo "<tr class='fat'><td>Food Name</td><td>Price</td><td>Quantity</td></tr>"; 
/**get information of new order,and give print,submit,modify and reset function; Count total price, if it < 0, disabled the submit button*/
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
				echo "<tr><td colspan='2' class='fat'>Total Price</td><td colspan='2' class='text-centered'>&#165;  ".$totalp."</td></tr></table></form>";
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
							window.location.href='index.php';
						}  
					}
				</script>
				<nav id='submitbtn'>
					<ul>
						<li><button id='subord' type="primary" onclick="document.getElementById('order_submit').submit()">Submit</button></li>
						<li><button onclick="printdiv('create_page')">Print</button></li>
						<li><button id='modord' onclick ="history.go(-1)" outline>Modify</button></li>
						<li><button onclick ="reset()" outline>Reset</button></li>
					</ul>
				</nav>
		<?php
				if(!($totalp>0)){
					echo "<script>document.getElementById('subord').disabled='true';</script>";
				}
				if(isset($_SESSION['order_id'])){
					echo "<script>document.getElementById('modord').disabled='true';</script>";
				}
            }else{
				echo"</table>";
			}
        ?>
</div>




