test login/registration form<br><br><br>
<!-- <style><?php include 'css/style.css'; ?></style> -->
<form method="post" action="register.php" name="signin-form">
	<div class="form-element">
		<label>username</label>
		<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
	</div>
	
	<div class="form-element">
		<label>password</label>
		<input type="password" name="password" required />
	</div>
	
	<!-- <button type="submit" name="login" value="login">log in</button> -->
	<button type="submit" name="register" value="register">register</button>
</form>