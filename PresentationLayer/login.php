<?php 
    require_once("../Path.php");
    require_once(PATH."LogicLayer/AdminManager.php");

    if(isset($_POST["btn_login"]) &&  isset($_POST["username"]) && isset($_POST["password"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = AdminManager::getAdmin ($username, $password);
        
        if($result == NULL) {
                echo ' <script>
                        alert("Incorrect Entry, Please Try Again !");
                    </script>
                 ';
        } else {  
            if ($result->getAuthorization() == 0) {
                echo ' <script>
                           alert("Waiting for confirmation..");
                       </script>
                    ';
            } else { 
                session_start();
                $_SESSION['activeUser'] = $result->getUsername();
                $_SESSION['activePass'] = $result->getPassword();
                $_SESSION['activeID']   = $result->getA_id();
                $_SESSION['activeAuth'] = $result->getAuthorization();

                header("location: main.php");
            }                    
        }	
    }else if( isset($_POST["btn_signup"]) &&  isset($_POST["username"]) && isset($_POST["password"]) ) { 
        // burada ise yeni admin kayıt olmak istemiş.
        $username = $_POST["username"];
        $password = $_POST["password"];
        // kullanıcı adını ve şifresini aldıktan sonra boş değilse işlem yapıyoruz.
        if ($username != "" && $password != "") {
            
            $result = AdminManager::getUsername($username);
             // girmiş olduğu kullanıcı adını db den kontrol ettiriyoruz.
            if($result == NULL) {
                // eğer sonuç null ise bu kullanıcı adı uygundur alınabilir diyoruz..
                $newAdminID = AdminManager::insertNewAdmin($username, $password);
                // ve kayıanbnem arıyor tmm. başarılı gerçekleşti ise bize s
                if ($newAdminID != -1) {
                     echo ' <script>
                                alert("New Admin is Singed up Successfully. \nWaiting for confirmation..");
                            </script>
                         ';
                } else {
                    echo ' <script>
                                alert("A problem occured while saving new admin !");
                            </script>
                         ';
                }
            }else{
                echo ' <script>
                            alert("Select Another username !");
                        </script>
                     ';
            }
        }else {
            echo ' <script>
                            alert("Textboxes cannot empty !");
                        </script>
                     ';
        }
        	
    }
?> 
<!doctype html>
<html>
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>STORE SYSTEM</title>
		<style type="text/css">
			form {
			width: 700px;
			height: 700px;
			margin-left: auto;
			margin-right: auto;
			padding: 15px;
			background: url("Images/log_in_bg.png") no-repeat center top;
			background-size: cover;
			}
		</style>
		
	</head>

	<body>
		<div class="container">
			
                    <form action="" method="POST"> 
                                 <table style="margin-left: auto; margin-right: auto; margin-top: 200px;">
                                         <tr>
                                                 <td>
                                                     Enter admin name : <br>

                                                         <input type="text" name="username" />
                                                 </td>
                                         </tr>
                                         <tr>
                                                 <td>
                                                         Enter Password : <br>

                                                         <input type="password" name="password" />
                                                 </td>
                                         </tr>
                                         <tr>
                                                 <td colspan="2">
                                                         <?php 
                                                            if (isset($message)) {
                                                                echo $message; 
                                                            }
                                                         ?>
                                                 </td>
                                         </tr>
                                         <tr>
                                                 <td colspan="2">
                                         <input type="submit" name="btn_login" value="LOG IN" /> 
                                         <input type="submit" name="btn_signup" value="SIGN UP" style="float: right;"/> <br>
                                         <!--or <br>
                                         <a href="sign_up.php">Create New Admin</a>
                                                 </td>
                                         </tr>-->
                                 </table>
                     </form> 
		</div><!-- end .container -->
	</body>
</html>