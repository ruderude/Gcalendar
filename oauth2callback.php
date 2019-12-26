<?php
// アプリケーション設定
define('CONSUMER_KEY', '213240012190-qd8gdni3j781bqqf5gc431pdlpavrln9.apps.googleusercontent.com');
define('CONSUMER_SECRET', 'GYxxb5Uwrh0Km1i9RVz7VmQv');
define('CALLBACK_URL', 'http://localhost/oauth2callback.php');

// URL
define('TOKEN_URL', 'https://accounts.google.com/o/oauth2/token');
define('URL_1', 'https://www.googleapis.com/calendar/v3/users/me/calendarList');

$params = array(
	'code' => $_GET['code'],
	'grant_type' => 'authorization_code',
	'redirect_uri' => CALLBACK_URL,
	'client_id' => CONSUMER_KEY,
	'client_secret' => CONSUMER_SECRET,
);

// POST送信
$options = array('http' => array(
	'method' => 'POST',
	'content' => http_build_query($params)
));

// アクセストークンの取得
$res = file_get_contents(TOKEN_URL, false, stream_context_create($options));

// レスポンス取得
$token = json_decode($res, true);
if(isset($token['error'])){
	echo 'エラー発生';
	exit;
}

$access_token = $token['access_token'];

$params = array('access_token' => $access_token);

// カレンダー情報取得
$res = file_get_contents(URL_1 . '?' . http_build_query($params));
$res2 = file_get_contents(URL_2 . '?' . http_build_query($params));

$result = json_decode($res, true);
$result2 = json_decode($res2, true);

//表示
// echo "<pre>";
// var_dump($result);
// echo "<pre>";
// print_r($result);
// foreach ($result['items'] as $value) {
// 	echo $value['summary'];
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>GoogleのOAuth2.0を使ってプロフィールを取得</title>
</head>
<body>
	<h2>カレンダー情報</h2>
	<table>
		<?php foreach ($result['items'] as $value) { ?>
			<form action="result.php" method="post">
				<input type="hidden" name="access_token" value="<?php echo $access_token; ?>" />
				<input type="hidden" name="calendarId" value="<?php echo $value['id']; ?>" />
				<tr><td>カレンダー名: </td><td><?php echo $value['summary']; ?><input type="submit" value="送信" /></td></tr>
			</form>
		<?php } ?>
	</table>

</body>
</html>
