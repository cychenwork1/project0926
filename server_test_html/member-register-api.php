<?php
//{"username":"owner01",password":"123456","email":"owner@test.com"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);


if (isset($mydata["username"]) && isset($mydata["password"]) && isset($mydata["email"])) {
    if ($mydata["username"] != "" && $mydata["password"] != "" && $mydata["email"] != "") {
        $p_username = $mydata["username"];
        $p_password =password_hash($mydata["password"],PASSWORD_DEFAULT);
        $p_email = $mydata["email"];
        



        require_once("dbtools.php");
        $link = create_connection();


        $sql = "INSERT INTO member(Username,Password,Email) VALUES('$p_username','$p_password','$p_email')";
        if (execute_sql($link, "testdb", $sql)) {
            echo '{"state":true,"message":"註冊成功"}';
        } else {
            echo '{"state":false,"message":"註冊失敗和錯誤代碼等"}';
        }
        mysqli_close($link);
    } else {
        echo '{"state":false,"message":"欄位不得為空白"}';
    }
} else {
    echo '{"state":false,"message":"欄位錯誤"}';
}
