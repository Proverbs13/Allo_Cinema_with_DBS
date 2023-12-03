<?php
include '../php/dbconfig.php';  // 데이터베이스 설정 파일 포함

$search_query = $_GET['search_query'];

// SearchView에서 검색 실행
$sql = "SELECT * FROM SearchView WHERE ACT_name LIKE '%$search_query%' OR MV_name LIKE '%$search_query%' OR DIR_name LIKE '%$search_query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $code = 0;

    if (!empty($row['DIR_code'])) {
        $code = $row['DIR_code'];
    } elseif (!empty($row['MV_code'])) {
        $code = $row['MV_code'];
    } elseif (!empty($row['ACT_code'])) {
        $code = $row['ACT_code'];
    }

    $redirectType = floor($code / 1000);

    switch ($redirectType) {
        case 1:
            header("Location: info_act.php?value=$code");
            break;
        case 2:
            header("Location: info_dir.php?value=$code");
            break;
        case 4:
            header("Location: info.php?value=$code");
            break;
        default:
            echo "No matching records found.";
    }
} else {
    echo "No results found for '$search_query'";
}
$conn->close();
?>
