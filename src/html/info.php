<!DOCTYPE html>
<html lang="ko">
<div id="headers"></div>

<head>
    <meta charset="UTF-8">
    <title>영화정보페이지</title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <style>
    .favorite-button {
        background-color: transparent;
        border: none;
        color: red;
        font-size: 24px;
        cursor: pointer;
        padding: 0;
        outline: none;
    }

    .favorite-button:hover {
        color: #ff4081;
    }
    </style>
</head>


<?php
    session_start();

    include '../php/dbconfig.php';
    $value = $_GET['value'];

    
    $_SESSION['mv_code'] = $value;
    // 현재 URL에서 쿼리 파라미터 값을 읽어옴

    // 현재 로그인한 사용자 ID와 영화 코드
    $usr_id = $_SESSION['loggedin_user_id'];
    $mv_code = $value;

    // 데이터베이스에서 현재 사용자가 '즐겨찾기'로 추가한 영화인지 확인
    $fav_sql = "SELECT * FROM Saves WHERE USR_ID = '$usr_id' AND MV_code = '$mv_code'";
    $fav_result = $conn->query($fav_sql);

    // 데이터베이스에서 정보 가져오기
    // 감독 정보와 영화 정보를 함께 가져오는 쿼리
    $sql = "SELECT M.MV_name, M.Opening_date, M.Grade, M.MV_pic ,M.Run_Time, M.Audi_num, D.DIR_code, D.DIR_name ,M.Mv_Des ,D.DIR_pic
    FROM Movie M
    JOIN Director D ON M.Dir_code = D.DIR_code
    WHERE M.MV_code = '$value'";
    $result = $conn->query($sql);

    // 결과 출력
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $MV_pic = $row['MV_pic'];
            $movieName = $row['MV_name'];
            $openingDate = $row['Opening_date'];
            $grade = $row['Grade'];
            $MV_pic = $row['MV_pic'];
            $runningTime = $row['Run_Time'];
            $audience = $row['Audi_num'];
            $directorName = $row['DIR_name'];
            $movieDescription = $row['Mv_Des'];
            $directorPicture = $row['DIR_pic'];
            $directorcode = $row['DIR_code'];
        }
    } else {
        echo "영화를 찾을 수 없습니다.";
    }
    $conn->close();
    ?>
