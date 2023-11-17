// 영화 이름
var movies = {
    'flash':0,
    'india':1,
    'elemental':2,
    'spider':3,
    'city':4,
    'dead':5,
    'boby':6,
    'newclear':7
};
// 영화 정보
var infoes = [
    {
        img: '플래시 포스터.jpg',
        title: '플래시',
        date: '2023.06.14',
        old: '12세 관람가',
        theme: '액션, 모험, 판타지',
        state: '미국',
        time: '134분',
        distributer: '워너 브러더스 코리아㈜',
        director: '안드레스 무시에티',
        actors: ['에즈라 밀러', '벤 애플렉', '마이클 키튼'],
        director_img : '안드레스 무시에티.jpg',
        actors_img :['에즈라 밀러.jpg','마이클 키튼.jpg','사샤 카예.jpg'],
        intro: '시공간이 붕괴된 세계, 차원이 다른 히어로가 온다! 빛보다 빠른 스피드, 물체 투과, 전기 방출, 자체 회복, 천재적인 두뇌까지 갓벽한 능력을 자랑하지만 존재감은 제로, 저스티스 리그에서 궂은일을 도맡아 하는 히어로 ‘플래시’. 어느 날 자신에게 빛보다 빠른 속도로 달리면 시공간 이동 능력이 있음을 알게 된 그는 ‘브루스 웨인’의 만류를 무시한 채 끔찍한 상처로 얼룩진 과거를 바꾸기 위해 시간을 역행한다. 의도치 않은 장소에 불시착한 ‘플래시’는 멀티버스 세상 속 또 다른 자신과 맞닥뜨리고 메타 휴먼이 흔적도 없이 사라지고 모든 것이 뒤엉킨 세상과 마주하게 된다. ‘플래시’는 자신이 알던 모습과 전혀 달라진 나이 들고 은퇴한 ‘배트맨’과 크립톤 행성에서 온 ‘슈퍼걸’의 도움으로 외계의 침공으로부터 시간과 차원이 붕괴된 지구를 구하려 나서는데…'
    },
    {
        img: '인디아나 존스 포스터.jpg',
        title: '인디아나 존스 : 운명의 다이얼 ',
        date: '2023.06.',
        old: '미정',
        theme: '액션, 모험',
        state: '미국',
        time: '153분',
        distributer: '월트 디즈니 컴퍼니 코리아',
        director: '제임스 맨골드',
        actors: ['해리슨 포드', '피비 월러-브리지', '매즈 미켈슨'],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '전설적인 모험가이자 고고학자 ‘인디아나 존스’가 운명의 다이얼을 찾기 위해 또 한 번 새로운 모험에 뛰어드는 액션 어드벤처'
    },
    {
        img: '엘리멘탈 포스터.jpg',
        title: '엘리멘탈',
        date: '2023.06.14',
        old: '전체 관람가',
        theme: '애니메이션',
        state: '미국',
        time: '109분',
        distributer: '월트디즈니 컴퍼니 코리아',
        director: '피터 손',
        actors: ['레아 루이스 ', '마무두 아티', ''],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '불, 물, 공기, 흙 4개의 원소들이 살고 있는 ‘엘리멘트 시티’ 재치 있고 불처럼 열정 넘치는 ‘앰버"는 어느 날 우연히 유쾌하고 감성적이며 물 흐르듯 사는 "웨이드"를 만나 특별한 우정을 쌓으며, 지금껏 믿어온 모든 것들이 흔들리는 새로운 경험을 하게 되는데... 웰컴 투 ‘엘리멘트 시티’!'
    },
    {
        img: '스파이더맨 어크로스 더 유니버스 포스터.jpg',
        title: '스파이더맨: 어크로스 더 유니버스',
        date: '2023.06.21',
        old: '미정',
        theme: '애니메이션',
        state: '미국',
        time: '140분',
        distributer: '소니픽처스코리아',
        director: '호아킴 도스 산토스',
        actors: ['제이크 존슨', '헤일리 스타인펠드', '셔메이크 무어'],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '스파이더맨 VS 스파이더맨?! 여러 성장통을 겪으며 새로운 스파이더맨이 된 ‘마일스 모랄레스’. 그 앞에 다른 평행세계의 스파이더우먼 ‘그웬’이 다시 나타난다. 모든 차원의 멀티버스 속 스파이더맨들을 만나게 되지만, 질서에 대한 신념이 부딪히며 예상치 못한 균열이 생기는데… 상상 그 이상을 넘어서는 멀티버스의 세계가 열린다!'
    },
    {
        img: '애스터 로이드 시티 포스터.jpg',
        title: '애스터로이드 시티',
        date: '2023.06.28',
        old: '12세 관람가',
        theme: '드라마',
        state: '미국',
        time: '105분',
        distributer: '유니버설 픽쳐스',
        director: '웨스 앤더슨',
        actors: ['제이슨 슈워츠먼', '스칼렛 요한슨', '톰 행크스'],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '이상하고 아름다운 도시 ‘애스터로이드 시티’ 이제 세상이 달라졌어요. 1955년 가상의 사막 도시이자 운석이 떨어진 도시 ‘애스터로이드 시티’ 매년 운석이 떨어진 것을 기념하는 ‘소행성의 날’ 행사에 모인 사람들은 예상치 못한 사건으로 인해 그 곳에 옴짝달싹도 못한 채 갇히게 되고 계속해서 생각지도 못한 예측불허 상황들이 펼쳐지는데… 어쩌면 삶에는 의미가 있을지도 몰라요.'
    },
    {
        img: '미션임파서블 포스터.jpg',
        title: '미션임파서블: 데드 레코닝 PART ONE',
        date: '2023.07.',
        old: '미정',
        theme: '액션, 모험, 스릴러',
        state: '미국',
        time: '156분',
        distributer: '롯데엔터테인먼트',
        director: '크리스토퍼 맥쿼리',
        actors: ['톰 크루즈', '레베카 페르구손', ''],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '에단 헌트의 마지막 임무가 시작된다. 전직 IMF 국장 유진 키트리지는 헌트에게 선택을 강요하고, 절체절명의 위기 앞에 헌트는 다시 한번 불가능에 가까운 미션에 도전한다.'
    },
    {
        img: '바비 포스터.jpg',
        title: '바비 7월',
        date: '2023.07.',
        old: '미정',
        theme: '모험, 코미디, 판타지, 로맨스, 드라마',
        state: '미국',
        time: '미정',
        distributer: '워너브라더스 코리아',
        director: '그레타 거윅',
        actors: ['마고 로비', '라이언 고슬링', ''],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '원하는 무엇이든 될 수 있는 "바비랜드"에서 살아가던 "바비"가 현실 세계와 이어진 포털의 균열을 발견하게 되고, 이를 해결하기 위해 "켄"과 예기치 못한 여정을 떠나면서 펼쳐지는 이야기'
    },
    {
        img: '오펜하이머 포스터.jpg',
        title: '오펜하이머',
        date: '2023.08.15',
        old: '미정',
        theme: '스릴러, 전기, SF, 시대극, 드라마',
        state: '미국, 영국',
        time: '미정',
        distributer: '유니버설 픽쳐스',
        director: '크리스토퍼 놀란',
        actors: ['킬리언 머피', '에밀리 블런트', '맷 데이먼'],
        director_img : 'human_default.png',
        actors_img :['human_default.png','human_default.png','human_default.png'],
        intro: '제2차 세계대전 당시 핵무기 개발을 위해 진행되었던 비밀 프로젝트 ‘맨해튼 프로젝트’를 주도한 미국의 물리학자 ‘로버트 오펜하이머’의 이야기'
    },
    
]

