<!DOCTYPE html>
<html>
  <div id="headers"></div>
<head>
  <meta charset="utf-8">
  <title>내 근처 영화관</title>
  <link rel="stylesheet" type="text/css" href="../css/map.css">
</head>
<body>
  <div id="map"></div>
</body>
<div id="footers"></div>
</html>

<?php include '../php/dbconfig.php'; ?>

<script type="text/javascript">
    // PHP에서 가져온 데이터를 JavaScript 변수로 할당
    var theaters = <?php echo json_encode($theaters); ?>;
</script>

<script type="module" src="../js/map.js"></script>

<script src="../js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">

  $(document).ready( function() { //jquery 사용
  
  $("#headers").load("header.html"); //header.html을 객체화
  $("#footers").load("footer.html"); //footer.html을 객체화
  $("#side").load("side.html"); //side.html을 객체화
  $("#contents").load("contents-now.html"); //contents-now.html을 객체화
  $("#slide").load("slide.html"); //slide.html을 객체화
  });
  
  $(document).ready(function() {
        function changePage1() {  //컨텐츠 페이지 교환 함수
          $("#contents").load("contents-now.html");
          var newContent = '현재 상영작';
          $('#category-name').html(newContent);//현재 상영작 페이지로 교체
        }
        
        
        $('#now').click(function() {//now 텍스트 클릭시
          changePage1();
        });
  
        
      });
  
  $(document).ready(function() {
        function changePage2() { //컨텐츠 페이지 교환 함수2
          $("#contents").load("contents-future.html");
          var newContent = '개봉 예정작';
          $('#category-name').html(newContent);//개봉 예정작 페이지로 교체
        }
        
        
        $('#future').click(function() {//future 텍스트 클릭시
          changePage2();
        });
  
        
      });    
  
      
  </script>
