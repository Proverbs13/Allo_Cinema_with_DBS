<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>내 정보 페이지</title>
    <link rel="stylesheet" href="../css/my-info.css">
    <link rel="stylesheet" type="text/css" href="../css/contents_1att.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="headers"></div>
    <div class="user-info">
        <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        session_start();
        include '../php/dbconfig.php';

        
        $loggedInUserID = $_SESSION['loggedin_user_id'];

        // 데이터베이스에서 해당 사용자의 정보 가져오기
        $sql = "SELECT USR_ID, USR_name FROM User WHERE USR_ID = '$loggedInUserID'";
        $result = $conn->query($sql);

        $sql2 = "SELECT U.USR_name, R.rating, R.content, M.MV_name
        FROM User U
        JOIN (
            SELECT *
            FROM Review
            WHERE USR_ID = '$loggedInUserID'
        ) R ON U.USR_ID = R.USR_ID
        JOIN Movie M ON R.MV_code = M.MV_code;";
        $result2 = $conn->query($sql2);

        //$sql3 = "SELECT USR_ID, USR_name, Phone_Num FROM User WHERE USR_ID = '$loggedInUserID'";
        //$result3 = $conn->query($sql3);

        $sql4 = "SELECT Phone_Num FROM Phone WHERE USR_ID = '$loggedInUserID'";
        $result4 = $conn->query($sql4);

        if ($result->num_rows > 0) {
            // 결과를 가져와서 표시
            while ($row = $result->fetch_assoc()) {
                
               
                $phoneNumbers = array();
        
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                        
                        $phoneNumbers[] = $row4["Phone_Num"]; 
                    }
                }
        
               
                echo '<div class="container">';
                echo '<div class="movie-info">';
                echo '<img id="movie-image" src="../../img/human_default.png">';
                echo '<div class="movie-info-content">';
                echo '<h2>내 정보</h2>';
                echo '<p class="white_text">ID: ' . $row["USR_ID"] . '</p>';
                echo '<p class="white_text">이름: ' . $row["USR_name"] . '</p>';
        
                // 모든 핸드폰 번호 출력
                echo '<p class="white_text">전화번호: ';
                for ($i = 0; $i < count($phoneNumbers); $i++) {
                    if ($i === 0) {
                        echo $phoneNumbers[$i] . '<br>'; 
                    } else {
                        $spaces = str_repeat('&nbsp;', 15); 
                        echo $spaces . $phoneNumbers[$i] . '<br>'; 
                    }
                }
                echo '</p>';
        
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

                // 찜 목록 조회
                $sql3 = "SELECT M.MV_pic, M.MV_name, M.Audi_num, M.Mv_Des, M.Grade
                FROM Movie M
                JOIN ( SELECT *
                            FROM Saves
                            WHERE USR_ID =  
                            '$loggedInUserID' ) as S
                ON  S.MV_code = M.MV_code;";
                $result3 = $conn->query($sql3);

                if ($result3->num_rows > 0) {
                    echo '<div class="movie-info">';
                    echo '<div class="movie-info-content">';
                    echo '<h2>찜</h2>';
                    echo '<div class="movies">'; // 영화들을 담을 컨테이너
                
                    while ($row3 = $result3->fetch_assoc()) {
                        echo '<div class="movie-card">';
                        echo '<div class="video-container">';
                        echo '<img src="' . $row3['MV_pic'] . '" alt="Movie Image" class="movie-image-main">';
                        echo '</div>';
                        echo '<div class="movie-text">';
                        echo '<div class="movie-name-main">' . $row3['MV_name'] . '</div>';
                        echo '<div class="movie-grade">★ ' . $row3['Grade'] . '</div>';
                        echo '<div class="audience-value">' . number_format($row3['Audi_num']) . '명</div>';
                        echo '<div class="movie-contents">' . $row3['Mv_Des'] . '</div>';
                        echo '</div>'; // movie-text 종료
                        echo '</div>'; // movie-card 종료
                    }
                
                    echo '</div>'; // movies 종료
                    echo '</div>'; // movie-info-content 종료
                    echo '</div>'; // movie-info 종료
                } else {
                    echo '찜 목록이 없습니다.';
                }
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