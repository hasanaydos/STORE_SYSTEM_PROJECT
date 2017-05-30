<?php
	session_start();
        
	if(isset($_SESSION['activeUser'])) {
            unset($_SESSION['activeUser']);
	}
        session_destroy();
        header("Location:login.php"); 
	
?> 