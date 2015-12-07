<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
  redirect_to("index.php");
}
$message = "";
// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$username = trim($_POST['username']);
  	$password1 = trim($_POST['password']);
  	$password2 = trim($_POST['password']);
	if($password1 !== $password2) {
		$message = "Passwords don't match";
	} else {
		$user = new User();
		$user->first_name = $_POST['firstname'];
		$user->last_name = $_POST['lastname'];
		$user->username = $_POST['username'];
		$user->password = $_POST['password1'];
		$user->create();
		redirect_to('login.php');
	}
} else {
	$firstname = "";
	$lastname = "";
	$username = "";
	$password1 = "";
	$password2 = "";	
}
?>
<?php include_layout_template('header.php'); ?>
<div id="form">
		<h2>Login</h2>
		<?php echo output_message($message); ?>

		<form action="register.php" method="post">
		  <table>
		    <tr>
		      <td>First Name:</td>
		      <td>
		        <input type="text" name="firstname" maxlength="30" value="<?php echo htmlentities($firstname); ?>" required/>
		      </td>
		    </tr>
		    <tr>
		      <td>Last Name:</td>
		      <td>
		        <input type="text" name="lastname" maxlength="30" value="<?php echo htmlentities($lastname); ?>" required/>
		      </td>
		    </tr>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" required/>
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password1" maxlength="30" value="<?php echo htmlentities($password1); ?>" required/>
		      </td>
		    </tr>
		    <tr>
			<tr>
		      <td>Retype Password:</td>
		      <td>
		        <input type="password" name="password2" maxlength="30" value="<?php echo htmlentities($password2); ?>" required/>
		      </td>
		    </tr>
		    <tr>	
          <td>
            <a href='login.php'>Login</a>
			</td>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Register" />
		      </td>
		    </tr>
		  </table>
		</form>
</div>
<?php include_layout_template('footer.php'); ?>
