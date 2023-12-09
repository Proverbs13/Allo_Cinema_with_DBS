var myPosition = { lat: 36.625, lng: 127.454 };

window.showMap = showMap;


window.onload = initMap;

// 구글 맵 로드
function loadMapScript(callback) {
    var script = document.createElement("script");
    script.src = "https://maps.googleapis.com/maps/api/js?key=" + apiKey + "&callback=" + callback;
    document.head.appendChild(script);
}

// 맵 초기화 및 표시
function initMap() {
    
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


function createMarkerList(theaters, map, markers) {
    var listContainer = document.getElementById('markerList') || document.createElement('div');
    if (!document.getElementById('markerList')) {
        listContainer.id = 'markerList';
        listContainer.style.width = '500px'; 
        listContainer.style.position = 'absolute'; 
        listContainer.style.zIndex = '5'; 
        listContainer.style.background = '#fff'; // 배경색 설정
        listContainer.style.overflowY = 'auto'; 
        listContainer.style.height = '1150px'; 
        listContainer.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)'; 
        
        var mapElement = document.getElementById('map');
        mapElement.parentNode.insertBefore(listContainer, mapElement);
    } else {
        listContainer.innerHTML = ''; 
    }

    theaters.forEach(function(theater, index) {
        var listItem = document.createElement('div');
        listItem.classList.add('marker-item');
        listItem.style.display = 'flex';
        listItem.style.alignItems = 'center';
        listItem.style.marginBottom = '5px';
        listItem.style.cursor = 'pointer'; // 마우스 오버 시 커서 변경

        
        var imageContainer = document.createElement('div');
        imageContainer.style.width = '100px'; 
        imageContainer.style.height = '100px'; 
        imageContainer.style.flexShrink = '0'; 
        imageContainer.style.borderRadius = '50%'; 
        imageContainer.style.overflow = 'hidden'; 
        imageContainer.style.marginRight = '10px'; 

        var image = document.createElement('img');
        image.src = theater.randomUrl;
        image.alt = 'Theater Image';
        image.style.width = '100%';
        image.style.height = '100%';
        image.style.objectFit = 'cover'; 

      
        imageContainer.appendChild(image);

  
        var textContainer = document.createElement('div');

        var name = document.createElement('strong');
        name.textContent = theater.TH_Place_name;
        name.style.display = 'block'; 
        name.style.fontSize = '25px'; 

        var location = document.createElement('div');
        location.textContent = theater.TH_Location;
        location.style.fontSize = '15px'; 
        location.style.color = '#666'; 

        var phone = document.createElement('div');
        phone.textContent = theater.TH_Phone;
        phone.style.fontSize = '0.8em'; 
        phone.style.color = '#666';

       
        textContainer.appendChild(name);
        textContainer.appendChild(location);
        textContainer.appendChild(phone);

        
        listItem.appendChild(imageContainer);
        listItem.appendChild(textContainer);

        
        listContainer.appendChild(listItem);

        
        listItem.addEventListener('mouseover', function() {
            console.log('Marker Position: ', theater.TH_Lat, theater.TH_Lng);
            console.log('Marker Name: ', theater.TH_Place_name);
            console.log('Marker: ', markers[index]);
            
            
            map.panTo(new google.maps.LatLng(theater.TH_Lat, theater.TH_Lng));
        });

        
        listItem.addEventListener('mouseover', function() {
            google.maps.event.trigger(markers[index], 'mouseover');
        });

        
        listItem.addEventListener('mouseout', function() {
            google.maps.event.trigger(markers[index], 'mouseout');
        });
    });
}
