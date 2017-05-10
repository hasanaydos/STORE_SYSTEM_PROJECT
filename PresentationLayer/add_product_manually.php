<?php 
	require_once("C:/wamp64/www/proje/LogicLayer/ProductManager.php");
	
	$errorMeesage = "";
	
	if(isset($_POST["p_id"]) && isset($_POST["p_name"]) && isset($_POST["quantity"]) && isset($_POST["reg_date"])) {
		
		$p_id = trim($_POST["p_id"]);
		$p_name = trim($_POST["p_name"]);
		$quantity = trim($_POST["quantity"]);
		$reg_date = trim($_POST["reg_date"]);
		
		$errorMeesage = "";
		$result = ProductManager::insertNewProduct($p_id, $p_name, $quantity, $reg_date);
		if(!$result) {
			$errorMeesage = "Yeni ürün kaydı başarısız!";
		}
	}
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
				<h1>ADD PRODUCT MANUALLY</h1>
				
				<form action="<?php $_PHP_SELF ?>" method="POST">
					<p>
						Product ID: <br/>
						<input type="text" name ="p_id" required> <br/>
					</p>
					<p>
						Product Name: <br/>
						<input type="text" name ="p_name" required> <br/>
					</p>
					<p>
						Quantity: <br/>
						<input type="text" name ="quantity" required> <br/>
					</p>
					<p>
						Registration Date: <br/>
						<input type="date" name ="reg_date" required> <br/>
					</p>
					<p>
						<input type="submit" value="SAVE PRODUCT" name="btn_save">
						<?php 
							if(isset($errorMeesage)) {
								echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
							}else
								echo "Congraculations..";
						?>
					</p>
					
					
				</form>
			</div><!-- end .content -->

			<?php require_once("MasterPage/footer.php"); ?>
		</div><!-- end .container -->
	</body>
</html>
