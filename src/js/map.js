var myPosition = { lat: 36.625, lng: 127.454 };

window.showMap = showMap;

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

function showMap() {
    var mapOptions = {
        center: myPosition,
        zoom: 15
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var markers = []; // 마커를 저장할 배열

    // 이미지 URL 리스트
    var urlList = [
        "../../img/cgv_cheongju_load.png",
        "../../img/cgv_cheongju.png",
        "../../img/cgv_terminal.png",
        "../../img/lottecinema_cheongju.png",
        "../../img/megabox.png",
        "../../img/theater1.png",
        "../../img/theater2.png",
        "../../img/theater3.png",
        "../../img/theater4.png",
        "../../img/theater5.png",
        "../../img/theater6.png",
        "../../img/theater7.png",
        "../../img/theater8.png",
        "../../img/theater9.png"
    ];

    theaters.forEach(function(theater, index) {
        // 리스트에서 랜덤한 URL 선택
        theater.randomUrl = urlList[Math.floor(Math.random() * urlList.length)];
        
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(theater.TH_Lat, theater.TH_Lng),
            map: map
        });

        var infowindow = new google.maps.InfoWindow({
            content: '<div style="font-size: 20px; width: 300px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' +
            '<img src="' + theater.randomUrl + '" alt="Theater Image" width="300px" height="300px"><br>' +
            '<strong style="font-size: 30px">' + theater.TH_Place_name + '</strong><br>' +
            '<span>' +
            '<img src="../../img/marker.png" alt="Location Icon" width="20px" height="20px">' + theater.TH_Location +
            '</span><br>' +
            '<span>' +
            '<img src="../../img/call.png" alt="Phone Icon" width="20px" height="20px">' + theater.TH_Phone +
            '</span>' +
            '</div>'
        });

        marker.addListener('mouseover', function() {
            infowindow.open(map, marker);
        });

        marker.addListener('mouseout', function() {
            infowindow.close();
        });

        markers.push(marker); // 마커를 배열에 추가
    });

    createMarkerList(theaters, map, markers); // 리스트 생성 함수 호출
}

// 마커 리스트 생성 함수
function createMarkerList(theaters, map, markers) {
    var listContainer = document.getElementById('markerList') || document.createElement('div');
    if (!document.getElementById('markerList')) {
        listContainer.id = 'markerList';
        listContainer.style.width = '500px'; // Adjust width as needed
        listContainer.style.position = 'absolute'; // 맵 위에 표시되지 않도록 절대 위치 사용
        listContainer.style.zIndex = '5'; // 맵 위에 표시되도록 z-index 설정
        listContainer.style.background = '#fff'; // 배경색 설정
        listContainer.style.overflowY = 'auto'; // 스크롤 설정
        listContainer.style.height = '1150px'; // Adjust height as needed
        listContainer.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)'; // Optional: shadow for the container
        // Insert the list container before the map element in the DOM
        var mapElement = document.getElementById('map');
        mapElement.parentNode.insertBefore(listContainer, mapElement);
    } else {
        listContainer.innerHTML = ''; // Clear existing content
    }

    theaters.forEach(function(theater, index) {
        var listItem = document.createElement('div');
        listItem.classList.add('marker-item');
        listItem.style.display = 'flex';
        listItem.style.alignItems = 'center';
        listItem.style.marginBottom = '5px';
        listItem.style.cursor = 'pointer'; // 마우스 오버 시 커서 변경

        // Image container
        var imageContainer = document.createElement('div');
        imageContainer.style.width = '100px'; // Image width
        imageContainer.style.height = '100px'; // Image height
        imageContainer.style.flexShrink = '0'; // Prevent image from shrinking
        imageContainer.style.borderRadius = '50%'; // Make it round
        imageContainer.style.overflow = 'hidden'; // Hide overflow
        imageContainer.style.marginRight = '10px'; // Margin between image and text

        var image = document.createElement('img');
        image.src = theater.randomUrl;
        image.alt = 'Theater Image';
        image.style.width = '100%';
        image.style.height = '100%';
        image.style.objectFit = 'cover'; // Cover the container with the image

        // Append image to its container
        imageContainer.appendChild(image);

        // Text container
        var textContainer = document.createElement('div');

        var name = document.createElement('strong');
        name.textContent = theater.TH_Place_name;
        name.style.display = 'block'; // Make it a block to break line
        name.style.fontSize = '25px'; // Adjust font size as needed

        var location = document.createElement('div');
        location.textContent = theater.TH_Location;
        location.style.fontSize = '15px'; // Adjust font size as needed
        location.style.color = '#666'; // Adjust text color as needed

        var phone = document.createElement('div');
        phone.textContent = theater.TH_Phone;
        phone.style.fontSize = '0.8em'; // Adjust font size as needed
        phone.style.color = '#666'; // Adjust text color as needed

        // Append text elements to text container
        textContainer.appendChild(name);
        textContainer.appendChild(location);
        textContainer.appendChild(phone);

        // Append image and text containers to list item
        listItem.appendChild(imageContainer);
        listItem.appendChild(textContainer);

        // Append list item to the list container
        listContainer.appendChild(listItem);

        // When the mouse hovers over the list item, console log the marker's position and name.
        listItem.addEventListener('mouseover', function() {
            console.log('Marker Position: ', theater.TH_Lat, theater.TH_Lng);
            console.log('Marker Name: ', theater.TH_Place_name);
            console.log('Marker: ', markers[index]);
            
            // If you want to pan the map to the marker position when hovering over the list:
            map.panTo(new google.maps.LatLng(theater.TH_Lat, theater.TH_Lng));
        });

        // Optional: if you want to trigger the marker's click event when the list item is clicked
        listItem.addEventListener('mouseover', function() {
            google.maps.event.trigger(markers[index], 'mouseover');
        });

        // Optional: if you want to trigger the marker's click event when the list item is clicked
        listItem.addEventListener('mouseout', function() {
            google.maps.event.trigger(markers[index], 'mouseout');
        });
    });
}
