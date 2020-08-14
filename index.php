<?
header('Content-Type: text/html; charset=utf-8');
$json_data = file_get_contents("php://input"); 
$obj_json = json_decode($json_data);
$search_text = $obj_json->action->detailParams->movie->value;
// $num_album = $obj_json->action->detailParams->num_album->origin;




// 네이버 검색 Open API 예제 - 블로그 검색

  $client_id = "uJb3Uke6NXIvFI25jnqN";
  $client_secret = "uJb3Uke6NXIvFI25jnqN";

  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$search_text; // json 결과
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//   echo "status_code:".$status_code."";
  curl_close ($ch);
  if($status_code == 200) {
    $text = $response;
  } else {
    $text = "Error 내용:".$response;
  }


$jayParsedAry = [
	"version" => "2.0", 
	"template" => [
		"outputs" => [
			[
				"simpleText" => [
					"text" => $text
				]
			]
		]
	]
];

echo json_encode($jayParsedAry,JSON_UNESCAPED_UNICODE);
?>