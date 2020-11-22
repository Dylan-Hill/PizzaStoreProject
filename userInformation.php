<?php 
/* 
    User info page
    Start by checking db for existing user. If user doesn't exist, display form allowing user info to be entered.
    Make all fields madatory and include validation 
*/

session_start();
include 'common.php';

// handle the pizza form data that was submitted in the last page: orderPizza.php

// Greeting 
echo "Welcome " . $_SESSION['username'];

if (isset($_POST['submitPizza'])){
    // TODO
    // if email wasnt in the db. User needs to enter Email
    // if NEW user (not in DB): fill out form + enter email | if  $_SESSION['username'] isnt in the db rows in $query "customers.cust_email"
    // Else If EXISTING DB user: skip the email | Auto complete forms for user with DB values?

    // add the pizza form values into session variable
    $_SESSION['dough'] = $_POST['dough'];
    $_SESSION['sauce'] = $_POST['sauce'];
    $_SESSION['cheese'] = $_POST['cheese'];
    $_SESSION['toppings'] = $_POST['toppings'];

    // Add some Pizzas to the session variable, this doesnt go to the database? 
    $_SESSION['pizzaCounter'] = (int)$_POST['addPizza']; // this doesn't add up 
    
    // new json formatted toppings array to insert in db.  
    $toppings = json_encode($_POST[toppings]);

    // put the json toppings array into the session variable  
    $_SESSION['toppings'] = $toppings; // this outputs an error. doesnt like how i handled the array[] prob needs another brackets[] somewhere 
    
    // debugging
    // echo "Post: \n";
    // var_dump($_POST);
    // echo "Session: \n";
    // var_dump($_SESSION);
    
    // $session after orderPizza:
    // username 
    // dough 
    // sauce 
    // cheese 
    // toppings 
    // pizza counter 

} 

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
<form method="POST" action="./userInformation.php"> 

<!-- NEEDS VALIDATION --> 
   <!-- Name -->
<label for="name">Name:</label>
<input type="text" placeholder="John Doe" size="20" id="name" name="name"></input>
</br>

<!-- Address -->
<label for="address">Address: </label>
<input type="text"  placeholder="123 Main St" id="address" name="address"></input>
</br>

<!-- City -->
<label for="city">City: </label>
<input type="text" placeholder="Toronto" size="25" id="city" name="city"></input>
</br>
<!-- Province -->
<label for="province">Province</label>
<input type="text" placeholder="Ontario" size="20" id="province" name="province"></input>
</br>

<!-- Postal Code -->
<label for="postalCode">Postal Code</label>
<input type="text" placeholder="N0A 1M0" size="20" id="postalCode" name="postalCode"></input>
</br></br>

<!-- Submit -->
<input type="submit" value="Submit" name="submitInfo">

</form>

<?php 
// after the info form is submitted => handle the data, place it in Session superglobal 
if (isset($_POST['submitInfo'])){

    echo "We're even more almost done " . $_SESSION['username'];
    
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['province'] = $_POST['province'];
    $_SESSION['postalCode'] = $_POST['postalCode'];

    // debugging
    echo "Post: \n";
    var_dump($_POST);
    echo "Session: \n";
    var_dump($_SESSION);

    // session after userInfo
    // username
    // dough 
    // sauce 
    // cheese 
    // toppings 
    // pizzaCounter
    // TODO if email wasnt in the db. User needs to enter Email  
    // name
    // address
    // city 
    // province 
    // postalCode
} 
?>


</body>
</html>

?>