<body>
    <div class="container">
        <div class="movie-info">
            <img id="movie-image" src=<?= $MV_pic ?>>
            <div class="movie-info-content">
                <h2>기본 정보</h2>
                <p class="white_text">제목: <span class="white_text" id="movie-title"> <?= $movieName ?></span></p>
                <p class="white_text">개봉: <span class="white_text" id="movie-release-date"><?= $openingDate ?></span></p>
                <p class="white_text">등급: <span class="white_text" id="movie-old"><?= $grade ?></span></p>
                <p class="white_text">러닝 타임: <span class="white_text" id="movie-running-time"><?= $runningTime ?></span></p>
                <p class="white_text">관객수: <span class="white_text" id="movie-audience"> <?= number_format($audience) ?>명</span></p>
                <form method="post" action="save_favorite.php" id="favorite-form">
                    <input type="hidden" name="USR_ID" value="<?php echo $usr_id; ?>">
                    <input type="hidden" name="MV_code" value="<?php echo $mv_code; ?>">
                    <input type="hidden" name="is_favorite" id="is-favorite" value="<?php echo ($fav_result->num_rows > 0) ? "1" : "0"; ?>">
                    <button type="submit" id="favorite-button" class="favorite-button">
                        <?php echo ($fav_result->num_rows > 0) ? "♥" : "♡"; ?>
                    </button>
                </form>
            </div>
        </div>

    

        <div class="movie-info">
            <div class="movie-info-content">
                <h2>소개</h2>
                <p class="white_text" id="movie-intro"><?= $movieDescription ?></p>
            </div>
        </div>

        <div class="movie-info">
            <div class="movie-info-content">
                <h2 class="info_name">감독</h2>
                
                <div class="people_card">
                    <a href="info_dir.php?value=<?= $directorcode ?>" class="director-link">
                        <div class="thumb">
                            <img id="movie-image" src=<?= $directorPicture ?>>
                        
                        </div>

                        <div class="title_box">
                            <span class="sub_name" style="max-height: 4rem;">감독</span>
                            <strong class="people_name" id="movie-director" style="max-height: 4rem;">
                                <?= $directorName ?>
                            </strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>



        <div class="movie-info">
            <div class="movie-info-content">
                <h2 class="info_name">출연</h2>
                <div class="movie-actor">
                <?php
                    include '../php/dbconfig.php';

                    // 영화 코드
                    $movieCode = $_GET['value'];

                    // 배우 정보를 가져오는 쿼리
                    $sql = "SELECT A.ACT_code, A.ACT_name, A.ACT_pic
                            FROM Actor A
                            JOIN Enter E ON A.ACT_code = E.ACT_code
                            WHERE E.MV_code = '$movieCode'";
                    $result = $conn->query($sql);

                    // 결과 출력
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $actorCode = $row['ACT_code'];
                            $actorName = $row['ACT_name'];
                            $actorPicture = $row['ACT_pic'];


                            // 배우 카드 출력
                            echo '<div class="people_card">';
                            echo '<a href="info_act.php?value=' . $actorCode . '">';
                            echo '<div class="thumb">';
                            echo '<img src="' . $actorPicture . '" alt="사진">';
                            echo '</div>';
                            echo '<div class="title_box">';
                            echo '<span class="sub_name" style="max-height: 4rem;">출연 배우</span>';
                            echo '<strong class="people_name" style="max-height: 4rem;">' . $actorName . '</strong>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '출연 배우 정보를 찾을 수 없습니다.';
                    }
                    $conn->close();
                ?>
                
                </div>
            </div>
        </div>


                <!-- 리뷰 섹션 -->
                <?php
                    include '../php/dbconfig.php';
                    $movieCode = $_GET['value'];
                    $sql = "SELECT U.USR_name, R.MV_code, R.rating, R.content 
                    FROM Review R
                    JOIN User U ON R.USR_ID = U.USR_ID
                    WHERE R.MV_code = '$value'";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<div class="review-section">';
                        echo '<h2>리뷰</h2>';
                        echo '<ul class="review-list">';
                        while ($row = $result->fetch_assoc()) {
                            $username = $row['USR_name'];
                            $movieCode = $row['MV_code'];
                            $rating = $row['rating'];
                            $content = $row['content'];

                            echo '<li class="review-item">';
                            echo '<div class="name">' . $username . '</div>';
                            // Add the code to display stars based on the rating
                            for ($i = 1; $i <= $rating; $i++) {
                            echo '★';
                            }
                            echo '<div class="content">' . $content . '</div>';
                            echo '</li><br>';
                            
                        }
                        echo '</ul>';
                        echo '</div>';
                    } else {
                        echo '리뷰가 없습니다.';
                    }
                    $conn->close();
                    ?>
        

                <form action="review-register.php" method="POST">
            <div class="comment-input">
                <br>
                <div class="white_text">별점</div>
                <div class="rating">
                    <input type="checkbox" class="star" id="star-1" name="rating" value="1">
                    <label for="star-1"></label>
                    <input type="checkbox" class="star" id="star-2" name="rating"  value="2">
                    <label for="star-2"></label>
                    <input type="checkbox" class="star" id="star-3" name="rating" value="3">
                    <label for="star-3"></label>
                    <input type="checkbox" class="star" id="star-4" name="rating" value="4">
                    <label for="star-4"></label>
                    <input type="checkbox" class="star" id="star-5" name="rating" value="5">
                    <label for="star-5"></label>
                    </div>
                <textarea name="content" placeholder="어떤 소감을 느끼셨나요?"></textarea>
                <button type="submit" class="save-review-button">작성</button>
            </div>
        </form>

        
        </div>

    </div>
    <button id="scroll-to-top-button" title="맨 위로 이동" onclick="scrollToTop()">^</button>
</body>
<div id="footers"></div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->


<!-- <script src="../js/jquery-3.7.0.min.js"></script> -->
<script type="text/javascript">

    $(document).ready(function () {

        $("#headers").load("header.html");
        $("#footers").load("footer.html");
        $("#side").load("side.html");
        $("#contents").load("contents-now.html");
        $("#slide").load("slide.html");
    });

</script>
<script>
const checkboxes = Array.from(document.querySelectorAll('.rating input[type="checkbox"]'));
        function updateRating() {
            const selectedCheckbox = checkboxes.find((checkbox) => checkbox.checked);
            let selectedIndex = selectedCheckbox ? checkboxes.indexOf(selectedCheckbox) : -1;

            if (selectedIndex >= 0) {
                checkboxes.forEach((checkbox, i) => {
                    checkbox.checked = i <= selectedIndex;
                });
            }
        }
        
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

        // 체크박스 받아오기
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', () => {
                updateRating();
            });
        });


    </script>
<script src="../js/data.js"></script>