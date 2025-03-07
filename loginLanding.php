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
        <li><a href="index.php">Home Page</a></li>
        <li><a href="MeetDancers.php">Meet the Dancers</a></li>
        </ul>
    </div>
    <?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h2>Welcome, $username</h2>";
    echo '<div class="options">
    <a href="createBooking.php" class="option-card">
        <h3>Create Booking</h3>
    </a>
    <a href="deleteBooking.php" class="option-card">
        <h3>Delete Booking</h3>
    </a>
    <a href="changeBooking.php" class="option-card">
        <h3>Modify Booking</h3>
    </a>
    <a href="logout.php" class="option-card">
        <h3>Log Out</h3>
    </a>
  </div>';
} else {
    echo "<h2>Please log in</h2>";
    exit;
}

include 'config.php';

// SQL query to fetch all bookings
$query = "SELECT * FROM bookings";
$stmt = $db->prepare($query);

if (!$stmt) {
    // Query preparation failed, display the error
    die("Error preparing the query: " . $db->error);
}

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result) {
    // Check if there are bookings
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

        // Loop through and output the bookings
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['b_id']) . "</td>
                    <td>" . htmlspecialchars($row['b_date']) . "</td>
                    <td>" . htmlspecialchars($row['b_time']) . "</td>
                    <td>" . htmlspecialchars($row['b_dancers']) . "</td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No bookings found.</p>";
    }
} else {
    // If there was an error in the result, show the error
    echo "<p>Error fetching data: " . $db->error . "</p>";
}

// Close the statement and connection
$stmt->close();
$db->close();
?>


</body>
</html>
