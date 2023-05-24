<?php

class Votes {
  private $election_id;
  private $user_id;
  private $candidate_id;

  
  // Constructor
  public function __construct($election_id, $user_id, $candidate_id) {
    $this->election_id = $election_id;
    $this->user_id = $user_id;
    $this->candidate_id = $candidate_id;
  }
  

  public function create() {
    require 'dbConfig.php';
    
 
     if ($this->checkIfExists()) {
       echo "vote already exists.";
        return false;
     }
    $stmt = $conn->prepare("INSERT INTO votes (election_id, user_id, candidate_id,end_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $this->election_id, $this->user_id, $this->candidate_id);
    
    $stmt->execute();
    $conn->close();
    echo "created success";
    return true;
  }
  
  public function checkIfExists(){
    require 'dbConfig.php';
    $election_id = $this->election_id;
    $user_id =  $this-> user_id;
      $stmt = $conn->prepare("SELECT * FROM votes WHERE user_id =  ? and election_id = ?");
      
      if (!$stmt) {
        echo "Error: " . $conn->error;
        return null;
      }
      
      $stmt->bind_param("ss",$user_id ,$election_id);
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

  
  // Delete the user from the database
  public static function deleteVote($election_id , $user_id) {
    require 'dbConfig.php';    

    
    $stmt = $conn->prepare("DELETE FROM votes WHERE election_id = ? and user_id = ?");
    $stmt->bind_param("ss", $election_id,$user_id);
    
    if ($stmt->execute()) {
      echo "Election deleted successfully.";
    } else {
        echo "Error: Election Not found" ;
      }
      
      $stmt->close();
      $conn->close();
    }

}
