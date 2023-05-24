<?php
session_start();

if (isset($_SESSION['username']) ){
if ($_SESSION['username']){

}

else {
    header('Location: view/login.html');
}
}
else{
    header('Location: view/login.html');
}

?>