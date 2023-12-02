<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/contents.css">
    <script src="../js/main_video.js"></script>
</head>
<body>
    <hr>
    <div class="scrollBar" style="width: 1440px; height:800px; overflow-y: scroll;">
        <div class="movies">
            <?php        
            include '../php/dbconfig.php';

            // 데이터베이스에서 정보 가져오기
            $sql = "SELECT MV_code, MV_name, Grade, Audi_num FROM Movie LIMIT 10";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // 결과를 행 단위로 출력
                while($row = $result->fetch_assoc()) {
                    echo '<a href="info.php?value=' . strtolower(str_replace(' ', '_', $row["MV_code"])) . '">';
                    echo '<div class="movie-card">';
                    echo '<div class="video-container">';
                    // echo '<img src="../../img/poster/' . $row["MV_name"] . ' 포스터.jpg" alt="" class="movie-img-main">';
                    echo '</div>';
                    echo '<div class="movie-text">';
                    echo '<div class="movie-name-main">' . $row["MV_name"] . '</div>';
                    echo '<div class="movie-grade">★ ' . $row["Grade"] . '</div>';
                    echo '<div class="audience-value">' . number_format($row["Audi_num"]) . '명</div>';
                
                    // echo '<div class="movie-contents">' . $row["Contents"] . '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>
</body>
</html>
