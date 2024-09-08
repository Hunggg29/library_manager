<?php
	if(!isset($_SESSION["signinstatus"])){
        $_SESSION["signupstatus"] = 0;
	    $_SESSION["signinstatus"] = 0;
        $_SESSION["typeaccount"] = $_SESSION["accountname"] = $_SESSION["accountpassword"] = "";
    }
?>