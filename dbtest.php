<?php
$servername = "localhost"; // 데이터베이스 서버 주소
$username = "root"; // 데이터베이스 사용자 이름
$password = "dusgur3608!"; // 데이터베이스 비밀번호
$dbname = "subwayq"; // 연결할 데이터베이스 이름

// MySQLi를 사용하여 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 상태 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}
echo "성공적으로 연결되었습니다.";

// 데이터베이스 작업 수행 예제
$sql = "SELECT id, name FROM your_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 결과 출력
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 결과";
}

// 연결 종료
$conn->close();
?>