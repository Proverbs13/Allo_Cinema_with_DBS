<?php
include('../php/dbconfig.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $usr_id = $_POST['USR-ID'];
    $pwd = $_POST['pwd'];
    $usr_name = $_POST['USR-name'];
    $phone_num = $_POST['Phone_Num'];


    $phone_num = $_POST['Phone_Num'];
    $phone_num2 = $_POST['Phone_Num2']; 

    $sqlUser = "INSERT INTO User (USR_ID, pwd, USR_name) VALUES ('$usr_id', '$pwd', '$usr_name')";
    $resultUser = $conn->query($sqlUser);

    $sqlPhone = "INSERT INTO Phone (USR_ID, Phone_Num) VALUES ('$usr_id', '$phone_num')";
    $resultPhone = $conn->query($sqlPhone);

    if (!empty($phone_num2)) {
        $sqlPhone2 = "INSERT INTO Phone (USR_ID, Phone_Num) VALUES ('$usr_id', '$phone_num2')";
        $resultPhone2 = $conn->query($sqlPhone2);
        
        if (!$resultPhone2) {
            echo "두 번째 핸드폰 번호를 저장하는 중 오류가 발생하였습니다: " . $conn->error;
            // 적절한 오류 처리 추가
        }
    }

    if ($resultUser === TRUE && $resultPhone === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "회원가입 중 오류가 발생하였습니다: " . $conn->error;
    }

    $conn->close();
    }
?>