<?php
      session_start();

    include 'common.php';
    if(isset($_POST['emailInput'])) {
$_SESSION["loggedUser"] = dbConnect();
    }else {
      
    }

    // Set session variables
?>


<!DOCTYPE html>
<html>
<head>
    <title>Order Now!</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="./css/styles.css" rel="stylesheet"/>
    </head>


<body>
        <!-- Nav Menu -->
        <?php 
        echo showNavBar($_SESSION["loggedUser"]);
         ?>

<div id="formInput">
<form action="orderpizza.php" method="post">

<!-- Choose Dough -->
<h3>Choose Dough: </h3><br>
<input type="radio" id="male" name="doughType" value="male">
  <label for="male">Dough #1</label><br>
<input type="radio" id="female" name="doughType" value="female">
  <label for="female">Dough #2</label><br>
<input type="radio" id="other" name="doughType" value="other">
  <label for="other">Dough #3</label>

<!-- Choose Sauce -->
<h3>Choose Sauce: </h3><br>
<input type="radio" id="normal" name="sauceType" value="normal">
  <label for="normal">Normal</label><br>
<input type="radio" id="bbq" name="sauceType" value="BBQ">
  <label for="bbq">BBQ</label><br>
<input type="radio" id="alfredo" name="sauceType" value="alfredo">
  <label for="female">Alfredo</label><br>
<input type="radio" id="ranch" name="sauceType" value="ranch">
  <label for="other">Ranch</label>

  <!-- Choose Toppings -->
<h3>Choose Toppings: </h3><br>
<input type="checkbox" name="toppings" value="Tomato"> Tomato
<input type="checkbox" name="toppings" value="Onions"> Onions 
<input type="checkbox" name="toppings" value="Peperoni"> Pepperoni
<input type="checkbox" name="toppings" value="Ham"> Ham
<input type="checkbox" name="toppings" value="Bacon"> Bacon

<!-- Choose Cheese Type -->
<h3>Choose Cheese Type: </h3><br>

<select name="cars" id="cars">
  <option value="Mozarella">Mozarella</option>
  <option value="Cheddar">Saab</option>
  <option value="">Mercedes</option>
</select> 


<input type="submit" value="Add to Cart">

</form>
</div>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
