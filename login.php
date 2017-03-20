<?php
	// configuration
	require("/includes/config.php");

	// if user reached page via GET (as by clicking a link or via redirect)
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		// render form
		render("login_form.php", ["title" => "Log In"]);
	}

	// else if user reached page via POST (as by submitting a form via POST)
	elseif ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// validate submission
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			disp_error("You must provide your username.");
		}
		else
		{

			// query database for user
			$rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

			// if we found user, check password(encrypted)
			if(count($rows) == 1)
			{
				// first (and only) row
				$row = $rows[0];

				// compare hash of user's input against hash that's in the db
				if(crypt($_POST["password"], $row["hash"]) == $row["hash"])
				{
					// remember that the user is now logged in by storing user's ID in session
					$_SESSION["id"] = $row["id"];

					// redirect to main page
					redirect("/");
				}
				// else account is not found
				else
				{
					disp_error("Invalid username and/or password.");
				}
			}

		}// end of inner if-else

	} // end elseif

?>