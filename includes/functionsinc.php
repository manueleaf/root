<?php
function emptyInputSignup($name, $email, $username, $pwd, $rptpwd) {
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($rptpwd)){
        $result = true;
    } 
    else{
        $result = false;
    }
    return $result;
}

function Invaliduid($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result =true;
    } else{
        $result=false;
    }
    return $result;
}

function Invalidemail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result =true;
    } else{
        $result=false;
    }  
    return $result;
}

function pwdmatch($pwd, $rptpwd) {
    $result;
    if($pwd !== $rptpwd){
        $result =true;
    } else{
        $result=false;
    }  
    return $result;
}

function uidexists($conn, $username, $email) {
    $sql = "SELECT * FROM usuario WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; 
    } else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createuser($conn, $username, $email, $pwd, $name) {
    $sql = "INSERT INTO usuario (username, email, pwd, nombre) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmterror");
        exit();
    }

    $hashedpwd =password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedpwd, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)){
        $result = true;
    } 
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidexists($conn, $username, $username);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] =  $uidExists["id"];
        $_SESSION["useruid"] =  $uidExists["username"];
        $_SESSION["userrolid"] =  $uidExists["rol_id"];
        header("location: ../index.php");
        exit();
    }
}

function userOnline($conn, $userid){
    $sql = "UPDATE usuario SET online=1 WHERE id=$userid;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ./index.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

function userOffline($conn, $userid){
    $sql = "UPDATE usuario SET online=0 WHERE id=$userid;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ./index.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

function ConsultarMonstruo($conn, $ID){
    $sql="SELECT * FROM monster where MonsterID=".$ID."";
    $ei = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($ei);
    return [$result['MonsterID'], $result['MonsterName'], $result['Attack'], $result['Defense'], $result['HP'], $result['Speed']];

}

function emptyInputMonster($name, $atk,$def,$hp,$spd) {
    $result;
    if(empty($name) || empty($atk)||empty($def)||empty($hp)||empty($spd)){
        $result = true;
    } 
    else{
        $result = false;
    }
    return $result;
}

function updateMonster($conn, $name, $atk, $def, $hp, $spd, $id){
    $sql = "UPDATE monster SET MonsterName='".$name."', Attack= '".$atk."', Defense= '".$def."', HP= '".$hp."', Speed= '".$spd."' WHERE MonsterID='".$id."';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ./index.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../agregarMonstruo.php");

}

function newMonster($conn,  $name, $atk,$def,$hp,$spd) {
    $sql = "INSERT INTO monster (MonsterName, Attack, Defense, HP, Speed) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../agregarMonstruo.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $name, $atk, $def, $hp, $spd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../agregarMonstruo.php?error=none");
    exit();
}

function newArea($conn,  $name){
    $sql = "INSERT INTO area (AreaName) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../agregarArea.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../agregarArea.php?error=none");
    exit();
}

function emptyInputArea($name) {
    $result;
    if(empty($name)){
        $result = true;
    } 
    else{
        $result = false;
    }
    return $result;
}

function newMonArea($conn, $name, $area){
    $sql="SELECT * FROM monster where MonsterName='".$name."'";
    $ei = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($ei); 
    
    $sqla="SELECT * FROM area where AreaName='".$area."'";
    $eie = mysqli_query($conn, $sqla);
    $result2 = mysqli_fetch_assoc($eie);

    $sql="INSERT INTO monsterarea (AreaID, MonsterID) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../monarea.php?error=stmterror");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $result2['AreaID'], $result['MonsterID']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../monstare.php?error=none");
}

function emptyInputMonArea($name, $area) {
    $result;
    if(empty($name) || empty($area)){
        $result = true;
    } 
    else{
        $result = false;
    }
    return $result;
}

function delete_monarea($conn, $name){
    $sql = "UPDATE monsterarea SET Eliminado=1 WHERE MonsterAreaID=$name;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../monstare.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../monstare.php?error=none");
}

function delete_mon($conn, $name){
    $sql = "UPDATE monster SET Eliminado=1 WHERE MonsterID=$name;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../agregarMonstruo.php?error=stmterror");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../agregarMonstruo.php?error=none");
}

/* Por implementar
function monAreaExists($conn, $name, $area){
    $sql="SELECT * FROM monster where MonsterName='".$name."'";
    $ei = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($ei); 
    
    $sqla="SELECT * FROM area where AreaName='".$area."'";
    $eie = mysqli_query($conn, $sqla);
    $result2 = mysqli_fetch_assoc($eie);

    $sql = "SELECT * FROM usuario WHERE AreaID = ? OR MonsterID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $result2['AreaID'], $result[MonsterID]);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row; 
    } else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}*/