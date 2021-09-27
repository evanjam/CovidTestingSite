test login/registration form<br><br><br>

<style><?php include 'css/style.css'; ?></style>

<!-- username/password field and register button which triggers register.php form -->
<form method="post" action="../includes/register.php" name="signin-form">
	<div class="form-element">
		<label>username</label>
		<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
	</div>
	
	<div class="form-element">
		<label>password</label>
		<input type="password" name="password" required />
	</div>

	<button type="submit" name="register" value="register">register</button>
</form>

<!-- username/password field and login button which triggers login.php form -->
<form method="post" action="../includes/login.php" pattern="[a-zA-Z0-9]+" required />
	<div class="form-element">
			<label>username</label>
			<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
		</div>
		
		<div class="form-element">
			<label>password</label>
			<input type="password" name="password" required />
	</div>

	<button type="submit" name="login" value="login">login</button>
</form>