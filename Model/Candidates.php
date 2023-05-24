<?php

class Candidate {
  private $name;
  private $photo;
  private $election_id;
  private $user_id;

  
  // Constructor
  public function __construct($name, $photo, $election_id,$user_id) {
    $this->name = $name;
    $this->photo = $photo;
    $this->election_id = $election_id;
    $this->user_id = $user_id;

  }
  
  // Getters
//   public function getcandidateID(){
//     return $this->candidateID;
//   }
  public function getName() {
    return $this->name;
  }
  
  public function getPhoto() {
    return $this->photo;
  }
  
  public function getelection_id() {
    return $this->election_id;
  }
  public function create() {
    require 'dbConfig.php';
    
    $stmt = $conn->prepare("INSERT INTO candidates (name, photo, election_id, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->name, $this->photo, $this->election_id ,$this->user_id);
    
    $stmt->execute();
    $conn->close();
  }
  
  
  
// Retrieve a candidate from the database by name
public static function getByname($name) {
  require 'dbConfig.php';
    $stmt = $conn->prepare("SELECT * FROM candidates WHERE name = ?");
    
    if (!$stmt) {
      echo "Error: " . $conn->error;
      return null;
    }
    
    $stmt->bind_param("s", $name);
    $stmt->execute();
  
    $result = $stmt->get_result();
    $candidate = $result->fetch_assoc();
  
    $stmt->close();
  
    if ($candidate) {
      return new candidate($candidate['name'], $candidate['photo'], $candidate['election_id'],$candidate['user_id']);
    }
  
    return null;
  }
  
  
  
  // Update the candidate's photo in the database
  public function updatephoto($newphoto) {
    require 'dbConfig.php';    
    $stmt = $conn->prepare("UPDATE candidates SET photo = ? WHERE name = ?");
    $stmt->bind_param("ss", $newphoto, $this->name);
    
    if ($stmt->execute()) {
      echo "photo updated successfully.";
      $this->photo = $newphoto;
    } else {
      echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
  }
  public function updatename($newname) {
    require 'dbConfig.php';    
    $stmt = $conn->prepare("UPDATE candidates SET name = ? WHERE name = ?");
    $stmt->bind_param("ss", $newname, $this->name);
    
    if ($stmt->execute()) {
      echo "name updated successfully.";
      $this->name = $newname;
    } else {
      echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
  }
  
  // Delete the candidate from the database
  public function delete($id) {
    require 'dbConfig.php';    

    
    $stmt = $conn->prepare("DELETE FROM candidates WHERE name = $id");

    
    if ($stmt->execute()) {
      echo "candidate deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
      }
      
      $stmt->close();
      $conn->close();
    }

}
