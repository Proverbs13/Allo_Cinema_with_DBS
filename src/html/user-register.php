<?php
include('../php/dbconfig.php');

// POST 요청을 받았을 때만 회원가입 처리를 수행합니다.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 회원가입 폼에서 전송된 데이터를 변수에 저장합니다.
    $usr_id = $_POST['USR-ID'];
    $pwd = $_POST['pwd'];
    $usr_name = $_POST['USR-name'];
    $phone_num = $_POST['Phone_Num'];


    // 회원가입 쿼리를 작성합니다.
    $sql = "INSERT INTO User (USR_ID, pwd, USR_name, Phone_Num) VALUES ('$usr_id', '$pwd', '$usr_name', '$phone_num')";

    // 쿼리를 실행하고 결과를 확인합니다.
    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
    } else {
        echo "회원가입 중 오류가 발생하였습니다: " . $conn->error;
    }

    // MySQL 연결을 종료합니다.
    $conn->close();
}
?>