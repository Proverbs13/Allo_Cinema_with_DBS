// 슬라이드 요소들을 가져옵니다.
var slides = document.querySelectorAll('.slideitem');
// 현재 슬라이드 인덱스를 초기화합니다.
var currentSlide = 0;
// 슬라이드를 넘기는 시간 간격을 설정합니다. (밀리초 단위)
var slideInterval = 10000; // 10초
// 이전 슬라이드로 이동하는 함수
function prevSlide() {
    // 현재 슬라이드의 인덱스를 감소시킵니다.
    currentSlide--;
    // 슬라이드 인덱스가 음수일 경우 마지막 슬라이드로 이동합니다.
    if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }
    // 슬라이드를 표시합니다.
    showSlide();
}

// 다음 슬라이드로 이동하는 함수
function nextSlide() {
    // 현재 슬라이드의 인덱스를 증가시킵니다.
    currentSlide++;
    // 슬라이드 인덱스가 슬라이드 개수를 초과할 경우 첫 번째 슬라이드로 이동합니다.
    if (currentSlide >= slides.length) {
        currentSlide = 0;
    }
    // 슬라이드를 표시합니다.
    showSlide();
}

// 슬라이드를 표시하는 함수
function showSlide() {
    // 모든 슬라이드를 숨깁니다.
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
    }
}

// 이전 슬라이드로 이동하는 버튼에 클릭 이벤트 리스너를 추가합니다.
document.querySelector('.control01 .prev').addEventListener('click', function() {
    prevSlide();
});

// 다음 슬라이드로 이동하는 버튼에 클릭 이벤트 리스너를 추가합니다.
document.querySelector('.control01 .next').addEventListener('click', function() {
    nextSlide();
});

// 슬라이드를 자동으로 넘기는 타이머 ID를 저장하는 변수입니다.
var slideTimer;

// 슬라이드를 주기적으로 넘기는 함수
function startSlideShow() {
    // 이전에 실행 중인 타이머를 초기화합니다.
    clearInterval(slideTimer);
    // 주기적으로 다음 슬라이드로 이동하는 타이머를 설정합니다.
    slideTimer = setInterval(function() {
        nextSlide();
    }, slideInterval);
}

// 슬라이드 쇼를 시작합니다.
startSlideShow();