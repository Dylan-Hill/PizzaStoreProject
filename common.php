<?php

// create db constants
define("servername", "localhost");
define("username", "project_user");
define("password", "Windows1");
define("database", "pizza_store");

GLOBAL $email;

global $conn;
// connect to db with PDO
// use try/catch for error handling
try {
    $conn = new PDO("mysql:host=" . servername . ";dbname=" . database . ";charset=utf8", username, password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// 
// if (isset($_POST['emailInput']) && !isset($_SESSION['emailInput'])) { 
//     $_SESSION['emailInput'] = $_POST['emailInput'];
// }

function assignUser() {
    global $conn, $email;
    
    $email = $_SESSION['emailInput'];
    
    $sqlSel = "SELECT cust_email FROM customers WHERE (cust_email = " . "'" . $email . "'" . ");";
    // $sqlIn = "INSERT INTO customers (cust_email, cust_name, cust_address, province, city, postal) VALUES (" . "'" . $_SESSION['emailInput'] . "'" . ", ''" . ", ''" . ", ''" . ", ''" . ", ''" . ");";
    $signedUser = [];

    $result = $conn->query($sqlSel);
    if ($result->rowCount($sqlSel) == 0) {
        echo "New Customer Created but not added to Database...";
        // Do not add to db yet until we have figured out how to store evrything with php arrays/objects
        // $conn->query($sqlIn);
        // echo "Customer account created.";
    } elseif ($result->rowCount($sqlSel) == 1) {
        // echo "Welcome Back";
    }


    $emailArr = str_split($email);

    // what is this doing? 
    // Line 41 and 44 are causing our site to crash 
    // for ($i = 0;) {
    //     if ($emailArr[$i] !== '@') {

    //         // adding letter to string
    //         array_push($signedUser, (string) $emailArr[$i]);
    //         $i ++;
    //     } else {
    //         break;
    //     }
    // }
    $emailArr = $signedUser;

    $signedUser = "";
    $signedUser = implode($emailArr);

    return $signedUser;
} // end of assignUser()

// on initial login with email: run above function 
// if (isset($_POST['emailInput'])) {
//     assignUser();
// }

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
    

// if 1st login page with email gets submitted: 
// - The email used is used in assignUser() 
// - showNavBar()
if (isset($_POST['emailInput'])) {
    GLOBAL $email;
    $email = $_POST['emailInput'];
    $_SESSION["emailInput"] =  $_POST['emailInput'];
    $_SESSION["loggedUser"] = assignUser();
    showNavBar( $_SESSION["loggedUser"]);
}


// 1st form - pizza info  - form info from POST -> SESSION to use across pages.
//Returns $pizzaObject Declared and Initialized
function gatherPizzaInfo(){
    
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
if (isset($_POST['submitPizza'])){
    gatherPizzaInfo();
}

// 1st form - pizza SESSION -> Database 
// sql insert session variables 
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
if (isset($_POST['submitPizza'])){
    sendPizzaInfoToDb();
}
//Returns $pizzaObj Ready to go to db
// $pizzaObj = gatherPizzaInfo();
// end of pizza info to db. -> Next is taking care of user info into db.

// 2nd Form - user info - on submit:
// form inputs need validation. Just like the rest of us.
// MAY NEED 2 VERSIONS with customer email || without email if they are not new user???? idk
// AFTER VALIDATING FIELDS => push the customers order into the db
function insertCustomer(){
    GLOBAL $conn;
    // debugging
    echo "insertcustomer(): post + session\n";
    var_dump($_POST);
    var_dump($_SESSION);
    
    // clean name and place in session 
    $name = trim($_POST['name']);
    $_SESSION['cust_name'] = htmlentities($name);

    // clean address and place in session
    $address = trim($_POST['address']);
    $_SESSION['address'] = htmlentities($address);

    // address
    $city = trim($_POST['city']);
    $_SESSION['city'] = htmlentities($city);

    // province 
    $province = trim($_POST['province']);
    $_SESSION['province'] = htmlentities($province);

    // postalCode
    $postalCode = trim($_POST['postalCode']);
    $_SESSION['postalCode'] = htmlentities($postalCode);
    
    $address = $_SESSION['address'];
    $province = $_SESSION['province'];
    $postalCode = $_SESSION['postalCode'];
    // $phone = $_SESSION['phone'];
    $city = $_SESSION['city'];
    
    $email = $_SESSION['emailInput'];
    
    // SQL
     // final check if variables are within length constraints & Also Not Null

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
                echo "Successfully inserted Customer info. \n";
                insertOrder();
             }
             else if (!$stmt)
             {
                 echo "Failed inserting Customer info. \n";
             }
 
         }
         catch(PDOException $e)
         {
             $message = $e->getMessage();
             echo "Error:" . $message;
             $return = "Fail message: " . $e->getMessage();
         }
} // end of insertCustomer()

// if userInformation form is filled out: insert it by running the function above   
if (isset($_POST['submitInfo'])){
    insertCustomer();
}

// session_destroy();

// after submitting pizza form -> show navbar() on user info page 
if (isset($_POST['submitPizza'])) {
    // $_SESSION["loggedUser"] = $_POST['emailInput'];
    $_SESSION["loggedUser"] = assignUser();
    showNavBar( $_SESSION["loggedUser"]);
}


// insert order - orderSummary.php  
// after pizza is in db, insert order table info 
// After Pizza & Order are in db => pizzaOrders is filled with its foreign key info
// orderSummary.php will use the pizzaOrder data from db
function insertOrder(){
    global $conn;

    // debugging 
    var_dump($_POST); 
    var_dump($_SESSION); 

    // FIXME
    // when inserting into order table: 
    // on insertion orders.employeeID == NULL. 
    // Regardless if i push it as NULL on purpose so it picks up the relationship so im kinda confused. 
    
    // Cheat Fix: Do we change the Type on orders.employeeID from INT to Varchar and manually insert $_SESSION['emailInput'] AKA user email? 
    
    // Or keep it as an int and figure out the relationship. 
    // Steps: 1.) Pizza gets pushed. 2.) Customer gets pushed. 
    //  3.) ORDER "SHOULD" HAVE access to email / customerID from the foreign key relationship by this step, 
    // but when you insert the order: date is good. but employeeID == NULL  

    // FIX $name insertion. Problem with DB relationship? idk 
    // $name = "";
    // $name = $_SESSION['inputEmail'];

     // attempt to insert sql if passes checks
         try
         {
            // when inserting the FK_cust_id: 
            // the INT id NEEDS to be the last integer that was insered into the db. 
            // So we make a variable that changes to fit that FK_cust_id_insert on each run. 
            $sql = "SELECT COUNT(cust_id) FROM customers";
            
            $res = $conn->query($sql);
            
            // $count returns the total number of cust_id's in the db.
            // Sometimes that total # WONT = the last cust_id entered tho. Will need a more specific approach to snagging that id # 
            $count = $res->fetchColumn();
            echo "rows in cust_id = ".  $count . "<br>";


            //$custEmail =  $_SESSION['emailInput'];
            // echo $custEmail;
            // Sql insert orders info - Date
            $sql = "INSERT INTO orders (fk_cust_id, order_date) 
                    VALUES($count, :date);";
            
            $stmt = $conn->prepare($sql);
 
             // execute
             $stmt->execute(
                [
                    // "custEmail" => $custEmail, //  (SELECT cust_email FROM customers WHERE cust_email = WHERE cust_email = :custEmail LIMIT 1),
                    ":date" => date('Y-m-d H:i:s'),
                ]   
             );
 
             // success?
             if ($stmt)
             {
                echo "Successfully inserted Order info \n";
                
             }
             else if (!$stmt)
             {
                 echo "Failed inserting Order info. \n";
             }
 
         }
         catch(PDOException $e)
         {
             $message = $e->getMessage();
             echo "Error:" . $message;
             $return = "Fail message: " . $e->getMessage();
         }
} // end of insertOrder() 
// insert orderId + customer email into db after sending user Information form
// if (isset($_SESSION['name'])){
//     insertOrder();
// }

// BOTTOM OF USEFUL FUNCTIONS 
// TO DO - VALIDATION - WAS combined with user info . Seperating it
   // run validation before getting to SQL
    //  run validation if the customer info form has been filled out
    // if (isset($_POST['submitInfo']))
    // {
    //     var_dump($_POST);
    //     // Name validation 
    //     // if name is not in the post[], let the user know
    //     if (!isset($_POST['name']))
    //     {
    //         echo "Name field not defined. </br>";
    //     }
    //     // else if there is a name, trim + clean the string
    //     else if (isset($_POST['name']))
    //     {
    //         $name = trim($_POST['name']);
    //         $SESSION['cust_name'] = htmlentities($name);
    //     }
    //         // if empty after data trim let the user know he's not that slick 
    //         if (empty($_POST['name']))
    //         {
    //             echo "The first name field is empty.</br>";
    //         }
    //         // name can't be longer than the db length which is (255) so were safe with 
    //         else
    //         {
    //             if (strlen($_POST['name']) > 50)
    //             {
    //                 echo "The first name field contains too many characters. </br>";
    //             }
    //         }
        
    
    //     // address validation
    //     if (!isset($_POST['address']))
    //     {
    //         echo "Addess field not defined.</br>";
    //     }
    //     else if (isset($_POST['address']))
    //     {
    //         $address = trim($_POST['address']);
    //         $_SESSION['address'] = htmlentities($address);
    //         if (empty($_POST['address']))
    //         {
    //             echo "The Adress field is empty.</br>";
    //         }
    //         else
    //         {
    //             if (strlen($_POST['address']) > 50)
    //             {
    //                 echo "The Address field contains too many characters.</br>";
    //             }
    //         }
    //     }
    
    //     // city validation
    //     if (!isset($_POST['city']))
    //     {
    //         echo "City field not defined.</br>";
    //     }
    //     else if (isset($_POST['city']))
    //     {
    //         $city = trim($_POST['city']);
    //         $_SESSION['city'] = htmlentities($city);
    //         if (empty($city))
    //         {
    //             echo "The city field is empty.";
    //         }
    //         else if (strlen($_POST['city']) > 45)
    //         {
    //             echo "The city field contains too many characters. </br>";
    //         }
    //     }
    
    //     // province validation
    //     if (!isset($_POST['province']))
    //     {
    //         echo "Province field not defined. </br>";
    //     }
    //     else if (isset($_POST['province']))
    //     {
    //         $province = trim($_POST['province']);
    //         $_SESSION['province'] = htmlentities($province);
    //         if (empty($_POST['province']))
    //         {
    //             echo "The province field is empty. </br>";
    //         }
    //         else
    //         {
    //             if (strlen($_POST['province']) > 20)
    //             {
    //                 echo "The province field contains too many characters. </br>";
    //             }
    //         }
    //     }
    //     // Postal Code validation
    //     if (!isset($_POST['postalCode']))
    //     {
    //         echo "Postal Code field not defined. </br>";
    //     }
    //     else if (isset($_POST['postalCode']))
    //     {
    //         $postalCode = trim($_POST['postalCode']);
    //         $_SESSION['postalCode'] = htmlentities($postalCode);
    //         if (empty($_POST['postalCode']))
    //         {
    //             echo "The Postal Code field is empty. </br>";
    //         }
    //         else
    //         {
    //             if (strlen($_POST['postalCode']) > 7)
    //             {
    //                 echo "The Postal Code field contains too many characters. </br>";
    //             }
    //         }
    //     }
        

?>
