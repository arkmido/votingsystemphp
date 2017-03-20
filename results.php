<?php
	require("./includes/config.php");

	/*
	*	Get All Positions
	*/
	$rows = query("SELECT id, position FROM positions ORDER BY id");
	$positions = [];
	foreach ($rows as $row) {
		$positions[] = [
			"id" => $row["id"],
			"candidate_post" => $row["position"]
		];
	}

	/*
	*	Get all candidates information
	*/
	$rows = query("SELECT * FROM candidates");
	$summary = [];

	foreach ($rows as $row) {
		$summary[] = [
			"id" => $row["id"],
			"name" => $row["firstName"] . " " . $row["lastName"],
			"position" => $row["position"],
			"votes" => $row["votes"]
		];
	}

	// Push data to results_form (view)
	render("results_form.php", ["title" => "RESULTS", "summaryvote" => $summary, "positions" => $positions]);
?>

