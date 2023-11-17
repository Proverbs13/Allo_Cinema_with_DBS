// 영화 이름
var movies = {
    '가디언즈오브갤럭시':'galaxy',
    '인어공주':'fish',
    '범죄도시3':'crime',
    '분노의 질주':'speed',
    '슈퍼마리오':'mario',
    '트랜스포머':'robot',
    '존윅4':'gun',
    '짱구는못말려':'kid',
    '둘리':'hoi',
    '남은인생10년':'10year'
};

// 영화 이름
var movies_future = {
    '플래시':'flash',
    '인디아나존스':'india',
    '엘리멘탈':'elemental',
    '스파이더맨':'spider',
    '애스터로이드시티':'city',
    '미션임파서블':'dead',
    '바비':'boby',
    '오펜하이머':'newclear'
};

function searchInfo() {
    var inputText = document.getElementById("input_text").value;
    if (inputText.trim() !== "") {
        if(movies.hasOwnProperty(inputText))
            var url = "info.html?value=" + encodeURIComponent(movies[inputText]);
        else if(movies_future.hasOwnProperty(inputText))
            var url = "info_future.html?value=" + encodeURIComponent(movies_future[inputText]);
        else
            alert("영화 이름을 다시 입력해주세요.");
      window.location.href = url;
    }
}