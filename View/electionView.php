<?php 
require_once '../Controller/sessions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        if( isset($_GET['electionName'])){
            require '../Model/dbConfig.php';
            $title = $_GET['electionName'];
            $query = "SELECT * FROM elections WHERE title = '$title'";
            $stmt =  $conn -> prepare($query);
            $stmt -> execute();
            $result = $stmt->get_result();
            $rowarray = $result->fetch_assoc();
            print "Election Informations";
            print "<br>";
            foreach($rowarray as $key => $value){
                print "\t".$key." : ".$value."\n";
                print "<br>";
                }
        }
        else{
            echo "No election To show";
        }
    ?>
    <form action="" method="post" class='candidateForm'>
        
        <label for="candidateName">Name : </label>
        <input type="text" name = "candidateName" required>
        <label for="candidateName">Photo : </label>
        <input type="text" name = "candidatePhoto" required>
        <input type="submit" value="CandidatePhoto">
    </form>
    <?php 
    include_once '../Model/user.php';
    if (isset($_POST["candidateName"]) && isset($_POST["candidatePhoto"])){
        $name =  $_POST["candidateName"];
        $photo =  $_POST["candidatePhoto"];
        $electionID = $rowarray["election_id"];
        $user =  user::getByUsername($_SESSION['username']);
        $user -> candidateTO($name,$photo,$electionID);
    }

    ?>

    <?php 

    ?>

    <div class="candidates">
    <?php 
    require '../Controller/showCandidates.php';
    showCandidates("",$electionID);
    ?>
    </div>
</body>
</html>