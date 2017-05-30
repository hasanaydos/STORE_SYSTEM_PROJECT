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

$errorMeesage = $successMeesage = "";

if (isset($_POST["p_id"]) && isset($_POST["p_name"]) && isset($_POST["quantity"])) {


    //$tb_count = $_POST["tb_count"];
    $p_id = trim($_POST["p_id"]);
    $p_name = trim($_POST["p_name"]);
    $quantity = trim($_POST["quantity"]);

    $propertyNames = array();
    $propertyValues = array();

    $counter = 0;
    for ($i = 1; $i <= 3; $i++) {
        if ($_POST["tb_name$i"] != "" && $_POST["tb_value$i"] != "") {
            array_push($propertyNames, $_POST["tb_name$i"]);
            array_push($propertyValues, $_POST["tb_value$i"]);
            $counter++;
        }
    }

    //firstly add product to products table
    $result = ProductManager::insertNewProduct($p_id, $p_name, $quantity);

    // her bir property için property tablosunda olup olmadığını kontrol et
    // eğer property tablosunda mevcut değilse evvela yeni property i properties tablosuna ekle 
    // daha sonra bu property nin id sini product_property tablosuna ekle
    // eğer property tabloda mevcutsa onun id sini product_property tablosuna ekle
    for ($i = 0; $i < $counter; $i++) {

        $finded_property = PropertyManager::findExistingProperty($propertyNames[$i], $propertyValues[$i]);

        //bu property daha önce veri tabanımıza eklenmiş, şimdi bu property ve product'ı product_properties tablomuza ekleyeceğiz
        if (count($finded_property) > 0) {
            $add_product_properties = PropertyManager::insertToProductProperties($p_id, $finded_property->getPr_id());
        } else {//demekki böyle bir propery properties tablomuzda yok, şimdi yeni ekleyeceğiz
            $new_property_id = PropertyManager::insertNewProperty($propertyNames[$i], $propertyValues[$i]);
            if ($new_property_id != -1) {
                $add_product_properties = PropertyManager::insertToProductProperties($p_id, $new_property_id);
            }
        }
    }



    if ($result == -1) {
        $errorMeesage = "There is an error saving new product!";
    } else {
        $successMessage = "Successfully registrated..";
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <title>Store System</title>
    <link href="Css/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="Scripts/jquery-3.2.1.js"></script>
    </head>

    <body>
    <div class="container">

        <?php require_once("MasterPage/header.php"); ?>
        <?php require_once("MasterPage/menu.php"); ?>


        <div class="content">
            <h1>ADD PRODUCT MANUALLY</h1>

            <form action="" method="POST">
                <div id="left_side" class="left_right">
                    <p>
                        Product ID: <br/>
                    <input type="text" id="tb_pid" name ="p_id" required> <br/>
                        </p>
                        <p>
                            Product Name: <br/>
                        <input type="text" id="tb_pname" name ="p_name" required> <br/>
                            </p>
                            <p>
                                Quantity: <br/>
                            <input type="text" id="tb_quantity" name ="quantity" required> <br/>
                                </p>
                                <p>
                                <input type="submit" id="btn_id_submit" value="SAVE PRODUCT">
                                    <?php
                                        if (isset($errorMeesage)) {
                                            echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
                                        } else if (isset($successMeesage)) {
                                            echo "<br>" . "<span style='color: green;'>" . $successMeesage . "</span>";
                                        }
                                    ?>
                                    </p>
                                    </div>
                                    <div id="right_side" class="left_right">
                                        <p>
                                            <!--
                                            <input type='button' value='Add Property' id='addButton'>
                                            <input type='button' value='Remove Property' id='removeButton'>
                                            -->
                                        <div id='TextBoxesGroup'>
                                            <div id="TextBoxDiv1">
                                                <p>
                                                    <label>Name #1 : </label><input type='textbox' id='textboxN1' name='tb_name1'>
                                                    <label> Value #1 : </label><input type='textbox' id='textboxV1' name='tb_value1'>
                                                        </p>
                                                        <p>
                                                            <label>Name #2 : </label><input type='textbox' id='textboxN2' name='tb_name2'>
                                                            <label> Value #2 : </label><input type='textbox' id='textboxV2' name='tb_value2'>
                                                                </p>
                                                                <p>
                                                                    <label>Name #3 : </label><input type='textbox' id='textboxN3' name='tb_name3'>
                                                                    <label> Value #3 : </label><input type='textbox' id='textboxV3' name='tb_value3'>
                                                                        </p>
                                                                        </div>
                                                                        </div>
                                                                        </p>
                                                                        </div>

                                                                        </form>
                                                                        </div><!-- end .content -->

                                                                        <?php require_once("MasterPage/footer.php"); ?>
                                                                        </div><!-- end .container -->
                                                                        </body>
                                                                        </html>
