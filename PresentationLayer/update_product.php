<?php
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	else
	{
		header("Location:login.php");
	} 
    require_once("../Path.php");

require_once(PATH."LogicLayer/ProductManager.php");
require_once(PATH."LogicLayer/PropertyManager.php");
$p_id = $p_name = $quantity = $reg_date = "";


if (isset($_SESSION["p_id"]) && isset($_SESSION["status"]) && $_SESSION["status"] == "update") {
    $p_id = $_SESSION["p_id"];
    unset($_SESSION['p_id']);

    $product = ProductManager::getProduct($p_id);
    //$p_id = $productList[0]->getP_id();
    $p_name = $product->getP_name();
    $quantity = $product->getQuantity();

    $propertyList = PropertyManager::getAllPropertiesForProduct($p_id);
    if ($propertyList != NULL) {
        $propertyCount = count($propertyList);
    } else {
        $propertyCount = 0;
    }
    //$propertyCount = 0;
} else if (isset($_POST["btn_name_save"]) && isset($_POST["p_id"]) && isset($_POST["p_name"]) && isset($_POST["quantity"])) {

    $p_id = trim($_POST["p_id"]);
    $p_name = trim($_POST["p_name"]);
    $quantity = trim($_POST["quantity"]);

    $result = ProductManager::updateProduct($p_id, $p_name, $quantity);


    if ($result == -1) {
        $_SESSION['status'] = "false";
    } else {
        $_SESSION['status'] = "true";
    }

    header("Location:show_product_list.php");
}
else
    header("Location:show_product_list.php");
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <title>Store System</title>
    <link href="Css/style.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="Scripts/jquery-3.2.1.js"></script>

    </head>	
    <body>
    <div class="container">

        <?php require_once("MasterPage/header.php"); ?>
        <?php require_once("MasterPage/menu.php"); ?>			

        <div class="content">
            <h1>UPDATE PRODUCT</h1>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                <div id="left_side" class="left_right">
                    <p>
                        Product ID: <br/>
                    <input type="text" id="tb_pid" value="<?php echo $p_id; ?>" name ="p_id"> <br/>
                        </p>
                        <p>
                            Product Name: <br/>
                        <input type="text" id="tb_pname" value="<?php echo $p_name; ?>" name ="p_name"> <br/>
                            </p>
                            <p>
                                Quantity: <br/>
                            <input type="text" id="tb_quantity" value="<?php echo $quantity; ?>" name ="quantity"> <br/>
                                </p>
                                <p>
                                <input type="submit" name="btn_name_save" id="btn_id_save" value="SAVE PRODUCT">
                                    </p>
                                    </div>	
                                    <div id="right_side" class="left_right">
                                        <div id='TextBoxesGroup'>
                                            <div id="TextBoxDiv1">
                                                <?php
                                                for ($i = 0; $i < $propertyCount; $i++) {
                                                    $num = $i + 1;
                                                    echo '
                                                            <p>
                                                                <label>Name #'.$num.' : </label><label style="margin-right:50px;"><b>' . $propertyList[$i]->getPr_name() . '</b></label>
                                                                <label>Value #'.$num.' : </label><label><b>' . $propertyList[$i]->getPr_value() . '</b></label>
                                                            </p>
                                                        ';
                                                }
                                                ?>


                                            </div>
                                        </div>
                                    </div>

                                    </form>
                                    </div><!-- end .content -->
                                    <?php require_once("MasterPage/footer.php"); ?>
                                    </div><!-- end .container -->
                                    </body>
                                    </html>
