<script>
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
	//error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	$sql_fcata = "select catalog_id,cata_name from food_catalogue where food_id = catalog_id";
	$result_fcata = $mysql->query($sql_fcata);
	$sql_cusinfo = "SELECT customer_id,CONCAT(firstname,' ',lastname) FROM customer_info ORDER BY firstname, lastname";
	$result_cusinfo = $mysql->query($sql_cusinfo);
?>
		<form id='order_table' action='index.php?page=create_order' method ='post'>
			<div class='big'><b>Customer:</b>
				<select name='cus_id' id='cus'>
					<option value='0'>--</option>
					<?php 
					while($row = $mysql->fetch($result_cusinfo)) {
						echo "<option value=$row[0]>$row[1] @$row[0]</option>";
					}	
					session_start();
					?>
				</select>
				<button id='createbtn' type='primary'>Create New</button>
			</div>
			<div class='create_order'>
				<table class ='table-stripped'>
	<?php
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
		include 'create_order_page.php';
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
		}
				
	?>
</div>




