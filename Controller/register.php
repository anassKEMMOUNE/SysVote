<?php
require_once "../Model/user.php";
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
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    // Create a new User object
    $user = new User($username, $email, $password);
    // Save the user
   if($user->save()){
    session_start();
    $_SESSION['username'] = $_POST['username'];
    // Redirect to success page or perform any other actions
    header("Location: ../index.php");
    exit();
   }
   else {
    echo "username or email already used";
   }
  }
  else {
    echo "error";
  }

?>