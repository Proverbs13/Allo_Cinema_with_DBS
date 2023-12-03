<!DOCTYPE html>
<html lang="ko">
<div id="headers"></div>

<head>
    <meta charset="UTF-8">
    <title>감독정보페이지</title>
    <link rel="stylesheet" href="../css/infostyle.css">
    <link rel="stylesheet" type="text/css" href="../css/contents_1att.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>

<?php
include '../php/dbconfig.php';
// 현재 URL에서 쿼리 파라미터 값을 읽어옴
$value = $_GET['value'];
// 데이터베이스에서 배우 정보 가져오기
$sql = "SELECT DIR_code, DIR_name, DIR_pic FROM Director WHERE DIR_code = '$value'";
$result = $conn->query($sql);
// 결과 출력
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $DIR_code = $row['DIR_code'];
        $DIR_name = $row['DIR_name'];
        $DIR_pic = $row['DIR_pic'];
        // 사용하는 코드 형식으로 출력
        ;
    }
} else {
    echo "감독를 찾을 수 없습니다.";
}
$conn->close();
?>


<body>
    <div class="container">
    <div class="movie-info">
            <img id="director_img" src=<?= $DIR_pic ?> alt="사진">
            <div class="movie-info-content">
                <h2>기본 정보</h2>
                <p class="white_text">감독명: <span class="white_text" id="movie-title"><?= $DIR_name ?>  
                </span></p>
            </div>
        </div>


        <div class="movie-info">
            <div class="movie-info-content">
                <h2>감독작</h2>
                <div class="movies">
                    <?php        
                    include '../php/dbconfig.php';

                    // 데이터베이스에서 정보 가져오기
                    $sql = "SELECT MV_code, MV_name, Grade, Audi_num ,MV_pic,Mv_Des FROM  Movie WHERE Dir_code='$value'";
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