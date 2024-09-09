
<?php
// cURL 세션 초기화
$ch = curl_init();

// 요청할 URL 설정 (이 URL은 JSON 데이터를 반환하는 URL이어야 합니다)
$url = "http://swopenAPI.seoul.go.kr/api/subway/73467a4c6c79656f393754426c4a6b/json/realtimePosition/0/200/1호선";

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
    print_r($data);
    // // 데이터 출력 (여기서는 예시로 첫 번째 열차 정보를 출력)
    // if (!empty($data['realtimePositionList'])) {
    //     foreach ($data['realtimePositionList'] as $position) {
    //         echo "열차 번호: " . $position['trainNo'] . "\n";
    //         echo "지하철 노선: " . $position['subwayNm'] . "\n";
    //         echo "현재 역: " . $position['statnNm'] . "\n";
    //         echo "도착 역: " . $position['statnTnm'] . "\n";
    //         echo "상태: " . $position['trainSttus'] . "\n";
    //         echo "</br>";
    //     }
    // } else {
    //     echo "실시간 위치 정보를 가져올 수 없습니다.\n";
    // }
} else {
    echo "HTTP 요청 실패, 응답 코드: $http_code\n";
}
?>