var gifImage = document.getElementById('myGif');
var slideItem1 = document.querySelector('.slideitem1');
var slideItem2 = document.querySelector('.slideitem2');
var slideItem3 = document.querySelector('.slideitem3');
var slideItem4 = document.querySelector('.slideitem4');

//가오갤 호버시
slideItem1.addEventListener('mouseenter', function() {
  if (gifImage.src !== '../../video/가오갤.mp4') {
    gifImage.src = '../../video/가오갤.mp4';
  }
  gifImage.style.display = 'block';
  gifImage.muted=false;
});

gifImage.addEventListener('mouseleave', function() {
  gifImage.style.display = 'none';
  gifImage.muted=true;
});

slideItem2.addEventListener('mouseenter', function() {
  if (gifImage.src !== '../../video/범죄도시3.mp4') {
    gifImage.src = '../../video/범죄도시3.mp4';
  }
  gifImage.style.display = 'block';
  gifImage.muted=false;
});

gifImage.addEventListener('mouseleave', function() {
  gifImage.style.display = 'none';
  gifImage.muted=true;
});

slideItem3.addEventListener('mouseenter', function() {
  if (gifImage.src !== '../../video/미션 임파서블.mp4') {
    gifImage.src = '../../video/미션 임파서블.mp4';
  }
  gifImage.style.display = 'block';
  gifImage.muted=false;
});

gifImage.addEventListener('mouseleave', function() {
  gifImage.style.display = 'none';
  gifImage.muted=true;
});

slideItem4.addEventListener('mouseenter', function() {
  if (gifImage.src !== '../../video/분노의 질주.mp4') {
    gifImage.src = '../../video/분노의 질주.mp4';
  }
  gifImage.style.display = 'block';
  gifImage.muted=false;
});

gifImage.addEventListener('mouseleave', function() {
  gifImage.style.display = 'none';
  gifImage.muted=true;
});
