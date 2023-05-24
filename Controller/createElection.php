
    <form method="post" action = "">    
          <label for="title">Input the election title</label>
          <input type="text"  name='title' id='title' required>  

          <label for="description">Input the election description</label>
          <input type="text"  name='description' id='description' required>  
          
          <label for="start_date">Input the election start date</label>
          <input type="date"  name='start_date' id='start_date' required>  
          
          <label for="end_date">Input the election end date</label>
          <input type="date"  name='end_date' id='end_date' required>  
          <input type="submit" name="submitButton">
    </form>
</body>
<?php
require 'Model/elections.php';
if (isset($_POST["submitButton"])) {
$title = $_POST['title'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$elec = new Elections($title , $description, $start_date, $end_date);
if ($elec -> create()){
    header("../index.php");
}
else{
    echo "election not created";
}
}
?>
