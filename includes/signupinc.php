<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $username = $_POST["uid"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $rptpwd = $_POST["rptpwd"];

    require_once 'dbhinc.php';
    require_once 'functionsinc.php';

    if(emptyInputSignup($name, $email, $username, $pwd, $rptpwd) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(Invaliduid($username) !== false){
        header("location: ../signup.php?error=invalidusername");
        exit();
    }
    if(Invalidemail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdmatch($pwd, $rptpwd) !== false){
        header("location: ../signup.php?error=pwderror");
        exit();
    }
    if(uidexists($conn, $username, $email) !== false){
        header("location: ../signup.php?error=usertaken");
        exit();
    }

    createuser($conn,$username,$email,$pwd, $name);

} else{
    header("location: ../signup.php");
    exit();
}