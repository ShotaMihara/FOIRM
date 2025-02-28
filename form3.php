<?php
session_start();
if(isset($_POST['token'],$_SESSION['token'])&&($_POST['token'] === $_SESSION['token'])){
    unset($_SESSION['token']);
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $subject = $_SESSION['subject'];
    $body = $_SESSION['body'];

    $dsn = 'mysql:dbname=contact_form;host=localhost;charset=utf8';
    $user ='root';
    $password = '';

    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $sql = 'INSERT INTO inquiries (name,email,subject,body) VALUES (?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$name,PDO::PARAM_STR);
    $stmt->bindValue(2,$email,PDO::PARAM_STR);
    $stmt->bindValue(3,$subject,PDO::PARAM_STR);
    $stmt->bindValue(4,$body,PDO::PARAM_STR);
    $stmt->execute();


    $dbh = null;
    $_SESSION = array();
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(),'',time()-42000,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
    }
    session_destroy();
}else{
    header('Location: form1.php');
    exit();
}
