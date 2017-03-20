<?php
	$name = query("SELECT username FROM users WHERE id=?", $_SESSION["id"]);
?>
<!-- MENU NAVIGATOR / LINKS GOES HERE -->
<div id="menu">
    <ul class="sample-nav">
        <li><a href="/">Home</a></li>
        <li><a href="results.php">Results</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li>Hello <?=strtoupper($name[0]["username"]);?>!</li>
    </ul>
</div> 
<br>