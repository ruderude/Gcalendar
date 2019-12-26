<?php
ini_set('display_errors', "On");

// var_dump($_POST);

$access_token = $_POST['access_token'];
$calendarId = $_POST['calendarId'];

define('URL_2', 'https://www.googleapis.com/calendar/v3/calendars/' . $calendarId . '/events');

$params = array('access_token' => $access_token);

// カレンダー情報取得
$res = file_get_contents(URL_2 . '?' . http_build_query($params));

$result = json_decode($res, true);
$count = count($result['items']);
$events = [];

for($i = 0; $i < $count; $i++){
  if(array_key_exists('description', $result['items'][$i]) && false !== strpos( $result['items'][$i]['description'], 'tabelog.com' )){
    // echo $result['items'][$i]['description'] . '<br/>';
    $events[$i]['title'] = $result['items'][$i]['summary'];
    $events[$i]['body'] = $result['items'][$i]['description'];
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h2>食べログを含むイベント</h2>
  <table>
      <?php if(empty($events)){echo "<p>食べログを含むイベントはありません。</p>";} ?>
      <?php foreach ($events as $event) { ?>
        <tr><td>イベント名: </td><td><?php echo $event['title']; ?></td></tr>
        <tr><td>イベント詳細: </td><td><?php echo $event['body']; ?></td></tr>
      <?php } ?>
	</table>
<!-- <pre>
  <?php var_dump($result); ?>
</pre> -->
</body>
</html>
