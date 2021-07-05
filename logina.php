<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>
<section class="ftco-section">
<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to </br> A.L.A Center</h2>
								<p>Don't have an account?</p>
								<a href="logina.php" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
			<form action="login.php" method="post">
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>
			<div class="form-group mb-3">
				<label class="label" for="name">User Name</label>
				<input type="text" class="form-control" name="username" placeholder="User Name"><br>
			</div>
			<div class="form-group mb-3">
				<label class="label" for="name">Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password"><br>
			</div>
				<button type="submit" class="form-control btn btn-primary submit px-3">Login</button>
			</form>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>