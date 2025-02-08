<?php
session_start();
if(isset($_POST['token'],$_SESSION['token'])&&($_POST['token'] === $_SESSION['token'])){
    unset($_SESSION['token']);
    echo "きちんとしたアクセスです。";
}else{
    header('Location: form1.php');
    exit();
}
