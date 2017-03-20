<?php
	// configs
	require("./includes/config.php");

	// logs out current user, if any
	logout();

	// redirect user
	redirect("/");
?>