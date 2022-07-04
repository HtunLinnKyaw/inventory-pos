<?php

include_once "core/connectdb.php";
// login code

function login(){
    global $pdo;
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];

    // echo $email." - ".$password;

    $select = $pdo->prepare("select * from tbl_user where useremail='$email' AND password='$password'");

    $select->execute();

    $row=$select->fetch(PDO::FETCH_ASSOC);

    if($row['useremail']==$email AND $row['password']==$password){
        echo $success = 'Login Success';
        header('refresh:1;dashboard.php');
    }else{
        echo 'login fail';
    }
}

