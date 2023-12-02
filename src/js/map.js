var apiKey = "AIzaSyBxMnrulxRPmEuzW52A_4zKlOXLaSHMDMM";
var myPosition = { lat: 36.625, lng: 127.454 };
// var theaters;

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
    // theaters = [
    //     { name: "메가박스 청주사창", address: "충청북도 청주시 서원구 1순환로 682", url: "../../img/megabox.png", info: "1544-0070", lat: 36.632, lng: 127.460 },
    //     { name: "CGV 청주터미널", address: "충청북도 청주시 흥덕구 가경동 1416-3", url: "../../img/cgv_terminal.png", info: "1544-1122", lat: 36.626, lng: 127.431 },
    //     { name: "롯데시네마 서청주", address: "충청북도 청주시 흥덕구 비하동 순환로 1004", url: "../../img/lottecinema_cheongju.png", info: "1544-8855", lat: 36.644, lng: 127.420 },
    //     { name: "CGV 청주(서문)", address: "충청북도 청주시 상당구 상당로81번길 63", url: "../../img/cgv_cheongju.png", info: "1544-1122", lat: 36.635, lng: 127.486 },
    //     { name: "CGV 청주성안길", address: "충청북도 청주시 상당구 상당로81번길 33", url: "../../img/cgv_cheongju_load.png", info: "1544-1122", lat: 36.635, lng: 127.488 },
    //     { name: "CGV 청주율량", address: "충청북도 청주시 청원구 충청대로 114 (라마다프라자 청주), 3관 2층", url: "../../img/cgv_cheongju_load.png", info: "", lat: 36.666, lng: 127.494 },
    //     { name: "메가박스 오창", address: "충청북도 청주시 청원구 오창읍 중심상업1로 8-9, 3층", url: "../../img/cgv_cheongju_load.png", info: "", lat: 36.712, lng: 127.428 },
    //     { name: "CGV 청주지웰시티", address: "충청북도 청주시 흥덕구 대농로 47-1 (복대동)", url: "../../img/cgv_cheongju_load.png", info: "", lat: 36.643, lng: 127.427 },
    //     { name: "롯데시네마 청주용암", address: "충청북도 청주시 상당구 1순환로 1233, 1~4층 (용암동)", url: "../../img/cgv_cheongju_load.png", info: "", lat: 36.606, lng: 127.503 },
    //  ];

    // API 키를 스크립트 URL에 삽입하여 동적으로 로드
    loadMapScript("showMap");
}

// 맵 표시 함수
// function showMap() {
//     // 맵 설정
//     var mapOptions = {
//         center: myPosition, // 내 위치
//         zoom: 15 // 지도 초기 줌 레벨
//     };
//     // 맵
//     var map = new google.maps.Map(document.getElementById("map"), mapOptions);

//     // 마커 생성
//     theaters.forEach(({name, address, url, info, lat, lng }) => {
//         const marker = new google.maps.Marker({
//             position: { lat, lng },
//             map: map,
//         });

//         // 인포 윈도우 생성
//         const infowindow = new google.maps.InfoWindow({
//             // 내용
//             content: `<img src=${url} alt="" width="300px" height="300px"><br>
//             <strong style="font-size: 30px">${name}</strong><br>
//             <span style="font-size:20px; width:300px; text-overflow: ellipsis; white-space:nowrap; overflow:hidden; display:block;">
//             <img src="../../img/marker.png" alt="" width="20px height="20px">${address}</span>
//             <span style="font-size:20px; width:300px; text-overflow: ellipsis; white-space:nowrap; overflow:hidden; display:block;">
//             <img src="../../img/call.png" alt="" width="20px height="20px">${info}</span>`
//         });
//         // 마커 hover 이벤트 처리
//         marker.addListener('mouseover', function() {
//             infowindow.open(map, marker);
//         });
//         marker.addListener('mouseout', function() {
//             infowindow.close();
//         });
//     });
// }
function showMap() {
    // 맵 설정
    var mapOptions = {
        center: myPosition,
        zoom: 15
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    console.log(theaters);
    console.log(typeof(theaters[0].TH_Lat));

    theaters.forEach(function(theater) {
        console.log(theater.TH_Lat);
        console.log(theater.TH_Lng);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(theater.TH_Lat, theater.TH_Lng),
            map: map
        });

        var infowindow = new google.maps.InfoWindow({
            content: '<img src="' + '../../img/megabox.png' + '" alt="" width="300px" height="300px"><br>' +
                     '<strong style="font-size: 30px">' + theater.TH_Place_name + '</strong><br>' +
                     '<span style="font-size:20px;">' + theater.TH_Location + '</span><br>' +
                     '<span style="font-size:20px;">' + theater.TH_Phone + '</span>'
        });

        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });
        marker.addListener('mouseout', function() {
            infowindow.close();
        });
    });
}
