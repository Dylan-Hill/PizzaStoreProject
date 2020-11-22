<?php

// create db constants
define("servername", "localhost");
define("username", "project_user");
define("password", "Windows1");
define("database", "pizza_store");

// connect to db with PDO
// use try/catch for error handling
try {
    $conn = new PDO("mysql:host=" . servername . ";dbname=" . database . ";charset=utf8", username, password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function assignUser()
{
    global $conn;
    $email = $_POST['emailInput'];
    $sqlSel = "SELECT cust_email FROM customers WHERE (cust_email = " . "'" . $email . "'" . ");";
    $sqlIn = "INSERT INTO customers (cust_email, cust_address, province, city, postal) VALUES (" . "'" . $email . "'" . ", ''" . ", ''" . ", ''" . ", ''" . ");";
    $signedUser = [];

    $result = $conn->query($sqlSel);
    if ($result->rowCount($sqlSel) == 0) {
        $conn->query($sqlIn);
        // echo "Customer account created.";
    } elseif ($result->rowCount($sqlSel) == 1) {
        // echo "Welcome Back";
    }

    $emailArr = str_split($email);

    for ($i = 0;;) {
        if ($emailArr[$i] !== '@') {

            // adding letter to string
            array_push($signedUser, (string) $emailArr[$i]);
            $i ++;
        } else {
            break;
        }
    }
    $emailArr = $signedUser;

    $signedUser = "";
    $signedUser = implode($emailArr);

    return $signedUser;
}

function showNavBar($xin)
{
    $toDisplay = "<nav class='navbar navbar-inverse'>
  <div class='container-fluid'>
    <ul class='nav navbar-nav'>
    	<li><a><h3>$xin</h3></a></li>
    	<li><a href='orderpizza.php'><h3>Order Now</h3></a></li>
      <li><a href='userInformation.php'><h3>My Account</h3></a></li>
    </ul></div></nav>";
    echo $toDisplay;
}

function endSession()
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
}
?>
