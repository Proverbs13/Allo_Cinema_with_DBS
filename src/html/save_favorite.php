<?php
include('../php/dbconfig.php'); // 데이터베이스 설정 파일 포함

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usr_id = $_POST['USR_ID'];
    $mv_code = $_POST['MV_code'];

    // 데이터베이스에 저장하는 쿼리
    $sql = "INSERT INTO Saves (USR_ID, MV_code) VALUES ('$usr_id', '$mv_code')";

    // 쿼리 실행
    if ($conn->query($sql) === TRUE) {
        // 성공 시 메시지 출력 또는 다른 페이지로 리다이렉션
        echo "<script>alert('찜 목록에 추가되었습니다.'); window.location.href='info.php';</script>";
    } else {
        // 실패 시 메시지 출력
        echo "오류: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
