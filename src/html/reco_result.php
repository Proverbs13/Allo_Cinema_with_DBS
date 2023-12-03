<?php
    if (!isset($_SERVER['HTTP_REFERER'])) {
        // HTTP_REFERER가 없는 경우, 직접 접속한 경우이므로 아무 작업도 하지 않고 페이지를 종료합니다.
        exit;
    }
?>


<!DOCTYPE html>
<html>
<html lang="ko">
<div id="headers"></div>
<head>
    
    <meta charset="UTF-8">
    <title> 장르별 추천 페이지 </title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <link rel="stylesheet" type="text/css" href="../css/contents_1att.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <style>
        .genre-question {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .genre-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .genre-list a {
            display: block;
            margin: 10px;
            padding: 8px 16px;
            background-color: #f2f2f2;
            color: #333;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="genre-question">어떤 장르를 선호하세요?</div>
        <div class="genre-list">
            <a href="?genre=all">전체</a>
            <a href="?genre=판타지">판타지</a>
            <a href="?genre=코미디">코미디</a>
            <a href="?genre=어드벤처">어드벤처</a>
            <a href="?genre=액션">액션</a>
            <a href="?genre=애니메이션">애니메이션</a>
            <a href="?genre=스릴러">스릴러</a>
            <a href="?genre=범죄">범죄</a>
            <a href="?genre=미스터리">미스터리</a>
            <a href="?genre=뮤지컬">뮤지컬</a>
            <a href="?genre=멜로/로맨스">멜로/로맨스</a>
            <a href="?genre=드라마">드라마</a>
            <a href="?genre=기타">기타</a>
            <a href="?genre=공포(호러)">공포(호러)</a>
            <a href="?genre=SF">SF</a>
        </div>
        <div class="movie-info">
            <div class="movie-info-content">
                <h2>추천 영화 목록</h2>
                <div class="movies">
                    <?php
                    include '../php/dbconfig.php';

                    // 장르에 따라 쿼리 작성
                    $genre = $_GET['genre'];
                    if ($genre == 'all') {
                        $sql = "SELECT m.MV_code, m.MV_name, m.Grade, m.MV_pic, m.Audi_num, m.Mv_Des
                                FROM Movie m";
                    } else {
                        $genre = mysqli_real_escape_string($conn, $genre);
                        $sql = "SELECT m.MV_code, m.MV_name, m.Grade, m.MV_pic, m.Audi_num, m.Mv_Des
                                FROM Movie m
                                JOIN Genre g ON m.GR_code = g.GR_code
                                WHERE g.GR_name = '$genre'";
                        echo $genre;
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<a href="info.php?value=' . strtolower(str_replace(' ', '_', $row["MV_code"])) . '">';
                            echo '<div class="movie-card">';
                            echo '<div class="video-container">';
                            echo '<img src="' . $row["MV_pic"] . '" class="movie-img-main">';
                            echo '</div>';
                            echo '<div class="movie-text">';
                            echo '<div class="movie-name-main">' . $row["MV_name"] . '</div>';
                            echo '<div class="movie-grade">★ ' . $row["Grade"] . '</div>';
                            echo '<div class="audience-value">' . number_format($row["Audi_num"]) . '명</div>';
                            echo '<div class="movie-contents">' . $row["Mv_Des"] . '</div>';
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
        </div>
    </div>
    <button id="scroll-to-top-button" title="맨 위로 이동" onclick="scrollToTop()">^</button>
    <script src="../js/script.js"></script>
</body>
<div id="footers"></div>
</html>

<!-- 헤더/푸터 스크립트 -->
<script src="../js/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#headers").load("header.html"); //header.html을 객체화
        $("#footers").load("footer.html"); //footer.html을 객체화
        $("#side").load("side.html"); //side.html을 객체화
        $("#contents").load("contents-now.html"); //contents-now.html을 객체화
        $("#slide").load("slide.html"); //slide.html을 객체화
        $("#Reco_slide_left").load("Reco_slide_left.html"); //slide.html을 객체화
        $("#Reco_slide_right").load("Reco_slide_right.html"); //slide.html을 객체화
    });

    // 스크롤 관련 -----------------------------------------------------------------
    function scrollToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
    }

    $(window).scroll(function () {
        const scrollPosition = $(this).scrollTop();
        const scrollToTopButton = $("#scroll-to-top-button");

        if (scrollPosition > 200) {
            scrollToTopButton.show();
        } else {
            scrollToTopButton.hide();
        }
    });

    $("#scroll-to-top-button").click(function () {
        scrollToTop();
    });
</script>