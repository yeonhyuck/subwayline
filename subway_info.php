<?php
include "config.php";
$line = $_GET['line'];
$sql = "SELECT `name` FROM `lines` WHERE `subway_idx` = '$line' ";
$result = $conn->query($sql);
$row = $result->fetch_array();
$line = $row['name'];

// cURL 세션 초기화
$ch = curl_init();
// 요청할 URL 설정 
$url = "http://swopenAPI.seoul.go.kr/api/subway/인증키/json/realtimePosition/0/200/" . $line;
// URL 설정
curl_setopt($ch, CURLOPT_URL, $url);
// 반환값을 문자열로 설정
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// cURL 실행 및 결과 저장
$response = curl_exec($ch);
// HTTP 응답 코드 확인
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// cURL 세션 닫기
curl_close($ch);
// HTTP 응답 코드가 200일 경우 JSON 데이터 출력
if ($http_code == 200) {
    // JSON 문자열을 PHP 배열로 변환
    $data = json_decode($response, true);
    // 데이터 출력 (여기서는 예시로 첫 번째 열차 정보를 출력)
} else {
    echo "HTTP 요청 실패, 응답 코드: $http_code\n";
    exit;
}

$subway = array(
    "down" => array(),
    "up" => array()
);


foreach($data['realtimePositionList'] as $key => $value){
    //상행=나머지 하행=1 구분
    if ($value['updnLine'] == '1') {
        $subway['down'][] = $value; 
        
    } else {
        $subway['up'][] = $value;

    }    
} 
?>
<head>
    <title><?php echo $line ?>노선도</title>
    <link rel="stylesheet" href="linestyle.css?v=<?php echo time();?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="home_btn">
        <a href="/">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            HOME
        </a>
    </div>
    <div class="refresh_btn">
        <div class="container"> 
            <div class="btn" onClick="window.location.reload()">
                <span>새로고침</span>
                <div class="dot"></div>
            </div>
        </div>
    </div>
    <div class="line-title"><?php echo $line ?></div>
    <div class="line_main">

        <?php
        
        foreach($subway as $k => $i) {
            if($k == "up") {
                $updown = "상행";
                $tri = "▼";
            }
            else{
                $updown = "하행";
                $tri = "▲";  
            }
            
        ?>
        <ul id=<?php echo $k; ?>>
            <div class="updn"> <?php echo $updown; ?></div>
            <?php
                $sql = "SELECT * FROM `lines` WHERE `name` = '$line'";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<li data-station_name={$row['station_name']}>";
                    if ($k == "up") {
                        echo "<span class='station'>{$row['station_name']}</span>";
                    }
                    echo "<span class='line_{$k}'>";
                    echo "<span class='box_{$k}';>{$tri}</span>";
                    foreach ($subway[$k] as $key => $value) {
                        if ( $row['station_name'] == $value['statnNm']) {
                            $top = $value['trainSttus'] == '1' ? 50 : 90;
                            echo "<span class='img' style='top:{$top}px;'>";
                            echo "<img src='pngegg.png' alt='subway' height='30' width='30'/>";
                            echo "</span>";
                        } 
                    }
                    if (strpos($row['code2'], 'C') !== false) {
                        if ($k == "down") {
                            echo "<div class='cut'></div>";
                        }
                    }
                    echo "</span>";
                    echo "</li>";
                }
            ?>
        </ul>
        <?php  } ?>
    
            
    </div>
</body>
</html>