<html>
    <head>
        <title>Cafe system</title>
		<link type="text/css" rel="stylesheet" href="static/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="static/css/kube.css"/>
		<link type="text/css" rel="stylesheet" href="static/css/bootstrap.min.css"/>
  	  	<script src="static/js/jquery.min.js"></script>
  	  	<script src="static/js/bootstrap.min.js"></script>
    </head>
    <body>
	    <center class="tab_out">
            <table class="table-stripped">
		        <tr><td class='text-centered' id='tab'>
				<nav>
					<div class="left-menu">
						<a href="index.php?page=create_order"><button type="primary">Create order</button></a>
						<a href="index.php?page=current_orders"><button>Current orders</button></a>
					</div>
					<div class="right-menu">
						<div class="nav dropdown">
						    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Menu
						    <span class="caret"></span></button>
						    <ul class="dropdown-menu">
						      <li class="dropdown-header">Overviews</li>
							  <li><a href="index.php?page=food&action=sold">Food sold</a></li>
							  <li><a href="index.php?page=food&action=weekly">Weekly Report</a></li>
						      <li class="divider"></li>
						      <li class="dropdown-header">Customer</li>
						      <li><a href="index.php?page=customer&action=info">Customer info</a></li>
							  <li><a href="index.php?page=customer&action=new">New customer</a></li>
						      <li class="divider"></li>
							  <li class="dropdown-header">Product</li>							  
							  <li><a href="index.php?page=food&action=detail">Food items</a></li>
							  <li><a href="index.php?page=food&action=cata">Food categories</a></li>
							  <li><a href="index.php?page=food&action=new">New Food</a></li>
						    </ul>
						  </div>
					</div>
				</nav>
				
				</tr></td>      
		    </table>
		</center>
		<div class='left'>
			<div class='left_tab'>
				<a href=#><img src='static/img/up.png'/></a><br/>
				<?php
				if(!isset($_GET['action'])){
					$_GET['action']='';
				}
				if ($page == 'create_order' || ($_GET['action']=='weekly') || $_GET['action']=='sold') {
					$sql_fcata = "SELECT cata_name FROM food_catalogue WHERE price IS NULL ORDER BY catalog_id";
					$res_fcata = $mysql->query($sql_fcata);
					while($row_fcata = $mysql->fetch($res_fcata)){
						echo "<a href=#".$row_fcata['cata_name'].">".$row_fcata['cata_name']."</a><br/>";
					}
				}
				?>
				<a href=#bottom><img src='static/img/down.png'/></a>
			</div>
		</div>
		<div class='body'>
            <row>
                <column cols="12">		
		