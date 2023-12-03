<!DOCTYPE html>
<html lang="ko">
<div id="headers"></div>

<head>
    <meta charset="UTF-8">
    <title>배우정보페이지</title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <link rel="stylesheet" type="text/css" href="../css/contents_1att.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="movie-info">
            <img id="movie-image">
            <div class="movie-info-content">
                <h2>기본 정보</h2>
                <p class="white_text">배우명: <span class="white_text" id="movie-title">
                    <?php
                        include '../php/dbconfig.php';

                        // 현재 URL에서 쿼리 파라미터 값을 읽어옴
                        $value = $_GET['value'];

                        // 데이터베이스에서 배우 정보 가져오기
                        $sql = "SELECT ACT_code, ACT_name, ACT_pic FROM Actor WHERE ACT_code = '$value'";
                        $result = $conn->query($sql);

                        // 결과 출력
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $ACT_code = $row['ACT_code'];
                                $ACT_name = $row['ACT_name'];
                                $ACT_pic = $row['ACT_pic'];
                                // 사용하는 코드 형식으로 출력
                                echo  $ACT_name ;
                            }
                        } else {
                            echo "배우를 찾을 수 없습니다.";
                        }
                        $conn->close();
                        ?>
                </span></p>
            </div>
        </div>

        <div class="movie-info">
            <div class="movie-info-content">
                <h2>출연작</h2>
                <div class="movies">
                    <?php        
                    include '../php/dbconfig.php';

                    // // 데이터베이스에서 정보 가져오기
                    // $sql = "SELECT MV_code, MV_name, Grade, Audi_num FROM Movie LIMIT 10";
                    // $result = $conn->query($sql);

                    // 데이터베이스에서 정보 가져오기
                    $sql = "SELECT m.MV_code, m.MV_name, m.Grade, m.Audi_num
                    FROM Movie m
                    JOIN Enter e ON m.MV_code = e.MV_code
                    WHERE e.ACT_code = '$value'";
                    
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
        </div>

    </div>
    <button id="scroll-to-top-button" title="맨 위로 이동" onclick="scrollToTop()">^</button>
</body>

<div id="footers"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script>


    // 현재 URL에서 쿼리 파라미터 값을 읽어옴
    var urlParams = new URLSearchParams(window.location.search);
    var value = urlParams.get('value');

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


<script src="../js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $("#headers").load("header.html");
        $("#footers").load("footer.html");
        $("#side").load("side.html");
        $("#contents").load("contents-now.html");
        $("#slide").load("slide.html");
    });

    $(document).ready(function () {
        function changePage1() {
            $("#contents").load("contents-now.html");
            var newContent = '현재 상영작';
            $('#category-name').html(newContent);
        }


        $('#now').click(function () {
            changePage1();
        });


    });

    $(document).ready(function () {
        function changePage2() {
            $("#contents").load("contents-future.html");
            var newContent = '개봉 예정작';
            $('#category-name').html(newContent);
        }


        $('#future').click(function () {
            changePage2();
        });


    });


</script>
<script src="../js/data.js"></script>