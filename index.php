<?php 
require_once 'Controller/sessions.php';

if (isset($_SESSION['is_admin'])){
    if ($_SESSION['is_admin']==1){
        header("Location: adminDashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/style.css">
    <title>Document</title>
</head>
<body>
<a href="Controller/logout.php">Logout</a>
<div class="electionTable">
    <?php require 'Controller/showElections.php';
    $stringToAdd = "<form action='View/electionView.php' method='get'>";
    $stringToAdd .= "<input type='submit' value='toreplace' name='electionName'></form>";
    showElection($stringToAdd);
    ?>
</div>
</body>
</html>