<!DOCTYPE html>
<html>
<?php
$servername = "localhost";
$username = "root";
$password = "dusgur3608!";
$dbname = "subway";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$line = $_GET['line'];
// include "json.php";
// include "GTX.php";
?>

<?php
// cURL 세션 초기화
$ch = curl_init();

// 요청할 URL 설정 (이 URL은 JSON 데이터를 반환하는 URL이어야 합니다)
$url = "http://swopenAPI.seoul.go.kr/api/subway/73467a4c6c79656f393754426c4a6b/json/realtimePosition/0/200/" . $line;

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
}

$up = [];

$down = [];

foreach($data['realtimePositionList'] as $key => $value){
    //상행=나머지 하행=1 구분
    if ($value['updnLine'] == '1') {
        array_push($down, $value);
    } else {
        array_push($up, $value);
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
        <ul id="down">
        <div class="updn"> 하행 </div>
            <?php
                $sql = "SELECT * FROM `lines` WHERE `name` = '$line'";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<li data-station_name='".$row['station_name']."'>";
                    echo "<span class='line2';>";
                    echo "<span class='box';>▲</span>";
                    foreach ($down as $key => $value) {
                        if ( $row['station_name'] == $value['statnNm']) {
                            $top = $value['trainSttus'] == '1' ? 50 : 90;
                            echo "<span class='img' style='top:.$top.px;'>";
                            echo "<img src='pngegg.png' alt='subway' height='30' width='30'/>";
                            echo "</span>";
                        } 
                    }
                    if (strpos($row['code2'], 'C') !== false) {
                        echo "<div class='cut'></div>";
                    }
                    echo "</span>";
                    echo "</li>";
                }
            ?>
        </ul>
        <ul id="up">
        <div class="updn"> 상행 </div>
            <?php
            $sql = "SELECT * FROM `lines` WHERE `name` = '$line'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $station_name = $row['station_name'];
                    echo "<li>";
                    echo "<span class='station'>" . $row["station_name"] ."</span>";
                    echo "<span class='line'>";
                    echo "<span class='box2'>▼</span>";
                    foreach ($up as $key => $value) {
                        if ( $station_name == $value['statnNm']) {
                            if ($value['trainSttus'] == '1') {
                                $top = 50;
                            }else{
                                $top = 90;
                            }
                            echo "<span class='img' style='top:.$top.px;'>";
                            echo "<img src='pngegg.png' alt='subway' height='30' width='30'/>";
                            echo "</span>";
                        } 
                    }

                    echo "</span>";
                    echo "</li>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </ul>
            
    </div>
</body>
</html>