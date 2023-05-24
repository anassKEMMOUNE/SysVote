<?php

// Include the User class
require_once '../Model/user.php';
require_once '../Model/dbConfig.php';
$userID;
// Function to sanitize user input
function sanitize($data) {
    
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and sanitize form data
  $username = sanitize($_POST['username']);
  $password = sanitize($_POST['password']);

  // Retrieve the user from the database
  $user = User::getByUsername($username);

  if ($user && $user->getPassword() === $password) {
    // Successful login
     session_start();
      $_SESSION['username'] = $username;
    if ($user->checkAdmin($username)){
        $_SESSION["is_admin"] = 1;
        header('Location: ../adminDashboard.php');
    }
    else{
        header('Location: ../index.php');
    }
   


}
}
?>