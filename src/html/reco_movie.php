<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>영화추천결과페이지</title>
    <link rel="stylesheet" href="../css/select_movie.css">    
</head>

<div id="headers"></div>

<body>
    <div class="container">
        <div class="movie-container">
            <div class="movie-container-content">
            <h1 style="font-size: 50px;">이런 영화는 어떠세요?</h1>
            <?php
            include '../php/dbconfig.php';

            // URL 파라미터에서 장르 및 영화 코드 리스트 가져오기
            $genres = json_decode($_GET['genres'] ?? '[]', true);
            $movies = json_decode($_GET['movies'] ?? '[]', true);

            $reco_movies = []; // 추천 영화 목록
            $dir_list = []; // 감독 코드 목록
            $act_list = []; // 배우 코드 목록

            // 장르 코드에 해당하는 영화들의 MV_code 추출
            foreach ($genres as $genre) {
                $sql = "SELECT MV_code FROM Movie WHERE GR_code = '$genre'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $reco_movies[$row['MV_code']] = true;
                }
            }

            // 영화 코드에 해당하는 감독 코드 추출
            foreach ($movies as $movie) {
                $sql = "SELECT DIR_code FROM Movie WHERE MV_code = '$movie'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $dir_list[$row['DIR_code']] = true;
                }
            }

            // dir_list의 감독 코드에 해당하는 영화 추출
            foreach (array_keys($dir_list) as $dir_code) {
                $sql = "SELECT MV_code FROM Movie WHERE DIR_code = '$dir_code'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $reco_movies[$row['MV_code']] = true;
                }
            }

            // 영화 코드에 해당하는 배우 코드 추출
            foreach ($movies as $movie) {
                $sql = "SELECT ACT_code FROM Enter WHERE MV_code = '$movie'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $act_list[$row['ACT_code']] = true;
                }
            }

            // act_list의 배우 코드에 해당하는 영화 추출
            foreach (array_keys($act_list) as $act_code) {
                $sql = "SELECT MV_code FROM Enter WHERE ACT_code = '$act_code'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $reco_movies[$row['MV_code']] = true;
                }
            }

            // 중복 제거 및 랜덤 선택
            $reco_movies = array_keys($reco_movies);
            shuffle($reco_movies);
            $selected_movies = array_slice($reco_movies, 0, 20);


            echo "<div class='movies'>";
            // 선택된 영화들 표출
            foreach ($selected_movies as $movie_code) {
                // 영화 정보 가져오기
                $sql = "SELECT MV_pic, MV_name FROM Movie WHERE MV_code = '$movie_code'";
                $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='movie-card' data-mv-code='{$movie_code}' style='opacity: 0;' onclick='goToMovieInfo(\"$movie_code\")'>";
                        echo "<img src='" . $row["MV_pic"] . "' alt='" . $row["MV_name"] . "' class='movie-image'>";
                        echo "</div>";
                    }
                }
            }
            echo "</div>";

            $conn->close();
            ?>
            </div>
        </div>
    </div>
    <button id="scroll-to-top-button" title="맨 위로 이동" onclick="scrollToTop()">^</button>
</body>

<div id="footers"></div>

<!-- 페이지 이동 -->
<script>
    function goToMovieInfo(movieCode) {
        window.location.href = `info.php?value=${movieCode}`;
    }
</script>

<!-- 화면 전환 효과 -->
<script>
    // 페이지 로드 시 모든 영화 카드에 페이드인 효과 적용
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.movie-card').forEach(function(card) {
            card.classList.add('fade-in');
            setTimeout(function() {
                card.style.opacity = '1';
            }, 200);
        });
    });
</script>

<!-- 스크롤 관련 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
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
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#headers").load("header.html");
        $("#footers").load("footer.html");
    });
</script>