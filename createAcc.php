<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dancing Queens</title>
    <meta name = "description" content="Create an account for Dancing Queens">

    <link rel="stylesheet" href="stylesheet.css">
  </head> 
  <body>
     <div id="form">
      <h1>CREATE ACCOUNT</h1>
      <form name="form" action="" method="POST">
        <p>
          <label> New Username: </label>
          <input type="text" id="user" name="userid"/>
        </p>

        <p>
          <label> New Password: </label>
          <input type="password" id="pass1" name="password1" />
        </p>
        <p>
          <label>Confirm New Password: </label>
          <input type="password" id="pass2" name="password2" />
        </p>

        <p>
          <input type="submit" id="button" value="Create Account" />
        </p>
      </form>
    </div>

    <?php
    include 'config.php';
    $userid = $_POST['userid'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    if ($password1 !== $password2) {
      echo "Passwords do not match!";
      exit(); 
  }
    $password = password_hash($password1, PASSWORD_DEFAULT);


    // Use placeholders ? for username and password values for the time being.
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $userid, $password);

    
   if (mysqli_stmt_execute($stmt)) {
      echo "Account Created Successfully";
    } else {
      echo "Failure Creating Account";
    }

    ?>


  </body>

  </html>