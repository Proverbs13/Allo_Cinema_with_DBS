document.addEventListener('DOMContentLoaded', function() {
    var recommendationBtn = document.getElementById('recommendationBtn');
    if (recommendationBtn) {
        recommendationBtn.addEventListener('click', function() {
            console.log('recommendationBtn clicked'); // 콘솔에 메시지 출력
            document.getElementById('leftSlide').style.transform = 'translateX(300px)';
        });
    }

    var checkboxes = document.querySelectorAll('#leftSlide input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('leftSlide').style.transform = 'translateX(-300px)';
                document.getElementById('rightSlide').style.transform = 'translateX(-300px)';
            }
        });
    });
});
