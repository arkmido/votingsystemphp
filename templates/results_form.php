<?php
	require("menu_nav.php");

	// Count votes to get over-all percentage
	$count = 0;
	foreach($summaryvote as $sum)
		$count += $sum["votes"];

	// Just some page header/title
	echo "<center>
			<h2>Results So Far:</h2>
			<hr>";

	// Get all positions passed by the controller (results.php)
	foreach ($positions as $pos) 
	{
		echo "<h3><b>{$pos["candidate_post"]}</b></h3>";
		echo "<div class='votes'>";

		// Get the vote, candidate name, and the position
		foreach($summaryvote as $sum)
		{
			if($pos["id"] == $sum["position"])
			{
				// over-all percentage computation
				$voteper = round($sum["votes"]*100/$count);
				// Some aesthetics (progress bar)
				echo("<div class='progress'>
						<div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' aria-valuemin='40' aria-valuemax='100' style='width:". ($voteper+40) ."%'>
							<h4>" . $sum["name"]." = ".$sum["votes"]." votes (" . $voteper . "%)</h4>
						</div>
					  </div>");
			}
		}
		echo "</div>";
	}

	echo "</center>"
?>

