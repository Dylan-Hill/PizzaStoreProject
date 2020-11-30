<?php
session_start();
include './common.php';
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
    <div id="formInput">
    <form action="userInformation.php" method="post">
    
    <!-- Choose Dough -->
    <h3>Choose Dough: </h3><br>
    <input type="radio" id="male" name="dough" value="Regular">
      <label for="male">Regular</label>
      <br>
    <input type="radio" id="female" name="dough" value="ThinCrust">
      <label for="female">Thin Crust</label>
      <br>
    <input type="radio" id="other" name="dough" value="ThickCrust" checked>
      <label for="other">Thick Crust</label>
    
    <!-- Choose Sauce -->
    <h3>Choose Sauce: </h3><br>
    <input type="radio" id="normal" name="sauce" value="Marinara">
      <label for="Marinara">Marinara</label>
      <br>
    <input type="radio" id="bbq" name="sauce" value="BBQ">
      <label for="bbq">BBQ</label>
      <br>
    <input type="radio" id="alfredo" name="sauce" value="Alfredo" checked>
      <label for="female">Alfredo</label>
      <br>
    <input type="radio" id="ranch" name="sauce" value="Ranch">
      <label for="other">Ranch</label>
    
      <!-- Choose Toppings -->
    <h3>Choose Toppings: </h3><br>    
    <input type="checkbox" name="toppings[]" value="Peperoni" checked> Pepperoni
    <input type="checkbox" name="toppings[]" value="Ham" checked> Ham
    <input type="checkbox" name="toppings[]" value="Bacon" checked> Bacon
    <input type="checkbox" name="toppings[]" value="Tomato" checked> Tomatoes
    <input type="checkbox" name="toppings[]" value="GreenPeppers" checked> Green Peppers 
    <input type="checkbox" name="toppings[]" value="Mushrooms"> Mushrooms 
    <input type="checkbox" name="toppings[]" value="Onions"> Onions 

    <!-- Choose Cheese Type -->
    <h3>Choose Cheese Type: </h3>
    <select name="cheese" id="cheese">
      <option value="Mozarella" checked>Mozzarella</option>
      <option value="Cheddar">Cheddar</option>
      <option value="Havarti">Havarti</option>
      <option value="Feta">Feta</option>
    </select> 
    
    <!-- Add Another Pizza -->
    <br>
    <input type="number" name="addPizza" min="1" max="5"> Add another pizza?
    <br>

    <input type="submit" value="Add to Cart" name="submitPizza">
    
    </form>
    </div>
    
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
