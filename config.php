<?php
$base_url 		= "https://ubuntudev.trinaxmind.com/assisi/cms/";
$domain_url   = "https://ubuntudev.trinaxmind.com/";

function input_data($data){
$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
return $filter;
}

//set timezone jadi default
date_default_timezone_set('UTC');

//get filename
$url = $_SERVER['PHP_SELF'];
$filename = pathinfo(parse_url($url, PHP_URL_PATH));

//ini kalau mau ambil nama file aja
$file 	= $filename['filename'];

//ini kalau mau ambil extension. Kalau nggak mau extension, dicomment aja trs uncomment bawahnya
//$ext 	= '.'.$filename['extension'];
$ext 	= '';

//ini untuk query string URL
$param = explode("?", $_SERVER['REQUEST_URI']);

//echo $path_parts['dirname'];
//echo echo $path_parts['filename'];
//echo $path_parts['filename'];
//echo $path_parts['extension'];

//encrypt querystring
class Encryption{

    /**
    *
    *
    * ----------------------------------------------------
    * @param string
    * @return string
    *
    **/
    public static function safe_b64encode($string='') {
        $data = base64_encode($string);
        $data = str_replace(['+','/','='],['-','_',''],$data);
        return $data;
    }

    /**
    *
    *
    * -------------------------------------------------
    * @param string
    * @return string
    *
    **/
    public static function safe_b64decode($string='') {
        $data = str_replace(['-','_'],['+','/'],$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    /**
    *
    *
    * ------------------------------------------------------------------------------------------
    * @param string
    * @return string
    *
    **/
    public static function encode($value=false){
        if(!$value) return false;
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_size);
        $crypttext = openssl_encrypt($value, 'aes-256-cbc', 'ayamgoreng', OPENSSL_RAW_DATA, $iv);
        return self::safe_b64encode($iv.$crypttext);
    }

    /**
    *
    *
    * ---------------------------------
    * @param string
    * @return string
    *
    **/
    public static function decode($value=false){
        if(!$value) return false;
        $crypttext = self::safe_b64decode($value);
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($crypttext, 0, $iv_size);
        $crypttext = substr($crypttext, $iv_size);
        if(!$crypttext) return false;
        $decrypttext = openssl_decrypt($crypttext, 'aes-256-cbc', 'ayamgoreng', OPENSSL_RAW_DATA, $iv);
        return rtrim($decrypttext);
    }
}


$image_path = "../assets/img/";
//$image_path = "C:/Users/trinaxserver/Dropbox (Trinax Pte Ltd)/assisi/2021/";

$db_server        = '10.148.0.7';
$db_user          = 'assisi';
$db_password      = 'Database@123';
$db_name          = 'db_assisi';
$conn 			  = new mysqli($db_server,$db_user,$db_password,$db_name) or die ('jink');
?>
