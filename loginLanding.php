<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dancing Queens</title>
    <meta name = "description" content="Page for when the user is logged in">

    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
  <div id="navbar" class="navbar">
        <ul>
          <li><a href="createBooking.php">Create Booking</a></li>
          <li><a href="deleteBooking.php">Delete Booking</a></li>
        </ul>
    </div>

    <?php
    session_start();
    // not sure if tehre might be a case where this is not the case. 
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<h2>Welcome, $username</h2>"; // Display welcome message
    } else {
        echo "<h2>Please log in</h2>";
        exit;
    }
    include 'config.php';
    // sql query to the bookings table
    $query = "SELECT * FROM bookings"
    // Prepare and execute the query
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $current_date); // Bind the current date parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any bookings to display
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer Name</th>
                        <th>Booking Date</th>
                        <th>Additional Info</th>
                    </tr>
                </thead>
                <tbody>";

        // Loop through the result and display each booking
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['booking_id']) . "</td>
                    <td>" . htmlspecialchars($row['customer_name']) . "</td>
                    <td>" . htmlspecialchars($row['b_date']) . "</td>
                    <td>" . htmlspecialchars($row['additional_info']) . "</td>
                </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No bookings found.</p>";
    }

    // Close the database connection
    $stmt->close();
    $db->close();
    ?>

  </body>
</html>

    