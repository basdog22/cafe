<html>
    <head>
        <title>Laowai Cafe</title>
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
        <link type="text/css" rel="stylesheet" href="css/kube.css"/>
    </head>
    <body>
	    <center id="tab_out">
	    <div class="tab">
            <table class="table-stripped">
		        <tr><td class='text-centered' class='tab_in'>
                <button type="submit" onclick="window.location.href='index.php?page=food_cata'">Food catalogue</button>
                <button type="submit" onclick="window.location.href='index.php?page=food_detail'">Food Detail</button>
                <button type="submit" onclick="window.location.href='index.php?page=order_info'">All Orders</button>
                <button type="submit" onclick="window.location.href='index.php?page=order_detail'">Orders Detail</button>
                <button type="submit" onclick="window.location.href='index.php?page=food_sold'">Food Sold Info</button>
                <button type="submit" onclick="window.location.href='index.php?page=customer_info'">Customer Info</button>
		        <button id='customer' type="primary" onclick="window.location.href='index.php?page=new_customer'" outline>New Customer</button>
		        <button id='create' type="primary" onclick="window.location.href='index.php?page=create_order'">Create Order</button></td>
                </tr>
		    </table>
	    </div>
		</center>
		<div class='left'>
			<div class='left_tab'>
				<a href=#tab_out><img src='img/up.png'/></a><br/>
				<?php
				 if ($page == 'create_order'|| $page == 'food_sold') {
					echo "<a href=#Sandwiches>Sandwiches</a><br/>";
					echo "<a href=#Salads>Salads</a><br/>";
					echo "<a href=#Eggs>Eggs</a> <br/>";
					echo "<a href=#BREAKFAST>Breakfast</a><br/>";
					echo "<a href=#Patisserie>Patisserie</a><br/>";
					echo "<a href=#COFFEE>COFFEE</a><br/>";
					echo "<a href=#HotChocolate>HotChocolate</a><br/>";
					echo "<a href=#Tea>Tea</a><br/>";
					echo "<a href=#Beverage>Beverage</a><br/>";
					echo "<a href=#Milkshakes>Milkshakes</a><br/>";
					echo "<a href=#Special>Special</a><br/>";
				}
				?>
				<a href=#bottom><img src='img/down.png'/></a>
			</div>
			<?php
				if ($page == 'create_order') {
					echo "<img id='egg' onclick='xmaas()' src='img/egg.png'/>";
				}
			?>
		</div>
<script>
	function xmaas(){
		if (confirm("Merry Christmas")){
			 document.getElementById("xmas").style.display = "inline";
			 document.getElementById("tree").style.display = "inline";
			 document.getElementById("bgd").style.display = "inline";
		}
	}
	function closex(){
		document.getElementById("xmas").style.display = "none";
		document.getElementById("tree").style.display = "none";
		document.getElementById("bgd").style.display = "none";
		document.getElementById("egg").style.display = "none";
	}	
</script>
		<div class='body'>
		<div id='bgd' onclick='close1()'></div>
		<img id='tree' src='img/tree.png' onclick='closex()'/>
		<img id='xmas' src='img/xmas.gif' onclick='closex()'/>
            <row>
                <column cols="12">		