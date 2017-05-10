<?php 
	require_once("C:/wamp64/www/proje/LogicLayer/ProductManager.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Store System</title>
		<link href="Css/style.css" rel="stylesheet" type="text/css">
		
	</head>

	<body>
		<div class="container">
			
			<?php require_once("MasterPage/header.php"); ?>
			<?php require_once("MasterPage/menu.php"); ?>
			
			
			<div class="content">
				<h1>SHOW PRODUCT LIST</h1>
				<table id="tblUsers">
					<tbody>
						<tr>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Registration Date</th>
						</tr>
						<?php 
							$productList = ProductManager::getAllProducts();
							
							for($i = 0; $i < count($productList); $i++) {
								?>
								<tr>
									<td><?php echo $productList[$i]->getP_id(); ?></td>
									<td><?php echo $productList[$i]->getP_name(); ?></td>
									<td><?php echo $productList[$i]->getQuantity(); ?></td>
									<td><?php echo $productList[$i]->getReg_date(); ?></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
				
			</div><!-- end .content -->

			<?php require_once("MasterPage/footer.php"); ?>
		</div><!-- end .container -->
	</body>
</html>
