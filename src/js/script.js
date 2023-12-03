document.addEventListener('DOMContentLoaded', function() {
    var leftSlide = document.getElementById('Reco_slide_left');
    leftSlide.style.transform = 'translateX(0)'; // 초기 위치
    leftSlide.style.transition = 'transform 0.5s ease'; // 부드러운 움직임을 위한 transition 설정

    var checkboxesLeft = document.querySelectorAll('#leftSlide input[type="checkbox"]');
    checkboxesLeft.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('leftSlide').style.transform = 'translateX(-300px)';
            } else {
                document.getElementById('leftSlide').style.transform = 'translateX(0)';
            }
        });
    });

    var checkboxesRight = document.querySelectorAll('#rightSlide input[type="checkbox"]');
    checkboxesRight.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('rightSlide').style.transform = 'translateX(300px)';
            } else {
                document.getElementById('rightSlide').style.transform = 'translateX(0)';
            }
        });
    });
});
