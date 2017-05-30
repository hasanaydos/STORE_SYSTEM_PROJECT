<?php
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
		$activeID =  $_SESSION['activeID'];
	}
	else
	{
		header("Location:login.php");
	} 
    require_once("../Path.php");
    require_once(PATH."LogicLayer/AdminManager.php");
    
    if (isset($_POST["btn_name_update"])) {
        $admin_id = $_POST["radio_name_aid"];
        $admin_auth = $_POST["auth_".$admin_id];
        
        $result = AdminManager::updateAdminAuth($admin_id, $admin_auth);
        if ($result == -1) {
            showMessage("There is a problem with accepting admin !");
        } else {
            showMessage("Admin updated successfully.");
        }
    } else if (isset($_POST["btn_name_delete"])) {
        $admin_id = $_POST["radio_name_aid"];
    
        $result = AdminManager::deleteAdmin($admin_id);
        if ($result == -1) {
            showMessage("There is a problem with deleting admin !");
        } else {
            showMessage("Admin deleteds successfully.");
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
				<h1>MANAGE ADMINS</h1>
                                 <form action="" method="POST">                                   
                                 
                                    <table style="margin-left:auto; margin-right:auto;">
                                        <tbody  style="text-align: center;">
                                            <tr>
                                                <td><input type="submit" name="btn_name_update" value="UPDATE" id="btn_id_update"></td>
                                                <td><input type="submit" name="btn_name_delete" value="DELETE" id="btn_id_delete"></td>
                                            </tr>
                                            <tr>
                                                <th>id</th>
                                                <th>Username</th>
                                                <th>Authorization</th>

                                            </tr>
                                            <?php 
                                                $admins = AdminManager::getAdminsWithoutActiveOne($activeID);

                                                for ($i = 0; $i < count($admins); $i++) {
                                                    ?>
                                                        <tr>
                                                            <td style="text-align:center">
                                                                <input type="radio" name="radio_name_aid" value="<?php echo $admins[$i]->getA_id(); ?>" checked>
                                                            </td>
                                                            <td><?php echo $admins[$i]->getUsername(); ?></td>
                                                            <td>
                                                                <?php 
                                                                    echo ' 
                                                                            <select name="auth_'.$admins[$i]->getA_id().'">
                                                                         ';
                                                                    if ($admins[$i]->getAuthorization() == 1) {
                                                                        echo ' 
                                                                                <option value="1" selected>Normal Admin</option>
                                                                                <option value="2">Master Admin</option>
                                                                            ';
                                                                    } else {
                                                                        echo ' 
                                                                                <option value="1">Normal Admin</option>
                                                                                <option value="2" selected>Master Admin</option>
                                                                            ';
                                                                    }
                                                                
                                                                    echo '</select>';
                                                                ?>
                                                            
                                                                
                                                            </td>
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
