<?php
session_start();
if(isset($SESSION['name'])){
    echo "<pre>";
    var_dump($_SESSION);
    echo"</pre>";

}
?>