// 현재 URL에서 쿼리 파라미터 값을 읽어옴
var urlParams = new URLSearchParams(window.location.search);
var value = urlParams.get('value');

// 요소 정의
var movieImage = document.getElementById('movie-image');
var movieTitle = document.getElementById('movie-title');
var movieReleaseDate = document.getElementById('movie-release-date');
var movieOld = document.getElementById('movie-old');
var movieGenre = document.getElementById('movie-genre');
var movieState = document.getElementById('movie-state');
var movieRunningTime = document.getElementById('movie-running-time');
var movieDistributer = document.getElementById('movie-distributer');
var movieDirector = document.getElementById('movie-director');
var movieIntro = document.getElementById('movie-intro');
var movieDirector_Image = document.getElementById('director_img');

// info 선택
const info = infoes[movies[value.toString()]];

// value 값을 이용하여 이미지 src 및 기타 정보를 업데이트
movieImage.src = "../../img/poster/" + info.img;
movieTitle.textContent = info.title;
movieReleaseDate.textContent = info.date;
movieOld.textContent = info.old;
movieGenre.textContent = info.theme;
movieState.textContent = info.state;
movieRunningTime.textContent = info.time;
movieDistributer.textContent = info.distributer;
movieDirector.textContent = info.director;
movieDirector_Image.src = "../../img/" + info.director_img;
movieIntro.textContent = info.intro;

// 배우 추가
console.log(info.actors);
for(var i=0; i<info.actors.length; i++){
    addActor(info.actors[i]);
}

// 배우 추가 함수
function addActor(actor) {

    // "people_card" 클래스를 가진 외부 div 생성
    var outerDiv = document.createElement("div");
    outerDiv.classList.add("people_card");

    // "thumb" 클래스를 가진 div와 그 안의 이미지 생성
    var thumbDiv = document.createElement("div");
    thumbDiv.classList.add("thumb");
    var image = document.createElement("img");
    image.src = "../../img/"+info.actors_img[i];
    image.alt = "사진";
    thumbDiv.appendChild(image);

    // "title_box" 클래스를 가진 div 생성
    var titleDiv = document.createElement("div");
    titleDiv.classList.add("title_box");

    // "sub_name" 클래스를 가진 span 생성
    var subNameSpan = document.createElement("span");
    subNameSpan.classList.add("sub_name");
    subNameSpan.style.maxHeight = "4rem";
    subNameSpan.innerText = "배우";

    // "people_name" 클래스를 가진 strong 요소 생성
    var strongElement = document.createElement("strong");
    strongElement.classList.add("people_name");
    strongElement.style.maxHeight = "4rem";
    strongElement.innerText = actor;

    // 각 요소를 상위 요소에 추가
    titleDiv.appendChild(subNameSpan);
    titleDiv.appendChild(strongElement);
    outerDiv.appendChild(thumbDiv);
    outerDiv.appendChild(titleDiv);

    // 해당 카드를 추가할 목표 요소 가져오기
    var targetElement = document.querySelector(".movie-actor");
    targetElement.appendChild(outerDiv);
}