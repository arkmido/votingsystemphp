<?php

	/*
	*	configure pages
	*/
	
	// display errors, warnings, and notices
	ini_set("display_erros", true);
	error_reporting(E_ALL);

	// requirements (helpers)
	require("constants.php");
	require("functions.php");

	// enable sessions
	session_start();

	// require authentication for all pages except login, logout, register
	if(!in_array($_SERVER["PHP_SELF"], ["/login.php", "/logout.php", "/register.php"]))
	{
		if(empty($_SESSION["id"]))
		{
			redirect("login.php");
		}
	}
?>