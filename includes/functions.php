<?php

	/*
	*	Helper Functions
	*/

	// get constants
	require_once("constants.php");

	// spit out error messages
	function disp_error($msg)
	{
		// render error.php file with appropriate error message
		render("error.php", ["message" => $msg]);
		exit;
	}// end function disp_error


	// facilitates debugging by dumping contents of variable to browser
	function dump($variable)
	{
		require("./templates/dump.php");
		exit;
	}// end function dump


	// logs out current user
	function logout()
	{
		// unset any session vars
		$_SESSION = [];

		// expire cookie
		if(!empty($_COOKIE[session_name()]))
		{
			setcookie(session_name(), "", time() - 42000);
		}

		// destroy session
		session_destroy();
	}// end function logout


	// executes SQL statements, possibly w/ parameters, returning an array
	// of all rows in result set or false on (non-fatal) error.
	function query(/* $sql [, ...] */)
	{
		// SQL statement
		$sql = func_get_arg(0);

		// parameters, if any
		$parameters = array_slice(func_get_args(), 1);

		// try to connect to db
		static $handle;
		if(!isset($handle))
		{
			try
			{
				// connect to db
				$handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

				// ensure that PDO::prepare returns false when passed invalid SQL
				$handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch(Exception $e)
			{
				// trigger error
				trigger_error($e->getMessage(). E_USER_ERROR);
				exit;
			}
		}// end if

		// prepare and check SQL statement
		$statement = $handle->prepare($sql);
		if($statement === false)
		{
			// error
			trigger_error($handle->errorInfo()[2], E_USER_ERROR);
			exit;
		}// end if

		// execute sql statement
		$results = $statement->execute($parameters);

		// return result set's rows, if any
		if($results !== false)
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		else
			return false;

	}// end function query


	// Redirect user to destination (url || relative path) on localhost
	// outputs an HTTP header and must be called before caller outputs any HTML
	function redirect($destination)
	{
		// handle URL
		if(preg_match("/^https?:\/\//", $destination))
		{
			header("Location: " . $destination);
		}
		// handle absolute path
		else if (preg_match("/^\//", $destination)) 
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			header("Location: $protocol://$host$destination");
		}
		// handle relative path
		else
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: $protocol://$host$path/$destination");
		}

		// exit immediately
		exit;

	}// end function redirect

	// Reders templates (html/php code chunks), passing in values
	// values are in key-value pairs
	function render($template, $values = [])
	{
		// render if template exists
		if(file_exists("./templates/$template"))
		{
			// extract variables into local scope
			extract($values);

			// render header
			require("./templates/header.php");

			// render template
			require("./templates/$template");

			// render footer
			require("./templates/footer.php");
		}
		else
		{
			trigger_error("Invalid template: $template", E_USER_ERROR);
		}

	} // end function render
?>