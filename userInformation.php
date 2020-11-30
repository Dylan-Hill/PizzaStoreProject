<?php 
/* 
    User info page
    Start by checking db for existing user. If user doesn't exist, display form allowing user info to be entered.
    Make all fields madatory and include validation 
*/
session_start();
include './common.php';

// handle the pizza form data that was submitted in the last page: orderPizza.php
// Greeting 
echo "Welcome " . $_SESSION['loggedUser'] . "\n";

?>

<!DOCTYPE html>
<html>
<head>
<title>Order Now!</title>
<style>
    body {
        background:grey;
    }
    p {
        text-align: center;
        padding-top: 50vh;
        font-size: 30px;        
    }
</style>
<link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
    crossorigin="anonymous">
</head>


<body>
<form method="POST" action="./orderSummary.php">

<!-- NEEDS VALIDATION --> 
   <!-- Name -->
   <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userName'];};?>
<label for="name">Name:</label>
<input type="text" placeholder="John Doe" size="20" id="name" name="name" <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userName'];};?>></input>
</br>

<!-- Address -->
<label for="address">Address: </label>
<input type="text"  placeholder="123 Main St" id="address" name="address" <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userAddress'];};?>></input>

</br>

<!-- City -->
<label for="city">City: </label>
<input type="text" placeholder="Toronto" size="25" id="city" name="city" <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userCity'];};?>></input>
</br>
<!-- Province -->
<label for="province">Province</label>
<input type="text" placeholder="Ontario" size="20" id="province" name="province" <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userProvince'];};?>></input>
</br>

<!-- Postal Code -->
<label for="postalCode">Postal Code</label>
<input type="text" placeholder="N0A 1M0" size="20" id="postalCode" name="postalCode" <?php if($_SESSION['existingUser'] == true){echo "value=".$_SESSION['userPostal'];};?>></input>
</br></br>

<!-- Submit -->
<input type="submit" value="Submit" name="submitInfo">

</form>

</body>
</html>
