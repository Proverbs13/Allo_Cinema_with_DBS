<?php
include('../php/dbconfig.php');

// POST 요청을 받았을 때만 회원가입 처리를 수행합니다.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 회원가입 폼에서 전송된 데이터를 변수에 저장합니다.
    $usr_id = $_POST['USR-ID'];
    $pwd = $_POST['pwd'];
    $usr_name = $_POST['USR-name'];
    $phone_num = $_POST['Phone_Num'];


    // User 테이블에 데이터 삽입
    $sqlUser = "INSERT INTO User (USR_ID, pwd, USR_name) VALUES ('$usr_id', '$pwd', '$usr_name')";
    $resultUser = $conn->query($sqlUser);

    // Phone 테이블에 데이터 삽입
    $sqlPhone = "INSERT INTO Phone (USR_ID, Phone_Num) VALUES ('$usr_id', '$phone_num')";
    $resultPhone = $conn->query($sqlPhone);

    // 두 쿼리가 모두 성공했는지 확인
    if ($resultUser === TRUE && $resultPhone === TRUE) {
        // 두 쿼리가 성공했으므로 사용자를 로그인 페이지로 리디렉션
        header("Location: login.html");
        exit();
    } else {
        // 하나라도 실패하면 오류 메시지 출력
        echo "회원가입 중 오류가 발생하였습니다: " . $conn->error;
    }

    // MySQL 연결을 종료합니다.
    $conn->close();
}
?>