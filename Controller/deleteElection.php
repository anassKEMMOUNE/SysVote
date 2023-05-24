
<form method="POST" action="" id="deleteElectionForm">
<label for="deleteElec">Enter the Election name you want to delete : </label>
<input type="text" name="deleteElec" id="deleteElec"> 
<input type="submit" value="delete">

</form>

<?php 
if (isset($_POST['deleteElec'])){
    Elections::deleteElection($_POST['deleteElec']);
}
?>

