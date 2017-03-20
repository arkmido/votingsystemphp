<br><br>
<div class="contain-form">

	<!-- Login form -->
	<div class="logreg">
		<fieldset>
			<legend>Login</legend>

			<form action="login.php" method="post" class="form-horizontal">
				<!-- username field -->
				<div class="form-group">
					<input autofocus class="form-control" name="username" placeholder="Username" type="text" maxlength="30"/>
				</div>

				<!-- password field -->
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="Password"/>
				</div>

				<!-- submit button -->
				<div class="form-group">
					<button type="submit" class="btn btn-default">Log In</button>
				</div>
			</form>
		</fieldset>
	</div>

	<br>

	<!-- registration form -->
	<div class="logreg">
		<fieldset>
			<legend>Don't have an account yet?</legend>

			<form action="register.php" method="post" class="form-horizontal">
				<!-- email address field -->
				<div class="form-group">
					<input class="form-control" name="emailadd" placeholder="Email Address" type="text" size="20"/>
				</div>

				<!-- username field -->
				<div class="form-group">
					<input class="form-control" name="username" placeholder="Username" type="text" size="20"/>
				</div>

				<!-- password field -->
				<div class="form-group">
					<input class="form-control" type="password" placeholder="Password" name="password"/>
				</div>

				<!-- re-type password field -->
				<div class="form-group">
					<input class="form-control" type="password" placeholder="Re-type Password" name="confirmation"/>
				</div>

				<!-- submit button -->
				<div class="form-group">
					<button type="submit" class="btn btn-default">Register</button>
				</div>
			</form>
		</fieldset>
	</div>

</div>