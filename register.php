<?php
	// configs
	require("./includes/config.php");

	// if user reached page via GET (as by clicking a link or via redirect)
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		// render form
		render("login_form.php", ["title" => "Register"]);
	}
	// else if user reached page via POST (as by submitting a form via POST)
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Validate fields
		if(empty($_POST["username"]) || empty($_POST["emailadd"]) || empty($_POST["password"]) || empty($_POST["confirmation"]))
		{
			disp_error("Please complete all fields.");
		}
		elseif($_POST["password"] != $_POST["confirmation"])
		{
			disp_error("Password do not match.");
		}

		// insert into database
		$row = query("INSERT INTO users (username, email, hash, has_voted) VALUES(?, ?, ?, 0)", $_POST["username"], $_POST["emailadd"], crypt($_POST["password"], $row["hash"]));

		// if query returns false
		if($row === false)
		{
			disp_error("Oops.. Something went wrong.");
		}
		// else get and set the session id
		else
		{
			$rows = query("SELECT LAST_INSERT_ID() as id");
			$id = $rows[0]["id"];
			$_SESSION["id"] = $id;
			redirect("/");
		}
	}
?>