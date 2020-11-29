<!-- Just copied orderPizza.php may not be proper orderSummary page yet -->
<!-- OrderSummary.php: 
    - Display pizza order summary. 
    - Data comes from DB
    - Based on current user & order => $_session['name'] , $_session['orderid']  ? 
    - Display: Email + Pizza information 
        + "Your Pizza will be delivered in 40 minutes and delivered to <cust_address>"
-->

<?php
session_start();

include './common.php';
// echo" <br> Session Contains :";   
// var_dump($_SESSION);

?>


<!DOCTYPE html>
<html>
<head>
  <title>Order Summary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="./css/styles.css" rel="stylesheet"/>
</head>

<body> 
    <div id="container">
        <div id="orderSummary">
            <h1>Order Summary</h1>
            
            <!--Order output goes Here -->

        </div>
    </div>

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
<?php 
endSession();
?>
