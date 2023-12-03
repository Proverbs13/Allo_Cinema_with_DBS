<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/side.css">
    <script src="https://d3js.org/d3.v7.min.js" charset="utf-8"></script>
</head>
<body>
    <div class="scrollBar" style="width: 500px; height: 800px; overflow-y: scroll;">
        <p class="wrapper">
            <div class="topic_box">
                <h2 class="topic">현재 개봉작 관객 순위</h2>
            </div>

            <ul>
                <?php
                include '../php/dbconfig.php';

                // 데이터베이스에서 정보 가져오기
                $sql = "SELECT MV_name FROM Movie ORDER BY Audi_num DESC LIMIT 10";
                $result = $conn->query($sql);

                // 결과 출력하기
                if ($result->num_rows > 0) {
                    $count = 1; // 영화 순위를 나타내기 위한 변수
                    while ($row = $result->fetch_assoc()) {
                        // 영화 정보 출력
                        echo '<li>';
                        echo '<div class="movie">';
                        echo '<img src="../../img/poster/영화포스터.jpg" alt="" class="movie-img">';
                        echo '<div class="movie-name">' . $count . '. ' . $row["MV_name"];
                        echo '<svg id="myGraph' . $count . '" style="height:20px; width:95%;"></svg>';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                        $count++;
                    }
                } else {
                    echo "영화 정보를 가져오지 못했습니다.";
                }

                $conn->close();
                ?>
            </ul>
        </p>
    </div>
</body>
</html>
<script src="../js/d3.js"></script>