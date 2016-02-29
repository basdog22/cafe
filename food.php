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
}else if($action == 'weekly'){
	$sql_fcata = "select catalog_id,cata_name from food_catalogue where price IS NULL;";
		$result_fcata = $mysql->query($sql_fcata);
		echo "<table class ='table-stripped'>"; 
		while($row_fcata = $mysql->fetch($result_fcata)) {
			$cata_id = $row_fcata['catalog_id'];	
            $sql_finfo = "select food_id,s.cata_name as food_name,s.price from food_catalogue as s where s.catalog_id = ".$cata_id." and s.price IS NOT NULL;";
	        $result_finfo = $mysql->query($sql_finfo); 
            echo "<th colspan='3' >$row_fcata['cata_name']</th>";
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
		/**select food_id,count(food_id) from order_food where order_id in (select order_id from orders where week(date,1) = 9 and dayofweek(date) = 4) group by food_id;*/
		for($dayweek=2;$dayweek<7;$dayweek++){
			$sql="select food_id,count(food_id) from order_food where order_id in (select order_id from orders where week(date,1) = 9 and dayofweek(date) = $dayweek) group by food_id";
			$res = $mysql->query($sql);
			echo "zhou $dayweek<br/>";
			while($row = $mysql->fetch($res)){
				echo 'food_id'.$row[0].'&nbsp- quantity'.$row[1].'<br/>';
			}
		}
}
?>