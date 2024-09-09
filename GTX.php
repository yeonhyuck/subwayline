<?php 
$json =
'{
  "errorMessage": {
    "status": 200,
    "code": "INFO-000",
    "message": "정상 처리되었습니다.",
    "link": "",
    "developerMessage": "",
    "total": 2
  },
  "realtimePositionList": [
    {
      "beginRow": null,
      "endRow": null,
      "curPage": null,
      "pageRow": null,
      "totalCount": 2,
      "rowNum": 1,
      "selectedCount": 2,
      "subwayId": "1032",
      "subwayNm": "GTX-A",
      "statnId": "1032000354",
      "statnNm": "성남",
      "trainNo": "0091",
      "lastRecptnDt": "20240530",
      "recptnDt": "2024-05-30 21:58:01",
      "updnLine": "1",
      "statnTid": "1032000356",
      "statnTnm": "동탄",
      "trainSttus": "2",
      "directAt": "0",
      "lstcarAt": "0"
    },
    {
      "beginRow": null,
      "endRow": null,
      "curPage": null,
      "pageRow": null,
      "totalCount": 2,
      "rowNum": 2,
      "selectedCount": 2,
      "subwayId": "1032",
      "subwayNm": "GTX-A",
      "statnId": "1032000354",
      "statnNm": "성남",
      "trainNo": "0094",
      "lastRecptnDt": "20240530",
      "recptnDt": "2024-05-30 21:58:14",
      "updnLine": "0",
      "statnTid": "1032000353",
      "statnTnm": "수서",
      "trainSttus": "2",
      "directAt": "0",
      "lstcarAt": "0"
    }
  ]
}';

$json = json_decode($json, TRUE);


// print_r($json);
?>