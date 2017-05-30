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
    require_once(PATH . "LogicLayer/OrderManager.php");
    
    if (isset($_POST["addOrder"])) {
        
         header("Location:../Services/srvc_saveOrder.php?orderID=1");
         
    }else if (isset($_POST["btn_name_delete"])){
        
        $o_id = $_POST["radio_name_oid"];
        $result = OrderManager::deleteOrder($o_id);
        if ($result != -1) {
            showMessage("Order deleted successfully..");
        } else {
            showMessage("There is a problem with deleting order !");
        }
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
		
	</head>

	<body>
		<div class="container">
			
			<?php require_once("MasterPage/header.php"); ?>
			<?php require_once("MasterPage/menu.php"); ?>
			
			
			<div class="content">
				<h1>SHOW ORDERS</h1>
				<form action="<?php $_PHP_SELF ?>" method="POST">
                                    <table style="margin-left:auto; margin-right:auto;">
                                        <tbody>
                                            <tr>
                                                <td><input type="submit" name="addOrder" value="Add Order"></td>
                                                <td><input type="submit" name="btn_name_sendToCargo" value="SEND TO CARGO"></td>
                                                <td><input type="submit" name="btn_name_sendToShopping" value="SEND TO SHOPPING"></td>
                                                <td><input type="submit" name="btn_name_delete" value="DELETE"></td>
                                            </tr>
                                            <tr>
                                                <th>Select</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Surname</th>
                                                <th>Status</th>
                                                <th>Tracking No</th>

                                            </tr>
                                            <?php
                                                $orderList = OrderManager::getAllOrders();

                                                for ($i = 0; $i < count($orderList); $i++) {
                                                    ?>
                                                    <tr style="text-align:center">
                                                        <td>
                                                            <input type="radio" name="radio_name_oid" value="<?php echo $orderList[$i]->getO_id(); ?>" checked>
                                                        </td>
                                                        <td><?php echo $orderList[$i]->getO_id(); ?></td>
                                                        <td><?php echo $orderList[$i]->getName(); ?></td>
                                                        <td><?php echo $orderList[$i]->getSurname(); ?></td>
                                                        <td><?php echo $orderList[$i]->getCargoStatus(); ?></td>
                                                        <td><?php echo $orderList[$i]->getTrackingNo(); ?></td>
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
