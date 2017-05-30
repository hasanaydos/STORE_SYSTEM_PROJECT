<?php

    session_start();
    $activeUser = null;

    if(isset($_SESSION['activeUser'])) {
            $activeUser = $_SESSION['activeUser'];
            $activePass = $_SESSION['activePass'];
            $activeID   = $_SESSION['activeID'];
            $activeAuth = $_SESSION['activeAuth'];
    }
    else
    {
            header("Location:login.php");
    } 
    
    require_once("../Path.php");    
    require_once(PATH."LogicLayer/AdminManager.php");
    
    if (isset($_POST["btn_update"])) {
        
        if ($_POST["txt_name"] != "") { 
            $username = $_POST["txt_name"];
        }else{
            $username = $activeUser; 
        }
        
        if ($_POST["txt_pass"] != "") { 
            $password = $_POST["txt_pass"];
        }else{
            $password = $activePass;
        }
        
        $isThereSameAdmin = AdminManager::getUsernameWithoutID($username, $activeID);
        if ($isThereSameAdmin == NULL) {
            $result = AdminManager::updateAdmin($activeID, $username, $password, $activeAuth);
            if ($result != -1) {
                
                $activeUser = $_SESSION['activeUser'] = $username;
                $activePass = $_SESSION['activePass'] = $password;
                
                showMessage("Admin Updated Successfully..");
            }else{
                showMessage("Error ! Admin did not updated !");
            }
        } else {
            showMessage("Please Choose Another username !");
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
				<h1>PROFILE</h1>
                                
                                <form action="" method="POST" style="text-align: center;">
                                    <label>Username</label><br>
                                    <input type="text" name="txt_name" placeholder="<?php echo $activeUser;?>" ><br><br>
                                    <label>Password</label><br>
                                    <input type="text" name="txt_pass" placeholder="<?php echo $activePass;?>" ><br><br>
                                    <input type="submit" value="UPDATE" name="btn_update">
                                    <p>
                                        <?php 
                                            if (isset($error_message)) {
                                                echo "<br>" . "<span style='color: red;'>" . $error_message . "</span>";
                                            } else if (isset($success_message)) {
                                                echo "<br>" . "<span style='color: green;'>" . $success_message . "</span>";                                                
                                            }
                                        ?>
                                    </p>
                                </form>				
			</div><!-- end .content -->

			<?php require_once("MasterPage/footer.php"); ?>
		</div><!-- end .container -->
	</body>
</html>
