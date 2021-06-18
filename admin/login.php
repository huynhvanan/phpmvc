<?php
	include '../classes/adminlogin.php';
?>
<?php
	$class = new adminlogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$User = $_POST['User'];
		$Pass = md5($_POST['Pass']);
		$login_check = $class->login_admin($User,$Pass);
	}
?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>AnStore</title>
	    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
	</head>
<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="post">
				<h1>Admin Login</h1>
				<span>
					<?php
						if(isset($login_check)){
							echo $login_check;
						}
					?>
				</span>
				<div>
					<input type="text" placeholder="Username" required="" name="User"/>
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="Pass"/>
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#"></a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>
</html>