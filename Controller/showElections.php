<?php
function showElection($StringToAdd,$is_admin = false){
    $configPath = str_replace("Controller","Model",__DIR__);
    require $configPath.'\dbConfig.php';
    
    $query = "SELECT * FROM elections";
    $stmt =  $conn -> prepare($query);
    $stmt -> execute();
    $result = $stmt->get_result();
    $rowarray = $result->fetch_all();
    
    
    if (is_array($rowarray)){
        if (count($rowarray)>0){
            echo "<table class='electionsTable'>";
            echo "  <tr>
            <th>Election ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Start date</th>
            <th>End date</th>
            <th> Option </th>
            </tr>";
            foreach ($rowarray as $row) {
                print "<tr>\n";
                foreach ($row as $col) {
                    print "\t<td>$col</td>\n";
                }
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
            echo "<p class='noElectionCreated'>No election created</p>";
        }
    
    }
    
    else {
        echo "<p class='noElectionCreated'>No election created</p>";
    }
    
    
    $conn -> close();
}

?>
