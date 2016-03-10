	<script src="static/js/jquery-1.7.min.js"></script>
	<script src="static/js/jquery.jqprint.js"></script>
	<!-- jQprint -->
<script>
/**functions of change data in report*/
	function changeQuan(id,valu){
		document.getElementById(id).innerHTML = valu;	
	}
	function addQuan(id,valu){
		var orig =  document.getElementById(id).innerHTML;
		var sum = parseInt(orig)+parseInt(valu);
		document.getElementById(id).innerHTML = sum;
	}
	function print(){
		$(document).ready(function() { 
			$(".my_show").jqprint(); 
			});
	}
</script>
<?php
if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = 'detail';
}
if($action == 'cata'){
/**Show Catalogue of food*/
	$sql = "SELECT catalog_id,cata_name from food_catalogue where food_id = catalog_id and food_id != 51;"; 
	    $result = $mysql->query($sql); 
        echo "<table class ='table-stripped'>"; 
        echo "<th colspan='2'>Food catalogue:</th>";
        echo "<tr><td class='bold'>Catalogue ID</td><td class='bold'>Catalogue Name</td></tr>";
        while($row = $mysql->fetch($result)) {
            echo "<tr>";
            echo "<td>".$row['catalog_id']."</td>";
            echo "<td>".$row['cata_name']." </td>";
	        echo "</tr>";
        }
        echo "</table>";
}else if($action == 'detail'){
/**Show food detail*/
	$sql = "select s.food_id,s.cata_name as food_name,s.price,p.cata_name from food_catalogue as s join food_catalogue as p where p.food_id = s.catalog_id and s.price IS NOT NULL;"; 
	    $result = $mysql->query($sql);
        echo "<table class ='table-stripped'>"; 
        echo "<th colspan='4'>Food Category:</th>";
        echo "<tr><td class='bold'>Food ID</td><td class='bold'>Food Name</td><td class='bold'>Food Price</td><td class='bold'>Food Type</td></tr>";
        while($row = $mysql->fetch($result)) {
            echo "<tr>";
            echo "<td>".($row['food_id']-10)."</td>";
            echo "<td>".$row['food_name']." </td>";
			echo "<td>&#165;".$row['price']." </td>";
			echo "<td>".$row['cata_name']." </td>";
	        echo "</tr>";
        }
        echo "</table>";
}else if($action == 'sold'){
/**Show food sold information*/
	$sql_fcata = "select catalog_id,cata_name from food_catalogue where price IS NULL;";
		$result_fcata = $mysql->query($sql_fcata);
		echo "<table class ='table-stripped'>"; 
		while($row_fcata = $mysql->fetch($result_fcata)) {
			$cata_id = $row_fcata['catalog_id'];	
            $sql_finfo = "select food_id,s.cata_name as food_name,s.price from food_catalogue as s where s.catalog_id = ".$cata_id." and s.price IS NOT NULL;";
	        $result_finfo = $mysql->query($sql_finfo); 
            echo "<th colspan='3' id=".$row_fcata['cata_name'].">".$row_fcata['cata_name']."</th>";
            echo "<tr><td  class='text-centered'><b>Food Name</b></td><td class='bold'>Price</td><td class='bold'>Quantity</td></tr>";
			while($row_finfo = $mysql->fetch($result_finfo)) {
				echo "<tr>";
     			echo "<td class='text-centered'>".$row_finfo['food_name']."</td>";
			    echo "<td>&#165;".$row_finfo['price']." </td>";   
                $foodid = $row_finfo['food_id'];
                $sql_fquantity = "SELECT sum(quantity)as Quantity from order_food where food_id = ".$foodid.";";
				$result_fquantity = $mysql->query($sql_fquantity); 
  				while($row_fquantity = $mysql->fetch($result_fquantity)) {
			        echo "<td>".$row_fquantity['Quantity']."</td></tr>";
		        }
	        }   
	    }echo "</table>";
}else if($action== 'weekly'){
/**show weekly report*/
	/*echo "<style>
			input[type=range]:before { content: attr(min); padding-right: 5px; }
			input[type=range]:after { content: attr(max); padding-left: 5px;}
		</style>
		<script>function changenum(){
					document.getElementById('rangeres').innerHTML = document.getElementById('weeknum').value;
				}
		</script>
		<b>Week <span id='rangeres'><span></b>
		<input type='range' id='weeknum' step='1' min='0' max='53' onchange='changenum()'/>";*/
/**a form to change week and year, default is now*/
	$timeres = $mysql->fetch($mysql->query('select year(now()),week(now(),1)'));
	$weeknum = $timeres[1];
	$yearnum = $timeres[0];
	echo "<div class='my_show'><form method='post' action='index.php?page=food&action=weekly'>
			Week:<input type='number' name='weeknum' id='weeknum' placeholder='Week' min='0' max='53' value='$weeknum'/>
			Year:<input type='number' name='yearnum' id='yearnum' placeholder='Year' min='2010' max='$yearnum' value='$yearnum'/>
			<button type='submit' value='OK' class='my_hidden'>OK</button>
		</form>
		<button style='margin-left:76%;margin-top:-4%;float:right;position:absolute' type='primary' onclick='print()'>Print</button>
		";
	if(isset($_POST['weeknum'])&&$_POST['weeknum']!=''){$weeknum = $_POST['weeknum'];}
	if(!empty($_POST['yearnum'])){$yearnum = $_POST['yearnum'];}
	echo "<script>
			document.getElementById('weeknum').value = $weeknum;
			document.getElementById('yearnum').value = $yearnum;
		</script>";
/**active sql to find the date of Mon. to Sat.*/	
	$sql_subdate = "select DATE_ADD('$yearnum-01-01',INTERVAL (7*$weeknum-WEEKDAY('$yearnum-01-01')) DAY) AS start, DATE_ADD(DATE_ADD('$yearnum-01-01',INTERVAL (7*$weeknum-WEEKDAY('$yearnum-01-01')) DAY),INTERVAL 5 DAY) AS end;";
	$subdate = $mysql->fetch($mysql->query($sql_subdate));
/**show weekly report table*/
	$sql_fcata = "select catalog_id,cata_name from food_catalogue where price IS NULL;";
		$result_fcata = $mysql->query($sql_fcata);		
echo "<table class ='table-stripped'><th style='font-size:1.6em' class='text-centered' colspan='10'>Weekly's selling Food Diary: {$subdate['start']} to {$subdate['end']}</th>"; 
		while($row_fcata = $mysql->fetch($result_fcata)) {
			$cata_id = $row_fcata['catalog_id'];	
            $sql_finfo = "select food_id,s.cata_name as food_name,s.price from food_catalogue as s where s.catalog_id = ".$cata_id." and s.price IS NOT NULL;";
	        $result_finfo = $mysql->query($sql_finfo); 
            echo "<tr id='{$row_fcata['cata_name']}'><td class='text-centered'><b style='font-size:1.2em;'>{$row_fcata['cata_name']}</b></td><td class='bold'>Price</td><td class='bold'>Monday</td><td class='bold'>Tuesday</td><td class='bold'>Wednesday</td><td class='bold'>Thursday</td><td class='bold'>Friday</td><td class='bold'>Saturday</td><td class='bold'>Quantity</td></tr>";
			while($row_finfo = $mysql->fetch($result_finfo)) {
				echo "<tr>";
     			echo "<td class='text-centered'>".$row_finfo['food_name']."</td>";
			    echo "<td>&#165;".$row_finfo['price']." </td>"; 
				echo "<td id='1_{$row_finfo['food_id']}'></td>
						<td id='2_{$row_finfo['food_id']}'></td>
						<td id='3_{$row_finfo['food_id']}'></td>
						<td id='4_{$row_finfo['food_id']}'></td>
						<td id='5_{$row_finfo['food_id']}'></td>
						<td id='6_{$row_finfo['food_id']}'></td>
						<td id='q_{$row_finfo['food_id']}'>0</td></tr>
					";
	        }echo "<tr><td class='text-centered'>TOTAL</td>
						<td></td>
						<td>&#165;<span id='1_$cata_id'>0</span></td>
						<td>&#165;<span id='2_$cata_id'>0</span></td>
						<td>&#165;<span id='3_$cata_id'>0</span></td>
						<td>&#165;<span id='4_$cata_id'>0</span></td>
						<td>&#165;<span id='5_$cata_id'>0</span></td>
						<td>&#165;<span id='6_$cata_id'>0</td>
						<td id='q_$cata_id'>0</td>
					</tr>
					<tr><td class='text-centered'><b>Total Week: </b></td><td><kbd>&#165;<span id='total_$cata_id'>0</span></kbd></td>
					<tr/>";
	    }
		echo "<tr>
				<td class='fat' colspan='8'><b>AMOUNT TOTAL:&nbsp; &nbsp; <samp>&#165;<span id='total_all'>0</span></b></samp></td>
				<td><button type='primary' onclick='print()'>Print</button></td>
			</tr></table></div>";
/**stastic data and write it on the report table*/
		for($dayweek=2;$dayweek<8;$dayweek++){
			$sql="select of.food_id,sum(quantity),sum(quantity)*fc.price,fc.catalog_id from order_food as of join food_catalogue as fc ON of.food_id = fc.food_id where order_id in (select order_id from orders where week(date,1) = $weeknum and year(date)=$yearnum and DAYOFWEEK(date) = $dayweek) group by food_id";
			$res = $mysql->query($sql);
			$zhou = $dayweek - 1;
			while($row = $mysql->fetch($res)){
				echo "<script>changeQuan('{$zhou}_{$row[0]}',{$row[1]});
							addQuan('q_{$row[0]}',{$row[1]});
							addQuan('{$zhou}_{$row[3]}',{$row[2]});
							addQuan('q_{$row[3]}',{$row[1]});
							addQuan('total_{$row[3]}',{$row[2]})
							addQuan('total_all',{$row[2]});
					</script>";
			}
		}
}
?>
