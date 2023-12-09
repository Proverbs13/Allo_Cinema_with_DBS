<?php
include '../php/dbconfig.php';

// 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 쿼리 실행
$sql = "SELECT TH_Place_name, TH_Location, TH_Lat, TH_Lng, TH_Phone FROM Theater";
$result = $conn->query($sql);

$theaters = array();
if ($result->num_rows > 0) {
    // 결과를 배열로 변환
    while($row = $result->fetch_assoc()) {
        $row['TH_Lat'] = floatval($row['TH_Lat']);
        $row['TH_Lng'] = floatval($row['TH_Lng']);
        array_push($theaters, $row);
    }
} else {
    echo "0 results";
}
?>

