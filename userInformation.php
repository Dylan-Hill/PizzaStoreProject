<?php 
/* 
    User info page
    Start by checking db for existing user. If user doesn't exist, display form allowing user info to be entered.
    Make all fields madatory and include validation 
*/

session_start();

// handle the pizza form data that was submitted in the last page: orderPizza.php

// Greeting 
echo "Welcome " . $_SESSION['loggedUser'];


//Returns $pizzaObject Declared and Initialized
function gatherPizzaInfo(){
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
        $toppings = json_encode($_POST['toppings']);

        // put the json toppings array into the session variable  
        $_SESSION['toppings'] = $toppings; //fixed error 
        
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
}

//Returns $pizzaObj Ready to go to db
$pizzaObj = gatherPizzaInfo();
    

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

global $conn;

// after the info form is submitted => handle the data, place it in Session superglobal 
function gatherCustomerInfo(){
    if (isset($_POST['submitInfo'])){

        echo "We're even more almost done " . $_SESSION['loggedUser'];
        
        // We do this later more safely.
        $_SESSION['name'] = $_POST['name'];
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
}
// run function just created.
// gatherCustomerInfo();


// form inputs need validation. Just like the rest of us.
// MAY NEED 2 VERSIONS with customer email || without email if they are not new user???? idk
// AFTER VALIDATING FIELDS => push the customers order into the db
function insertCustomer(){

    include './common.php';

    GLOBAL $conn;
    // run validation before getting to SQL
    //  run validation if the customer info form has been filled out
    if (isset($_POST['submitInfo']))
    {
        // Name validation 
        // if name is not in the post[], let the user know
        if (!isset($_POST['name']))
        {
            echo "Name field not defined. </br>";
        }
        // else if there is a name, trim + clean the string
        else if (isset($_POST['name']))
        {
            $name = trim($_POST['name']);
            $SESSION['name'] = htmlentities($name);
            
            // if empty after data trim let the user know he's not that slick 
            if (empty($_POST['name']))
            {
                echo "The first name field is empty.</br>";
            }
            // name can't be longer than the db length which is (255) so were safe with 
            else
            {
                if (strlen($_POST['name']) > 50)
                {
                    echo "The first name field contains too many characters. </br>";
                }
            }
        }
    
        // address validation
        if (!isset($_POST['address']))
        {
            echo "Addess field not defined.</br>";
        }
        else if (isset($_POST['address']))
        {
            $address = trim($_POST['address']);
            $_SESSION['address'] = htmlentities($address);
            if (empty($_POST['address']))
            {
                echo "The Adress field is empty.</br>";
            }
            else
            {
                if (strlen($_POST['address']) > 50)
                {
                    echo "The Address field contains too many characters.</br>";
                }
            }
        }
    
        // city validation
        if (!isset($_POST['city']))
        {
            echo "City field not defined.</br>";
        }
        else if (isset($_POST['city']))
        {
            $city = trim($_POST['city']);
            $_SESSION['city'] = htmlentities($city);
            if (empty($city))
            {
                echo "The city field is empty.";
            }
            else if (strlen($_POST['city']) > 45)
            {
                echo "The city field contains too many characters. </br>";
            }
        }
    
        // province validation
        if (!isset($_POST['province']))
        {
            echo "Province field not defined. </br>";
        }
        else if (isset($_POST['province']))
        {
            $province = trim($_POST['province']);
            $_SESSION['province'] = htmlentities($province);
            if (empty($_POST['province']))
            {
                echo "The province field is empty. </br>";
            }
            else
            {
                if (strlen($_POST['province']) > 20)
                {
                    echo "The province field contains too many characters. </br>";
                }
            }
        }
        // Postal Code validation
        if (!isset($_POST['postalCode']))
        {
            echo "Postal Code field not defined. </br>";
        }
        else if (isset($_POST['postalCode']))
        {
            $postalCode = trim($_POST['postalCode']);
            $_SESSION['postalCode'] = htmlentities($postalCode);
            if (empty($_POST['postalCode']))
            {
                echo "The Postal Code field is empty. </br>";
            }
            else
            {
                if (strlen($_POST['postalCode']) > 7)
                {
                    echo "The Postal Code field contains too many characters. </br>";
                }
            }
        }
        echo"Session Ready for sql? ";   
        var_dump($_SESSION);

        // for ease of use . Data in session is already cleaned.
        $email = htmlentities($_SESSION['loggedUser']);
        $address = $_SESSION['address'];
        $province = $_SESSION['province'];
        $postalCode = $_SESSION['postalCode'];
        // $phone = $_SESSION['phone'];
        $city = $_SESSION['city'];

    // SQL
     // final check if variables are within length constraints & Also Not Null
     if (
     $name != null
     && $address != null 
     && $city != null 
     && $province != null 
     && $postalCode != null 
     && strlen($name) <= 50 
     && strlen($address) <= 50 
     && strlen($city) <= 55 
     && strlen($postalCode) < 8
     ){
        

         // attempt to insert sql if passes checks
         try
         { 
             
             // Sql insert customer info statement
             $sql = 'INSERT INTO customers (cust_name, cust_email, cust_address, province, city, postal ) VALUES (:name, :email, :address, :province, :city, :postal);';
 
             // prepare  // $conn is NULL??
             $stmt = $conn->prepare($sql);
 
             // execute
             $stmt->execute(
                [
                 ":name" => $name,   
                 ":email" => $email, 
                 ":address" => $address, 
                 ":province" => $province,
                 ":city" => $city,
                 ":postal" => $postalCode
                ]
            );
 
             // success?
             if ($stmt)
             {
                echo "Successfully inserted cust info";
             }
             else if (!$stmt)
             {
                 echo "Failed inserting cust info.";
             }
 
         }
         catch(PDOException $e)
         {
             $message = $e->getMessage();
             echo "Error:" . $message;
             $return = "Fail message: " . $e->getMessage();
         }
     }
    }
}
insertCustomer();

function sendPizzaInfoToDb(){
    global $conn;
     // attempt to insert sql if passes checks
         try
         { 
             // Sql insert customer info statement
             $sql = 'INSERT INTO pizza (dough, cheese, sauce, toppings) VALUES (:dough, :cheese, :sauce, :toppings);';
 
             // prepare  // $conn is NULL??
             $stmt = $conn->prepare($sql);
 
             // execute
             $stmt->execute(
                [
                 ":dough" => $_SESSION['dough'],   
                 ":cheese" => $_SESSION['cheese'], 
                 ":sauce" => $_SESSION['sauce'], 
                 ":toppings" => $_SESSION['toppings'],
                ]
            );
 
             // success?
             if ($stmt)
             {
                echo "Successfully inserted pizza info";
             }
             else if (!$stmt)
             {
                 echo "Failed inserting pizza info.";
             }
 
         }
         catch(PDOException $e)
         {
             $message = $e->getMessage();
             echo "Error:" . $message;
             $return = "Fail message: " . $e->getMessage();
         }
}

//Sends Pizza Db Object To Db
sendPizzaInfoToDb();

?>


</body>
</html>