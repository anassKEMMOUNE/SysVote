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
 
     if ($this->checkIfExists()) {
       echo "Election already exists.";
        return false;
     }
    $stmt = $conn->prepare("INSERT INTO elections (title, description, start_date,end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->title, $this->description, $this->start_date,$this->end_date);
    
    $stmt->execute();
    $conn->close();
    echo "created success";
    return true;
  }
  
  public function checkIfExists(){
    require 'dbConfig.php';
    $title = $this->title;
      $stmt = $conn->prepare("SELECT * FROM elections WHERE title = ?");
      
      if (!$stmt) {
        echo "Error: " . $conn->error;
        return null;
      }
      
      $stmt->bind_param("s", $title);
      $stmt->execute();
    
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      if (is_null($row)){
        return false;
      }
      else{
        if (count($row)>0) { 
          return true;}
        else {
          return false;}
      }

      $stmt->close();
    

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
  public static function deleteElection($title) {
    require 'dbConfig.php';    

    
    $stmt = $conn->prepare("DELETE FROM elections WHERE title = ?");
    $stmt->bind_param("s", $title);
    
    if ($stmt->execute()) {
      echo "Election deleted successfully.";
    } else {
        echo "Error: Election Not found" ;
      }
      
      $stmt->close();
      $conn->close();
    }

}
