<!DOCTYPE html>
<html lang="ko">
<div id="headers"></div>

<head>
    <meta charset="UTF-8">
    <title>현재상영작-상세정보페이지</title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>


<body>
    <div class="container">
        <div class="movie-info">
            <img id="movie-image">
            <div class="movie-info-content">
                <h2>기본 정보</h2>
                <p class="white_text">제목: <span class="white_text" id="movie-title">
                        <?php
                        include '../php/dbconfig.php';

                        // 현재 URL에서 쿼리 파라미터 값을 읽어옴
                        $value = $_GET['value'];

                        // 데이터베이스에서 정보 가져오기
                        // 감독 정보와 영화 정보를 함께 가져오는 쿼리
                        $sql = "SELECT M.MV_name, M.Opening_date, M.Grade, M.Run_Time, M.Audi_num, D.DIR_name ,M.Mv_Des ,D.DIR_pic
                        FROM Movie M
                        INNER JOIN Director D ON M.Dir_code = D.DIR_code
                        WHERE M.MV_code = '$value'";
                        $result = $conn->query($sql);

                        // 결과 출력
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $movieName = $row['MV_name'];
                                $openingDate = $row['Opening_date'];
                                $grade = $row['Grade'];
                                $runningTime = $row['Run_Time'];
                                $audience = $row['Audi_num'];
                                $directorName = $row['DIR_name'];
                                $movieDescription = $row['Mv_Des'];
                                $directorPicture = $row['DIR_pic'];

                                echo "영화 제목: " . $movieName;

                            }
                        } else {
                            echo "영화를 찾을 수 없습니다.";
                        }
                        $conn->close();
                        ?>
                    </span></p>
                <p class="white_text">개봉: <span class="white_text" id="movie-release-date"><?= $openingDate ?></span></p>
                <p class="white_text">등급: <span class="white_text" id="movie-old"><?= $grade ?></span></p>
                <p class="white_text">러닝 타임: <span class="white_text" id="movie-running-time"><?= $runningTime ?></span></p>
                <p class="white_text">관객수: <span class="white_text" id="movie-audience"> <?= number_format($audience) ?>명</span></p>
            </div>
        </div>

    
        <!-- <div class="movie-info">
            <div class="reserv">
                <p class="white_text">예약하러 가기 ➜ &nbsp; </p>
            </div>
            <div class="button-row">
                <a href="http://www.cgv.co.kr/ticket/" target="_blank" class="brand-button">CGV</a> &nbsp;
                <a href="https://www.megabox.co.kr/booking" target="_blank" class="brand-button">메가박스</a> &nbsp;
                <a href="https://www.lottecinema.co.kr/NLCHS/Ticketing" target="_blank"
                    class="brand-button">롯데시네마</a>&nbsp;
            </div>
        </div> -->

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
                    <div class="thumb">
                        <img  id="director_img" src="../../img/human_default.png" alt="사진">
                    </div>
                    <div class="title_box">
                        <span class="sub_name" style="max-height: 4rem0;">감독</span>
                        <strong class="people_name" id="movie-director" style="max-height:  4rem;">
                        <?= $directorName ?>
                        </strong>
                    </div>
                </div>

            </div>
        </div>

        <div class="movie-info">
            <div class="movie-info-content">
                <h2 class="info_name">출연</h2>
                <div class="movie-actor">
                <div class="people_card">
                    <div class="thumb">
                        <img  id="director_img" src="../../img/human_default.png" alt="사진">
                    </div>
                    <div class="title_box">
                        <span class="sub_name" style="max-height: 4rem0;">감독</span>
                        <strong class="people_name" id="movie-director" style="max-height:  4rem;">
                        <?= $directorName ?>
                        </strong>
                    </div>
                </div>
                
                </div>
            </div>
        </div>

        <!-- <div class="movie-info">
            <div class="movie-info-content">
                <h2>평점</h2>
                <p class="white-text">Metacritic: <span class="white_text movie-rating">메타크리틱 평점 작성</span></p>
                <p class="white-text">IMDb: <span class="white_text movie-rating">IMDb 평점 작성</span></p>
                <p class="white-text">Rotten Tomatoes: <span class="white_text movie-rating">로튼 토마토 평점 작성</span></p>
                <p class="white-text">관람객 평점: <span class="white_text movie-rating">관람객 평점 작성</span></p>
            </div>
        </div> -->

        <!-- 리뷰 섹션 -->
        <div class="review-section">
            <h2>리뷰</h2>
            <ul class="review-list">
                <li class="review-item">
                    <div class="name">이름1</div>
                    <div class="ratingStars">★★★★☆</div>
                    <div class="content">리뷰 내용1</div>
                </li><br>
                <li class="review-item">
                    <div class="name">이름2</div>
                    <div class="ratingStars">★★★☆☆</div>
                    <div class="content">리뷰 내용2</div>
                </li><br>
            </ul>
            <div class="comment-input">
                <div class="comment-input-container">
                    <br>
                    <div class="white_text">이름</div>
                    <input type="text" class="name-input" placeholder="이름을 입력하세요.">
                </div>
                <div class="white_text">별점</div>
                <div class="rating">
                    <input type="checkbox" class="star" id="star-1" value="1">
                    <label for="star-1"></label>
                    <input type="checkbox" class="star" id="star-2" value="2">
                    <label for="star-2"></label>
                    <input type="checkbox" class="star" id="star-3" value="3">
                    <label for="star-3"></label>
                    <input type="checkbox" class="star" id="star-4" value="4">
                    <label for="star-4"></label>
                    <input type="checkbox" class="star" id="star-5" value="5">
                    <label for="star-5"></label>
                </div>
                <textarea placeholder="어떤 소감을 느끼셨나요?"></textarea>
                <button class="save-review-button">작성</button>
            </div>
        </div>
        <!-- 리뷰 섹션 끝 -->
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


        // 체크박스 정의
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

        // 체크박스 받아오기
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('click', () => {
                updateRating();
            });
        });

        // 리뷰 저장
        function saveReviewsToLocal(value, reviews) {
            const key = `reviews-${value}`;
            localStorage.setItem(key, JSON.stringify(reviews));
        }

        // 리뷰 불러오기
        function getReviewsFromLocal(value) {
            const key = `reviews-${value}`;
            const storedReviews = localStorage.getItem(key);
            return storedReviews ? JSON.parse(storedReviews) : [];
        }

        //리뷰생성
        function createReviewItem(name, ratingStars, content) {
            return $("<li>", { class: "review-item" })
                .append($("<div>", { class: "name", text: name }))
                .append($("<div>", { text: "★".repeat(ratingStars) })) 
                .append($("<div>", { class: "content", html: content }))
                .append($("<br>"));
        }

        function displayReviews() {
            const reviewList = $(".review-list");
            reviewList.empty();
            const value = urlParams.get('value');
            const storedReviews = getReviewsFromLocal(value);

            storedReviews.forEach(function (review) {
                const newReview = createReviewItem(review.name, review.ratingStars, review.content);
                reviewList.append(newReview);
            });
        }

        // 리뷰 추가
        function addReview(value, name, ratingIndex, content) {
            const storedReviews = getReviewsFromLocal(value);
            const ratingStars = ratingIndex;
            storedReviews.push({ name, ratingStars, content });
            saveReviewsToLocal(value, storedReviews);
            displayReviews();
        }

        $(".save-review-button").click(function () {
            const nameInput = $(".name-input");
            const ratingIndex = checkboxes.filter((el) => el.checked).length;
            const contentTextarea = $("textarea");
            const value = urlParams.get('value');

            const name = nameInput.val();
            const content = contentTextarea.val();

            if (name) {
                if (ratingIndex >= 0) {
                    addReview(value, name, ratingIndex, content);
                    nameInput.val('');
                    checkboxes.forEach((checkbox) => { checkbox.checked = false; });
                    contentTextarea.val('');
                } else {
                    alert('별점을 선택하세요.');
                }
            } else {
                alert('이름을 입력하세요.');
            }
        });

        displayReviews();
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