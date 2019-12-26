<?php
// アプリケーション設定
define('CONSUMER_KEY', '213240012190-qd8gdni3j781bqqf5gc431pdlpavrln9.apps.googleusercontent.com');
define('CALLBACK_URL', 'http://localhost/oauth2callback.php');

// URL
define('AUTH_URL', 'https://accounts.google.com/o/oauth2/auth');


$params = array(
	'client_id' => CONSUMER_KEY,
	'redirect_uri' => CALLBACK_URL,
	'scope' => 'https://www.googleapis.com/auth/calendar.readonly',
	'response_type' => 'code',
);

// 認証ページにリダイレクト
header("Location: " . AUTH_URL . '?' . http_build_query($params));
?>
