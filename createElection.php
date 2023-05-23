<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="elecID">Input the election ID</label>
          <input type="text"  name='elecID' id='elecID'>  
        
          <label for="title">Input the election title</label>
          <input type="text"  name='title' id='title'>  

          <label for="description">Input the election description</label>
          <input type="text"  name='description' id='description'>  
          
          <label for="start_date">Input the election start date</label>
          <input type="date"  name='start_date' id='start_date'>  
          
          <label for="end_date">Input the election end date</label>
          <input type="text"  name='end_date' id='end_date'>  
          <button type="submit">Submit</button>
    </form>
</body>
<?php
require 'Model/elections.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

}
?>
</html>