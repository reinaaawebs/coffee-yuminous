<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>    



<?php 


if (!isset($_SESSION['user_id'])) {
    // If not logged in, show the alert and redirect with JavaScript
    echo "<script>
            alert('You must be logged in to make a booking.');
            window.location.href = '" . APPURL . "/auth/login.php';
          </script>";
    exit();  // Make sure the rest of the script does not execute
}


if(isset($_POST['submit'])) {

    if(empty($_POST['first_name']) OR empty($_POST['last_name'] OR empty($_POST['date']))
    OR empty($_POST['time']) OR empty($_POST['phone']) OR empty($_POST['message'])) {
   
      echo "<script>
            alert('One or more inputs are empty');
            window.location.href = '" . APPURL . "/auth/login.php';
           </script>";
      exit();  // Make sure the rest of the script does not execute
      

    } else { 

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];


        if($date > date("n/j/Y")) {

            $insert = $conn->prepare("INSERT INTO bookings (first_name, last_name, date, time, phone, message, user_id)
            VALUES (:first_name, :last_name, :date, :time, :phone, :message, :user_id)");

            $insert->execute([
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":date" => $date,
                ":time" => $time,
                ":phone" => $phone,
                ":message" => $message,
                ":user_id" => $user_id

            ]);

        echo "<script>alert('You booked this table successfully')</script>";
        //header("location: ".APPURL. "");


    } else {

        echo "<script>alert('Choose a valid date, you cannot chose a date in the past')</script>";
        //header("location: ".APPURL. "");

    }
  }
}

?>