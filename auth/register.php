<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

  if (isset($_SESSION['username'])) {
    header("location: ".APPURL."");
  }

  if (isset($_POST['submit'])) {
    // Check if fields are empty
    if (empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty')</script>";
    } else {
        // Sanitize inputs
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if username already exists
        $usernameCheck = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $usernameCheck->execute([":username" => $username]);
        $usernameExists = $usernameCheck->fetch(PDO::FETCH_ASSOC);

        // Check if email already exists
        $emailCheck = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $emailCheck->execute([":email" => $email]);
        $emailExists = $emailCheck->fetch(PDO::FETCH_ASSOC);

        if ($usernameExists) {
            echo "<script>alert('Username already exists. Please choose another username.')</script>";
        } elseif ($emailExists) {
            echo "<script>alert('Email already exists. Please choose another email.')</script>";
        } else {
            // Proceed with inserting the new user into the database
            $insert = $conn->prepare("INSERT INTO users (username, email, password) 
            VALUES (:username, :email, :password)");

            $insert->execute([
                ":username" => $username,
                ":email" => $email,
                ":password" => $password
            ]);

            // Redirect to login page after successful registration
            header("location: login.php");
        }
    }
  }
?>


    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Register</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Register</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
			<form action="register.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
				<h3 class="mb-4 billing-heading">Register</h3>
	          	<div class="row align-items-end">
                 <div class="col-md-12">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                 </div>
	          	  <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Email">Email</label>
	                  <input type="text" name="email" class="form-control" placeholder="Email">
	                </div>
	              </div>
                 
	              <div class="col-md-12">
	                <div class="form-group">
	                	<label for="Password">Password</label>
	                    <input type="password" name="password" class="form-control" placeholder="Password">
	                </div>

                </div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
							<div class="radio">
                   <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Register</button>
						    </div>
					</div>
                </div>

               
	          </form><!-- END -->
          </div> <!-- .col-md-8 -->
          </div>
        </div>
      </div>
    </section> <!-- .section -->

<?php require "../includes/footer.php"; ?>