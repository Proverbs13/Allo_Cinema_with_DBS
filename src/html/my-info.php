<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>내 정보 페이지</title>
    <link rel="stylesheet" href="../css/my-info.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="headers"></div>
    <div class="user-info">
        <?php        

        session_start();
        include '../php/dbconfig.php';

        // 여기서 로그인한 사용자의 ID를 가져오는 방법이 있어야 합니다.
        $loggedInUserID = $_SESSION['loggedin_user_id'];

        // 데이터베이스에서 해당 사용자의 정보 가져오기
        $sql = "SELECT USR_ID, USR_name, Phone_Num FROM User WHERE USR_ID = '$loggedInUserID'";
        $result = $conn->query($sql);

        $sql2 = "SELECT U.USR_name, R.rating, R.content, M.MV_name
         FROM Review R 
         INNER JOIN User U ON R.USR_ID = U.USR_ID 
         INNER JOIN Movie M ON R.MV_code = M.MV_code
         WHERE R.USR_ID = '$loggedInUserID'";
        $result2 = $conn->query($sql2);

        //$sql3 = "SELECT USR_ID, USR_name, Phone_Num FROM User WHERE USR_ID = '$loggedInUserID'";
        //$result3 = $conn->query($sql3);

        if ($result->num_rows > 0) {
            // 결과를 가져와서 표시
            while($row = $result->fetch_assoc()) {
                //사용자 정보 컨테이너
                echo '<div class="container">';
                echo '<div class="movie-info">';
                echo '<img id="movie-image" src="../../img/human_default.png">';
                echo '<div class="movie-info-content">';
                echo '<h2>내 정보</h2>';
                echo '<p class="white_text">ID: ' . $row["USR_ID"] . '</p>';
                echo '<p class="white_text">이름: ' . $row["USR_name"] . '</p>';
                echo '<p class="white_text">전화번호: ' . $row["Phone_Num"] . '</p>';
                echo '</div>';
                echo '</div>';

                if ($result2->num_rows > 0) {
                    echo '<div class="review-section">';
                    echo '<h2>리뷰</h2>';
                    echo '<ul class="review-list">';
                    while ($row2 = $result2->fetch_assoc()) {
                        $mvname = $row2['MV_name'];
                        $username = $row2['USR_name'];
                        $rating = $row2['rating'];
                        $content = $row2['content'];

                        echo '<li class="review-item">';
                        echo '<div class="name">' . $mvname . '</div>';
                        echo '<div class="name">' . $username . '</div>';
                        echo '<div class="ratingStars" id="rating_' . $username . '"></div>';
                        echo '<div class="content">' . $content . '</div>';
                        echo '</li><br>';
                        echo "<script>displayRating($rating, 'rating_$username');</script>";
                    }
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '리뷰가 없습니다.';
                }

                //찜 컴테이너
                echo '<div class="container">';
                echo '<div class="movie-info">';
                echo '<div class="movie-info-content">';
                echo '<h2>찜</h2>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "사용자 정보를 찾을 수 없습니다.";
        }
        ?>
    </div>
    <div id="footers"></div>
</body>
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
    });



  </script>