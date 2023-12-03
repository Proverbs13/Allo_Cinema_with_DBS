<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include '../php/dbconfig.php';  // 데이터베이스 설정 파일 포함

$search_query = $_GET['search_query'];

// SearchView에서 검색 실행
$sql = "SELECT * FROM SearchView WHERE ACT_name = '$search_query' OR MV_name = '$search_query' OR DIR_name = '$search_query'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $code = 0;

    switch ($search_query) {
        case $row['ACT_name']:
            $code = $row['ACT_code'];
            header("Location: info_act.php?value=$code");
            break;
        case $row['DIR_name']:
            $code = $row['DIR_code'];
            header("Location: info_dir.php?value=$code");
            break;
        case $row['MV_name']:
            $code = $row['MV_code'];
            header("Location: info.php?value=$code");
            break;
        default:
            echo "<script>alert('정확하게 입력해주세요.');</script>";
            echo "<script>window.location.href = 'main.html';</script>";  // 사용자를 검색 페이지로 리디렉션
            break;
    }

} else {
    echo "<script>alert('정확하게 입력해주세요.');</script>";
    echo "<script>window.location.href = 'main.html';</script>";  // 사용자를 검색 페이지로 리디렉션
}
$conn->close();
?>
