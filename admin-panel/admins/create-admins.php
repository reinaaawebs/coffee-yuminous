<?php 
require "../layouts/header.php"; 
require "../../config/config.php"; 

// Check if the admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
}

if (isset($_POST['submit'])) {

    // Check if any input fields are empty
    if (empty($_POST['adminname']) OR empty($_POST['email']) OR empty($_POST['password'])) {
        echo "<script>alert('One or more inputs are empty')</script>";
    } else {
        // Sanitize the inputs
        $adminname = $_POST['adminname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if the adminname already exists
        $adminnameCheck = $conn->prepare("SELECT * FROM admins WHERE adminname = :adminname");
        $adminnameCheck->execute([":adminname" => $adminname]);
        $adminnameExists = $adminnameCheck->fetch(PDO::FETCH_ASSOC);

        // Check if the email already exists
        $emailCheck = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $emailCheck->execute([":email" => $email]);
        $emailExists = $emailCheck->fetch(PDO::FETCH_ASSOC);

        // If adminname exists, alert and stop registration
        if ($adminnameExists) {
            echo "<script>alert('Admin name already exists. Please choose another admin name.')</script>";
        } 
        // If email exists, alert and stop registration
        elseif ($emailExists) {
            echo "<script>alert('Email already exists. Please choose another email.')</script>";
        } 
        else {
            // Proceed with inserting the new admin into the database
            $insert = $conn->prepare("INSERT INTO admins (adminname, email, password) 
            VALUES (:adminname, :email, :password)");

            $insert->execute([
                ":adminname" => $adminname,
                ":email" => $email,
                ":password" => $password
            ]);

            // Redirect to the admins page after successful registration
            header("location: admins.php");
        }
    }
}
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>


<?php require "../layouts/footer.php"; ?>