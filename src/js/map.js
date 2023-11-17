var apiKey = "apiKey";
var myPosition = { lat: 36.625, lng: 127.454 };
var movies = [
    { name: "메가박스", address: "충청북도 청주시 서원구 1순환로 682 메가박스 청주사창점", url: "../../img/megabox.png", info: "1544-0070", lat: 36.632, lng: 127.460 },
    { name: "CGV 청주터미널", address: "충청북도 청주시 흥덕구 가경동 1416-3", url: "../../img/cgv_terminal.png", info: "1544-1122", lat: 36.626, lng: 127.431 },
    { name: "롯데시네마 서청주", address: "충청북도 청주시 흥덕구 비하동 순환로 1004", url: "../../img/lottecinema_cheongju.png", info: "1544-8855", lat: 36.644, lng: 127.420 },
    { name: "CGV 청주", address: "충청북도 청주시 상당구 상당로81번길 63", url: "../../img/cgv_cheongju.png", info: "1544-1122", lat: 36.635, lng: 127.486 },
    { name: "CGV 청주성안길", address: "충청북도 청주시 상당구 상당로81번길 33", url: "../../img/cgv_cheongju_load.png", info: "1544-1122", lat: 36.635, lng: 127.488 } ];

// window.onload 이벤트에 html창 열릴 시 실행할 함수 연결
window.onload = initMap;

// 구글 맵 로드
function loadMapScript(callback) {
    var script = document.createElement("script");
    script.src = "https://maps.googleapis.com/maps/api/js?key=" + apiKey + "&callback=" + callback;
    document.head.appendChild(script);
}

// 맵 초기화 및 표시
function initMap() {
    // API 키를 스크립트 URL에 삽입하여 동적으로 로드
    loadMapScript("showMap");
}

// 맵 표시 함수
function showMap() {
    // 맵 설정
    var mapOptions = {
        center: myPosition, // 내 위치
        zoom: 15 // 지도 초기 줌 레벨
    };
    // 맵
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // 마커 생성
    movies.forEach(({name, address, url, info, lat, lng }) => {
        const marker = new google.maps.Marker({
            position: { lat, lng },
            map: map,
        });

        // 인포 윈도우 생성
        const infowindow = new google.maps.InfoWindow({
            // 내용
            content: `<img src=${url} alt="" width="300px" height="300px"><br>
            <strong style="font-size: 30px">${name}</strong><br>
            <span style="font-size:20px; width:300px; text-overflow: ellipsis; white-space:nowrap; overflow:hidden; display:block;">
            <img src="../../img/marker.png" alt="" width="20px height="20px">${address}</span>
            <span style="font-size:20px; width:300px; text-overflow: ellipsis; white-space:nowrap; overflow:hidden; display:block;">
            <img src="../../img/call.png" alt="" width="20px height="20px">${info}</span>`
        });
        // 마커 hover 이벤트 처리
        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
        marker.addListener('mouseout', function() {
            infowindow.close();
        });
    });
}