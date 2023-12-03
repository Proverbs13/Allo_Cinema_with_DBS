<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

session_start();
include('../php/dbconfig.php');

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usr_id = $_POST['USR_ID'];
    $mv_code = $_POST['MV_code'];
    $is_favorite = $_POST['is_favorite'];

    try {
        if ($is_favorite == "1") {
            // 데이터베이스에서 삭제하는 쿼리
            $sql = "DELETE FROM Saves WHERE USR_ID = '$usr_id' AND MV_code = '$mv_code'";
        } else {
            // 데이터베이스에 저장하는 쿼리
            $sql = "INSERT INTO Saves (USR_ID, MV_code) VALUES ('$usr_id', '$mv_code')";
        }

        // 쿼리 실행
        $conn->query($sql);

        // 성공 시 info.php로 리다이렉션
        header("Location: info.php?value=" . $mv_code);
        exit();
    } catch (Exception $e) {
        // 실패 시 오류 메시지 출력하지 않고 info.php로 리다이렉트
        header("Location: info.php?value=" . $mv_code);
        exit();
    }
}

$conn->close();
?>
