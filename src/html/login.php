<?php
include('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 로그인 폼에서 전송된 데이터를 변수에 저장합니다.
    $usr_id = $_POST['USR-ID'];
    $pwd = $_POST['pwd'];

    // 로그인을 위한 쿼리를 작성합니다.
    $sql = "SELECT * FROM User WHERE USR_ID = '$usr_id' AND pwd = '$pwd'";

    // 쿼리를 실행하고 결과를 가져옵니다.
    $result = $conn->query($sql);

    // 결과가 존재하는지 확인합니다.
    if ($result->num_rows > 0) {
        // 로그인 성공
        // 세션 등의 로그인 정보를 설정할 수 있고, 다음 페이지로 리다이렉션합니다.
        header("Location: main.html");
        exit(); // 리다이렉션 이후에 스크립트 실행을 중단합니다.
    } else {
        // 로그인 실패
        echo "아이디 또는 비밀번호가 올바르지 않습니다.";
    }

    // MySQL 연결을 종료합니다.
    $conn->close();
}
?>