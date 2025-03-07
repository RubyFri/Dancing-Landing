<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dancing Queens</title>
    <meta name = "description" content="Modify a booking with Dancing Queens">

    <link rel="stylesheet" href="stylesheet.css">
  </head> 

  <body>
    <!-- The ID input form-->
    <div id="form">
      <h1>Change Booking</h1>
      <form name="form" action="" method="POST">
        <p>
          <label> Booking ID: </label>
          <input type="number" id="id" name="id" require/>
        </p>
        <p>
           <label for="date">Booking Date</label>
           <input type="date" id="date" name="date" required value="<?php echo $date;?>"/>
        </p>
        <!-- time input box-->
        <p>
           <label for="time">Booking Time: </label>
           <input type="time" id="time" name="time" required value="<?php echo $time;?>"/>
        </p>
        <!-- dancer input box-->
        <p>
            <label for="Dancing-Queens">Dancers Selection: </label>
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
          <p><?php if(!empty($out_value)){echo $out_value;}?></p>
        </form>
        </p>
      </form>
    </div>

    <?php
        // Starts the session and gathers appropriate variables
        session_start()
        $username = $_SESSION['username']
        $id = $_POST['id']
        $date = $_POST["date"];
        $time = $_POST["time"];
        $dancers = $_POST["dancers"];

        // Checks whether the booking is valid
        $check_sql_id = "SELECT * FROM bookings WHERE b_id = ? AND b_username = ?";
        $check_stmt_id = mysqli_prepare($conn, $check_sql_id);
        mysqli_stmt_bind_param($check_stmt_id, "is", $id, $username);
        mysqli_stmt_execute($check_stmt_id);
        mysqli_stmt_store_result($check_stmt_id);
        if (mysqli_stmt_num_rows($check_stmt_id) == 0) {
            echo "Booking not found. It was either made under a different username or not at all. Please check your bookings for further information.";
            exit();
        }
        else {
            $sql = "UPDATE bookings
            SET b_date = $date, b_time = $time, b_dancers = $dancers
            WHERE b_id = $id AND b_username = $username";
            $stmt = mysqli_prepare($conn, $sql);
            if (mysqli_stmt_execute($stmt)) {
                echo "Booking altered!";
                exit();
            }
            else {
                echo "Booking could not be altered. Please try again.";
                exit();
            }
        }
    ?>

  </body>
</html>