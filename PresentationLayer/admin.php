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
?> 
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>PHP Session</title>
	</head>
	<body> 
		<<form action="<?php $_PHP_SELF ?>" method="POST"> 
			<table>
				<tr>
					<td>
						Enter admin name : 
					</td>
					<td>
						<input type="text" name="uName" />
					</td>
				</tr>
				<tr>
					<td>
						Enter Password : 
					</td>
					<td>
						<input type="password" name="uPassword" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php 
							if(isset($message))
                                                            echo $message; 
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" />
					</td>
				</tr>
			</table>
		</form> 
	</body>
</html>