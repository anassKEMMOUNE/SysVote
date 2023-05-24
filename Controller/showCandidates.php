<?php
function showCandidates($StringToAdd,$election_id,$is_admin = false){
    $configPath = str_replace("Controller","Model",__DIR__);
    require $configPath.'\dbConfig.php';
    
    $query = "SELECT * FROM candidates where election_id = '$election_id'";
    $stmt =  $conn -> prepare($query);
    $stmt -> execute();
    $result = $stmt->get_result();
    $rowarray = $result->fetch_all();
    
    
    if (is_array($rowarray)){
        if (count($rowarray)>0){
            echo "<table class='candidatesTable'>";
            echo "  <tr>
            <th>name</th>
            <th>photo</th>
            <th> Vote </th>
            </tr>";
            foreach ($rowarray as $row) {
                print "<tr>\n";
                    $name = $row[1];
                    $photo = $name[2];
                    print "\t<td>$name</td>\n";
                    print "\t<td>$photo</td>\n";
                
                if (!$is_admin){
                    $StringToAdd = str_replace("toreplace",$row[1],$StringToAdd);
                }
                print "\t<td>$StringToAdd</td>\n";
                $StringToAdd = str_replace($row[1],"toreplace",$StringToAdd);

                print "</tr>\n";
            }  
            echo "</table >";
        }
        else {
            echo "<p class='noElectionCreated'>No candidates found</p>";
        }
    
    }
    
    else {
        echo "<p class='noElectionCreated'>No candidates created</p>";
    }
    
    
    $conn -> close();
}

?>
