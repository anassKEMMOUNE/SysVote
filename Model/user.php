<?php

class User {
  private $username;
  private $email;
  private $password;
  private $is_admin;
  
  // Constructor
  public function __construct($username, $email, $password) {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this-> is_admin = 0;
  }
  
  // Getters
//   public function getUserID(){
//     return $this->userID;
//   }
  public function getUsername() {
    return $this->username;
  }
  
  public function getEmail() {
    return $this->email;
  }
  
  public function getPassword() {
    return $this->password;
  }
  public function checkAdmin($username){
    require 'dbConfig.php';
    $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = ?");
    
    if (!$stmt) {
      echo "Error: " . $conn->error;
      return null;
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
  
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    if ($admin['is_admin'] == 1){
      $this->is_admin = 1;
      $stmt -> close();
      return true;
    }
    $stmt->close();
    return false;
  }
  public function save() {
    require 'dbConfig.php';
    
    // Check if user already exists

    if ($this->checkIfExist()) {
      echo "User already exists.";
       return false;}
    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $this->username, $this->email, $this->password);
    
    $stmt->execute();
    $conn->close();
    return true;
  }
  
  
  
// Retrieve a user from the database by username
public static function getByUsername($username) {
  require 'dbConfig.php';
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    
    if (!$stmt) {
      echo "Error: " . $conn->error;
      return null;
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
  
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
  
    $stmt->close();
  
    if ($user) {
      return new User($user['username'], $user['email'], $user['password']);
    }
  
    return null;
  }

  public  function getID() {
    require 'dbConfig.php';
      $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
      
      if (!$stmt) {
        echo "Error: " . $conn->error;
        return null;
      }
      
      $stmt->bind_param("s", $this->username);
      $stmt->execute();
    
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();
    
      $stmt->close();
    
      if ($user) {
        return $user["user_id"];
      }
    
      return null;
    }
    
  
public function checkIfExist(){
  require 'dbConfig.php';
  $username = $this->username;
  $email = $this->email;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? or email = ?");
    
    if (!$stmt) {
      echo "Error: " . $conn->error;
      return null;
    }
    
    $stmt->bind_param("ss", $username,$email);
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
  public function updateEmail($newEmail) {
    require 'dbConfig.php';    
    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE username = ?");
    $stmt->bind_param("ss", $newEmail, $this->username);
    
    if ($stmt->execute()) {
      echo "Email updated successfully.";
      $this->email = $newEmail;
    } else {
      echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
  }
  
  // Delete the user from the database
  public function delete() {
    require 'dbConfig.php';    

    
    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $this->username);
    
    if ($stmt->execute()) {
      echo "User deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
      }
      
      $stmt->close();
      $conn->close();
    }
  public function candidateTO($name,$photo,$election_id){
    require 'Candidates.php';
    $candidate =  new Candidate($name,$photo,$election_id,$this->getID());
    $candidate -> create();
  }

}
