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

// global $conn;

// Used for Debugging - Prototype f() 
// after the info form is submitted => handle the data, place it in Session superglobal 
// function gatherCustomerInfo(){
//     if (isset($_POST['submitInfo'])){

//         echo "We're even more almost done " . $_SESSION['loggedUser'];
        
//         // We do this later more safely.
//         $_SESSION['name'] = $_POST['name'];
//         $_SESSION['address'] = $_POST['address'];
//         $_SESSION['city'] = $_POST['city'];
//         $_SESSION['province'] = $_POST['province'];
//         $_SESSION['postalCode'] = $_POST['postalCode'];

//         // debugging
//         echo "Post: \n";
//         var_dump($_POST);
//         echo "Session: \n";
//         var_dump($_SESSION);

//         // session after userInfo
//         // username
//         // dough 
//         // sauce 
//         // cheese 
//         // toppings 
//         // pizzaCounter
//         // TODO if email wasnt in the db. User needs to enter Email  
//         // name
//         // address
//         // city 
//         // province 
//         // postalCode
//     } 
// }
// run function just created.
// gatherCustomerInfo();




?>


</body>
</html>