<?php
	require("menu_nav.php");
?>

<h1>
	<center>Cast Your Vote Now!</center>
</h1>

<br><br>


<!-- DYNAMIC LAYOUT FOR THE PEOPLE TO VOTE AND THEIR POSISTIONS -->
<form action="castvote.php" method="post" id="tbl" class="form-horizontal">
	<?php
		 $ctr = 0; // <-- This is to count all Select tag and distinguish their names
		foreach ($positions as $pos) {
			/*
			*	Chunks of HTML codes inside php to build the dynamic user interface
			*/
			echo "<div>
					<table class='table table-condensed'>
						<tbody>
						<tr>
							<td class='col-xs-6'>{$pos["candidate_position"]}</td>";

					  	echo "<td class='col-xs-6 op-fields'>
					  			<select name='submitvote".$ctr."'>";
							echo '<option value="0"> </option>';

									// Get each candidates and match their positions
									foreach($candidates as $can)
									{
										if($can["position"] == $pos["candidate_position"])
											echo '<option value="'.$can["id"].'">'.$can["name"].'</option>';
									}
						
							echo "</select>
							</td>
						</tr>
						</tbody>
					</table>
				</div>";
			 $ctr+=1;
		}
		// echo $ctr;
	?>
	<!-- THE BUTTON TO SUBMIT THE CHOICES -->
	<div class='form-group'>
		<button type="submit" class="btn btn-lg btn-success">Submit</button>
	</div>
</form>
