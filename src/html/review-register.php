<?php
include '../php/dbconfig.php';
session_start();
// 여기서 로그인한 사용자의 ID를 가져오는 방법이 있어야 합니다.
$loggedInUserID = $_SESSION['loggedin_user_id'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $content = $_POST['content'];
    $movieCode = $_GET['value']; // 영화 코드 가져오기

    // 사용자 정보 및 리뷰를 Review 테이블에 삽입하는 쿼리
    $insertReview = "INSERT INTO Review (USR_ID, MV_code, rating, content) VALUES ('$loggedInUserID', '$movieCode', '$rating', '$content')";


    if ($conn->query($insertReview) === TRUE) {
        header("Location: info.php?value=" . $movieCode);
    } else {
        echo "리뷰 등록에 실패했습니다: " . $conn->error;
    }
    
    $conn->close();
}
?>