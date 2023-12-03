<!DOCTYPE html>
<html>
<div id="headers"></div>
<head>
    <meta charset="UTF-8">
    <title>내 정보 페이지</title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <link rel="stylesheet" type="text/css" href="../css/contents_1att.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>


<body>
    <div class="container">

        <div class="movie-info">
            <div class="movie-info-content">
                <h2>추천 영화 목록</h2>
                <div class="movies">
                    <?php        
                    include '../php/dbconfig.php';

                    // // 데이터베이스에서 정보 가져오기
                    // $sql = "SELECT MV_code, MV_name, Grade, Audi_num FROM Movie LIMIT 10";
                    // $result = $conn->query($sql);

                    // 데이터베이스에서 정보 가져오기
                    $sql = "SELECT m.MV_code, m.MV_name, m.Grade, m.MV_pic, m.Audi_num, m.Mv_Des
                    FROM Movie m";
                    
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // 결과를 행 단위로 출력
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
    <div id="Reco_slide_left"></div>
    <div id="Reco_slide_right"></div>
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
      $("#Reco_slide_left").load("Reco_slide_left"); //slide.html을 객체화
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