<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>영화선택페이지</title>
    <link rel="stylesheet" href="../css/select_movie.css">   
</head>

<div id="headers"></div>

<body>
    <div class="container">
        <div class="movie-container">
            <div class="movie-container-content">
                <h1 style="font-size: 50px;">마음에 드는 영화를 3개 골라주세요.</h1>
                <div class="movies">
                <?php
                include '../php/dbconfig.php';

                $sql = "SELECT GR_code, MV_code, MV_pic, MV_name FROM Movie";
                $result = $conn->query($sql);

                $moviesByGRCode = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $moviesByGRCode[$row["GR_code"]][] = [
                            "MV_code" => $row["MV_code"],
                            "MV_pic" => $row["MV_pic"],
                            "MV_name" => $row["MV_name"]
                        ];
                    }

                    foreach ($moviesByGRCode as $grCode => $movies) {
                        shuffle($movies);
                        $movies = array_slice($movies, 0, 3);

                        foreach ($movies as $movie) {
                            echo "<div class='movie-card' data-gr-code='{$grCode}' data-mv-code='{$movie["MV_code"]}'>";
                            echo "<img src='" . $movie["MV_pic"] . "' alt='" . $movie["MV_name"] . "' class='movie-image'>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "No movies found.";
                }

                $conn->close();
                ?>
                </div>
            </div>
        </div>
    </div>
    <button id="scroll-to-top-button" title="맨 위로 이동" onclick="scrollToTop()">^</button>
</body>

<div id="footers"></div>

<!-- 이미지 클릭 이벤트 관련 -->
<script>
// 영화 선택 상태를 저장하는 Set 초기화
var wishGenre = new Set();
var selectedMovies = new Set();

document.addEventListener('DOMContentLoaded', function() {
    // 영화 카드 클릭 이벤트 리스너 설정
    document.querySelectorAll('.movie-card').forEach(function(card) {
        card.addEventListener('click', function() {
            var grCode = this.dataset.grCode; // data-gr-code 속성으로부터 GR_code 가져오기
            var mvCode = this.dataset.mvCode; // data-mv-code 속성으로부터 MV_code 가져오기

            // 선택 상태 토글
            if (wishGenre.has(grCode)) {
                wishGenre.delete(grCode); // Set에서 제거
                selectedMovies.delete(mvCode); // Set에서 제거
                this.classList.remove('selected'); // 시각적 표시 제거
            } else {
                wishGenre.add(grCode); // Set에 추가
                selectedMovies.add(mvCode); // Set에 추가
                this.classList.add('selected'); // 시각적 표시 추가
            }

            // 선택된 영화가 3개일 때 자동으로 제출
            if (selectedMovies.size === 3) {
                submitSelection();
            }
        });
    });
});
</script>

<script>
// 제출 버튼 클릭시 실행되는 함수
function submitSelection() {
    // 모든 영화 카드에 페이드아웃 효과 적용
    document.querySelectorAll('.movie-card').forEach(function(card) {
        card.classList.add('fade-out');
    });

    // 지정된 시간 후 페이지 이동
    setTimeout(function() {
        var genreSelection = Array.from(wishGenre);
        var movieSelection = Array.from(selectedMovies);
        window.location.href = 'reco_movie.php?genres=' + encodeURIComponent(JSON.stringify(genreSelection)) + '&movies=' + encodeURIComponent(JSON.stringify(movieSelection));
    }, 200);
}
</script>

<!-- 뒤로가기 누르면 새로고침 -->
<script>
    window.onpageshow = function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.localStorage.removeItem('load');
            window.location.reload();
        } else if (!window.localStorage.getItem('load')) {
            window.localStorage.setItem('load', 'true');
        }
    };
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