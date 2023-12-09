<?php
include '../php/dbconfig.php';
session_start();
// 여기서 로그인한 사용자의 ID를 가져오는 방법이 있어야 합니다.
$loggedInUserID = $_SESSION['loggedin_user_id'];
$movieCode = $_SESSION['mv_code'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $content = $_POST['content'];

    // RV_code 값 가져오기
    $getRVCodeQuery = "SELECT MAX(RV_code) AS max_rv_code FROM Review WHERE USR_ID = '$loggedInUserID' AND MV_code = '$movieCode'";
    $result = $conn->query($getRVCodeQuery);
    $row = $result->fetch_assoc();
    $maxRVCode = $row['max_rv_code'];
    
    // RV_code 값 설정
    if ($maxRVCode === null) {
        $newRVCode = 1;
    } else {
        $newRVCode = $maxRVCode + 1;
    }

    // 사용자 정보 및 리뷰를 Review 테이블에 삽입하는 쿼리
    $insertReview = "INSERT INTO Review (USR_ID, MV_code, RV_code, rating, content) VALUES ('$loggedInUserID', '$movieCode', '$newRVCode', '$rating', '$content')";

    if ($conn->query($insertReview) === TRUE) {
        header("Location: info.php?value=" . $movieCode);
    } else {
        echo "리뷰 등록에 실패했습니다: " . $conn->error;
    }
    
    $conn->close();
}
?>