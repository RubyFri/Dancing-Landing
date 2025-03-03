<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dancing Queens</title>
    <meta name = "description" content="Log in to account for Dancing Queens">

    <link rel="stylesheet" href="stylesheet.css">
  </head>
  <body>
  <div id="form">
      <h1>LOG IN</h1>
      <form name="form" action="" method="POST">
        <p>
          <label>Username: </label>
          <input type="text" id="user" name="userid"/>
        </p>

        <p>
          <label>Password: </label>
          <input type="password" id="pass" name="password" />
        </p>
        <p>
        <p>
          <input type="submit" id="button" value="Log In" />
        </p>
      </form>
    </div>
    <?php
    include 'config.php';
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$userid' AND password = '$password'";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
    $num = mysqli_fetch_array($result);
    
    if($num > 0) {
     echo "Login Success";
    }
    else {
     echo "Wrong User id or password";
    }

  ?>
  </body>

  </html>