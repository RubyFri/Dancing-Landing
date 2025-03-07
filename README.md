# Dancing-Landing
SWE HW2 Web App 

Team: Ruby, Yenta, Sage

This is a demo web app for Software Engineering.

In order to run this app, download and set up XAMPP, place all files into the htdocs folder (replacing the files there by default), and navigate to localhost:8080/phpmyadmin in your browser. In PHPMyAdmin, create a new database named app-db, and enter the SQL tab.

Once you have a query window, input the following two queries to create the necessary tables:
```
CREATE TABLE users(
	username VARCHAR(255) PRIMARY KEY,
	password VARCHAR(255));

CREATE TABLE bookings (
    b_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    b_username VARCHAR(255),
    b_date DATE,
    b_time TIME,
    b_dancers VARCHAR(18),
    FOREIGN KEY (b_username) REFERENCES users(username) 
);
```
Finally, navigate to localhost:8080/index.html#home and enjoy!

Work done was split evenly among all three group members (33.3/33.3/33.3)
 
