<?php
    session_start();
    $activeUser = null;

    if (isset($_SESSION['activeUser'])) {
        $activeUser = $_SESSION['activeUser'];
    } else {
        heasder("Location:login.php");
    }
    require_once("../Path.php");
    require_once(PATH . "LogicLayer/ProductManager.php");

    $p_id = $p_name = $quantity = $reg_date = $status = "";
    $error_message = $success_message = "";


    if (isset($_POST["btn_name_delete"]) && isset($_POST["radio_name_pid"])) {
        $p_id = $_POST["radio_name_pid"];

        $result = ProductManager::deleteProduct($p_id);

        if ($result == -1) {
            showMessage("There is a problem deleting product !");
        } else {
            showMessage("Product deleted successfully..");

        }
    } else if (isset($_POST["btn_name_update"]) && isset($_POST["radio_name_pid"])) {

        $_SESSION['p_id'] = $_POST["radio_name_pid"];
        $_SESSION['status'] = "update";

        header("Location:update_product.php");

    } else if (isset($_POST["btn_name_ws"]) && isset($_POST["radio_name_pid"])) {

        header("Location:../Services/srvc_getProductById.php?p_id=".$_POST["radio_name_pid"]);

    } else if (isset($_SESSION['status'])) {

        $status = $_SESSION['status'];

        if ($status == "false") {
            showMessage("There is a problem updating product !");
        } else {
            showMessage("Product Updated Successfully..");
        }
        unset($_SESSION['status']);
    }

    function showMessage($message){
        echo ' <script> alert("'.$message.'"); </script>';
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
                <h1>SHOW PRODUCT LIST</h1>
                <form action="<?php $_PHP_SELF ?>" method="POST">
                    <table style="margin-left:auto; margin-right:auto;">
                        <tbody>
                            <tr>
                                <td><input type="submit" name="btn_name_update" value="UPDATE" id="btn_id_update"></td>
                                <td><input type="submit" name="btn_name_delete" value="DELETE" id="btn_id_delete"></td>
                                <td><input type="submit" name="btn_name_ws"     value="Show Web Service" id="btn_id_ws"></td>
                            </tr>
                            <tr>
                                <th>Select</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>

                            </tr>
                            <?php
                                $productList = ProductManager::getAllProducts();

                                for ($i = 0; $i < count($productList); $i++) {
                                    ?>
                                    <tr>
                                        <td style="text-align:center">
                                            <input type="radio" name="radio_name_pid" class="radio_class_pid" value="<?php echo $productList[$i]->getP_id(); ?>" id="radio_id_pid_<?php echo $productList[$i]->getP_id(); ?>" checked>
                                        </td>
                                        <td><?php echo $productList[$i]->getP_id(); ?></td>
                                        <td><?php echo $productList[$i]->getP_name(); ?></td>
                                        <td><?php echo $productList[$i]->getQuantity(); ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            						
                        </tbody>
                    </table>		
                </form>
            </div><!-- end .content -->
            <?php require_once("MasterPage/footer.php"); ?>
        </div><!-- end .container -->
    </body>
</html>
