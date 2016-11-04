<?php
	session_start();
	if(isset($_SESSION['user'])){
		//echo "vous êtes conecté";
		unset($_SESSION['user']);
		echo '<script language="javascript">document.location.replace("index.php");</script>';
	}
?>