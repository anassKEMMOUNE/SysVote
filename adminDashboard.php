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
    <div class="ElecTools">
        <?php require 'Controller/createElection.php';?>
        <?php require 'Controller/deleteElection.php';?>
    </div>
    <div class="electionTable">
        <?php require 'Controller/showElections.php';
            showElection("","",true);
        ?>
    </div>

</body>
<!-- <?php 
require 'Model/elections.php';

Elections::deleteElection('firstElection');
?>




</html>