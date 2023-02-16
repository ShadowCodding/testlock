<?php // Connection - Bağlantı
	$lang = "fr";

	include 'config.php';
	include 'lang.php';

	$ip = "localhost"; // Database IP - Veritabanı IP
	$user = "root";  // Database Username - Veritabanı Kullanıcı adı
	$password = "";  // Database Password - Veritabanı Şifresi
	$db = "shadowlock"; // Database Name - Veritabanı İsmi
	$botip = ""; //Bot

    function siteURL() {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
          $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol.$domainName;
    }
    
    define('AUTH_URL', 'https://discord.com/api/oauth2/authorize');
    define('CALLBACK_URL', 'https://shadowlock.xyz/login/discord/callback');
    define('SCOPE', 'identify email');
    define('TOKEN_URL', 'https://discord.com/api/oauth2/token');
    define('URL_BASE', 'https://discord.com/api/users/@me');
	
	function apiRequest($url, $post, $params) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        
        if (session('access_token')) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'authorization: Bearer ' . session('access_token'),
                'cache-control: no-cache',
                'Accept: application/json'
            ));
        }
        
        $data = curl_exec($ch);
        return json_decode($data);
    }
        
    function get($key, $default=NULL) {
    	return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    function session($key, $default=NULL) {
    	return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

	try{
		$db = new PDO("mysql:host=$ip;dbname=$db",$user,$password);
		$db->exec("SET CHARSET UTF8");
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		die ("Unexcepted error on database connection.");
	}
?>
