<?php

class Elections {
  private $title;
  private $description;
  private $start_date;
  private $end_date;
  
  // Constructor
  public function __construct($title, $description, $start_date,$end_date) {
    $this->title = $title;
    $this->description = $description;
    $this->start_date = $start_date;
    $this-> end_date = $end_date;
  }
  

  public function create() {
    require 'dbConfig.php';
    
    // Check if user already exists
    //$existingUser = $this->getByUsername($this->username, $conn);
    //  if ($existingUser) {
    //   echo "User already exists.";
    //    return;
    
    $stmt = $conn->prepare("INSERT INTO elections (title, description, start_date,end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->title, $this->description, $this->start_date,$end_date);
    
    $stmt->execute();
    $conn->close();
  }
  
  

  
  // Update the user's email in the database
  public function updateDescription($newDescription) {
    require 'dbConfig.php';    
    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE username = ?");
    $stmt->bind_param("ss", $newEmail, $this->title);
    
    if ($stmt->execute()) {
      echo "Email updated successfully.";
      $this->description = $newEmail;
    } else {
      echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
  }
  
  // Delete the user from the database
  public function delete() {
    require 'dbConfig.php';    

    
    $stmt = $conn->prepare("DELETE FROM elections WHERE title = ?");
    $stmt->bind_param("s", $this->title);
    
    if ($stmt->execute()) {
      echo "User deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
      }
      
      $stmt->close();
      $conn->close();
    }

}
