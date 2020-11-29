<!DOCTYPE html>
<html>
<head>
  <title>Pizza Store</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="./css/styles.css" type="text/css" rel="stylesheet"/>
</head>

<body> 
  <!-- Nav Menu -->
<?php
  include './common.php';
  echo showNavBar("Guest");
?>

  <!-- Main Box -->
  <div class="container">
	  <h1>Welcome to The Pizza Store!</h1>
	  <h3>Enter your email to begin order...</h3>
    <br>
  	
	  <div class="col-md-4">
    	<form action="orderpizza.php" method="post">  
		    <div class="form-group">
    		    <input type="text" aria-describedby="emailHelp" placeholder="Enter email" class="form-control" name="emailInput">
			    <br>
    		    <input type="submit" id="submitBtn" class="btn btn-success" name='submitBtn' value="Submit">
  		  </div>
		  </form>

	  </div>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
