<?php
	require("./includes/config.php");


	/*
	*	Get All Candidates and their positions
	*/
	$rows = query("SELECT candidates.id, candidates.firstName, candidates.lastName, positions.position FROM candidates, positions WHERE positions.id = candidates.position");
	$candidates = [];
	foreach ($rows as $row)
	{
		$candidates[] = [
			"id" => $row["id"],
			"name" => $row["firstName"] . " " . $row["lastName"],
			"position" => $row["position"]
		];
	}

	/*
	*	Get All Positions
	*/
	$rows = query("SELECT position FROM positions ORDER BY id");
	$positions = [];
	foreach ($rows as $row) {
		$positions[] = [
			"candidate_position" => $row["position"]
		];
	}

	/*
	*	Identify Voting Privilege of the user logged in
	*/
	$has_voted = query("SELECT has_voted FROM users WHERE id=?", $_SESSION["id"]);

	// REDIRECT THE USER TO RESULTS PAGE IF THE USER HAS ALREADY VOTED
	if($has_voted[0]["has_voted"] == 1)
	{
		redirect("results.php");
	}
	
	//	REDIRECT THE USER TO VOTING PAGE
	elseif($has_voted[0]["has_voted"] == 0)
	{
		// pass values to home page
		render("home.php", ["title" => "ELEKSYON'17", "candidates" => $candidates, "positions" => $positions, "has_voted" => $has_voted]);
	}

?>

