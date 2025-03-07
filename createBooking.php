<!-- 
This is a PHP script so users can BOOK an appointment. 
The form requires users to enter 3 values: date, time and dancers, and these
values get added to a row in the app-db db, bookings table.
Bookings table schema:
    primary key: id, INT(11)  #
    foreign key: username, VARCHAR(255) # user's username
    Date, DATE # booking date
    Time, TIME # booking time (EST)
    Dancer, VARCHAR(15) // user chooses which dancer/s they want to book
-->


<!DOCTYPE html>
<html lang="en">
  <meta charset="utf-8" />
  <head>
    <?php session_start(); ?>
<!-- This is the default encoding type for the HTML Form post submission. 
  Encoding type tells the browser how the form data should be encoded before 
  sending the form data to the server. 
-->
    <meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
    <link rel="stylesheet" href="stylesheet.css">
    <title>Booking Form</title>
  </head> 
  <body>
  <div id="navbar" class="navbar">
        <ul>
        <li><a href="index.php">Home Page</a></li>
        <li><a href="MeetDancers.php">Meet the Dancers</a></li>
          <li><a href="logInLanding.php">My Profile</a></li>
        </ul>
    </div>
<!-- 
  PHP server-side code
 -->
 <?php
        // import vars for server connection and connect to sql
        require_once "config.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection: used for testing
        //  if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
        // echo "Connected successfully";

        // Get the logged-in user's username 
        session_start();  
        // should tell the user that they are logged in ontop of page
        if(isset($_SESSION['username'])){
          echo "You are currently logge in as " . $_SESSION['username'];
        }
    
        // If the user enters those values, post it to the server. HTMl ensures that fields aren't left blank
        // ($_SERVER["REQUEST_METHOD"] and $_POST are parts of the PHP language.)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $out_value = "";
            $date = $_POST["date"];
            $time = $_POST["time"];
            $dancers = $_POST["dancers"];
            $username = $_SESSION['username'];  // Assuming 'username' is stored in session
            
            // Prepare SQL query with the data to post the database.
            $sql_query = "INSERT INTO bookings (b_username, b_date, b_time, b_dancers) VALUES ('$username', '$date', '$time', '$dancers')";
       
            // Send the query to the database and check if it was successful
            if (mysqli_query($conn, $sql_query)) {
                $out_value = "Successfully booked!";
            } else {
                $out_value = "Error: " . mysqli_error($conn);  // Display error if query fails
            }
        }
        $conn->close();
        ?>
  <!-- Create text boxes for user to input booking date, time, and dancer/s selection. -->
  <div id="form">
      <h1>CREATE BOOKING</h1>
      <form name="form" action="" method="POST">

        <!-- date input box-->
        <p>
           <label for="date">Booking Date</label>
           <input type="date" id="date" name="date" required value="<?php echo $date;?>"/>
        </p>
        <!-- time input box-->
        <p>
           <label for="time">Booking Time</label>
           <input type="time" id="time" name="time" required value="<?php echo $time;?>"/>
        </p>
        <!-- dancer input box-->
        <p>
            <label for="Dancing-Queens">Dancers Selection</label>
            <select id="dancers" name="dancers" required value="<?php echo $dancers;?>">
                <option value="" disabled selected>Select Dancers</option>
                <option value="sage">Sage</option>
                <option value="Ruby">Ruby</option>
                <option value="Yenta">Yenta</option>
                <option value="Sage & Yenta">Sage & Yenta</option>
                <option value="Sage & Ruby">Sage & Ruby</option>
                <option value="Yenta & Ruby">Yenta & Ruby</option>
                <option value="Yenta, Sage & Ruby">Yenta, Sage & Ruby</option>
            </select>
            <span id="error-message" style="color: red; display: none;">Please select a valid option.</span>
        </p>
        
          <input type="submit" id="button" value="Create Booking" />
          <p><?php 
        if(!empty($out_value)){
        echo $out_value;
        }
        ?></p>
      </form>
  </div>
 <?php
  
        // import vars for server connection and connect to sql
        include 'config.php';

        // If the user enters those values, post it to the server. HTMl ensures that fields aren't left blank
        // ($_SERVER["REQUEST_METHOD"] and $_POST are parts of the PHP language.)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $out_value = "";
            $date = $_POST["date"];
            $time = $_POST["time"];
            $dancers = $_POST["dancers"];
            $username = $_SESSION['username'];  // Assuming 'username' is stored in session
            
            // Prepare SQL query with the data to post the database.
            $sql_query = "INSERT INTO bookings (b_username, b_date, b_time, b_dancers) VALUES ('$username', '$date', '$time', '$dancers')";
       
            // Send the query to the database and check if it was successful
            if (mysqli_query($conn, $sql_query)) {
                $out_value = "Successfully booked!";
            } else {
                $out_value = "Error: " . mysqli_error($conn);  // Display error if query fails
            }
        }
        $conn->close();
        ?>
  <!-- Create text boxes for user to input booking date, time, and dancer/s selection. -->

 </body>
 </html>   