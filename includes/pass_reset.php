<?php
//using token system to authenticate user and pinpoint token for user once user presses email and relocates back to system
if(isset($_POST["pass_reset_request"])){

    //2 tokens created
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/CovidTestingSite/forms/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 900; //link expires after 15 minutes

    require('connect.php');

    $userEmail = $_POST["email"];
    $sql = "DELETE from pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($connect);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "there was an error :(";
        exit();
    }else{
        mysqli_stmt_bing_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql ="INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";

    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "there was an error :(";
        exit();
    }else{
        mysqli_stmt_bing_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }


}else{
    header("location: ../login.php");
}