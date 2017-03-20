<?php
	require("./includes/config.php");

	// just count all the available positions
	$rows = query("SELECT position FROM positions ORDER BY id");
	$ctr = 0;
	foreach ($rows as $row) {
		$ctr++;
	}


	// print all candidate's id's to add vote
	while($ctr >= 0)
	{
		$ctr--;
		// Check if the submitting option is not null
		$option = isset($_POST["submitvote"."$ctr"]) ? $_POST["submitvote"."$ctr"] : false;
		if($option)
		{
			$selected = $_POST["submitvote".$ctr];

			// UPDATE CANDIDATES VOTE COUNTS
			query("UPDATE candidates SET votes = votes + 1 WHERE candidates.id=?", $selected);

			// SET USER has_voted TO TRUE
			query("UPDATE users SET has_voted = 1 WHERE users.id=?", $_SESSION["id"]);
		}	
	}
	
	redirect("results.php");
?>